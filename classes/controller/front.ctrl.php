<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

namespace Nos\Monkey;

use Nos\Controller_Front_Application;

use View;

class Controller_Front extends Controller_Front_Application
{
    /**
     * @var Nos\Pagination
     */
    protected $pagination;
    protected $current_page = 1;

    protected $loop;

    protected $species;

    protected $page_from = false;

    protected $enhancer_url_segments;

    public function action_main($args = array())
    {

        $this->default_config = $this->config;

        $this->page_from = $this->main_controller->getPage();

        $this->merge_config('config');

        if (isset($args['item_per_page'])) {
            $this->config['item_per_page'] = $args['item_per_page'];
        }

        $this->main_controller->addCss('static/apps/noviusos_monkey/css/front.css');

        $enhancer_url = $this->main_controller->getEnhancerUrl();
        if (!empty($enhancer_url)) {
            $this->enhancer_url_segments = explode('/', $enhancer_url);
            $segments = $this->enhancer_url_segments;

            if (empty($segments[1])) {
                return $this->display_monkey();
            } elseif ($segments[0] === 'page') {
                $this->init_pagination(empty($segments[1]) ? 1 : $segments[1]);

                return $this->display_list_monkey();
            } elseif ($segments[0] === 'species') {
                $this->init_pagination(!empty($segments[2]) ? $segments[2] : 1);

                return $this->display_list_species($args);
            }

            throw new \Nos\NotFoundException();
        }

        $this->init_pagination(1);

        return $this->display_list_monkey();
    }

    protected function init_pagination($page)
    {
        $this->current_page = $page;
        $this->pagination = new \Nos\Pagination();
    }

    protected function display_list_monkey()
    {
        $list = $this->display_list();

        $self = $this;
        $class = get_class($this);

        // Add surrounding stuff
        return View::forge(
            $this->config['list_view'],
            array(
                'list' => $list,
                'pagination' => $this->pagination->create_links(
                    function ($page) use ($class, $self) {
                        if ($page == 1) {
                            return mb_substr($self->main_controller->getEnhancedUrlPath(), 0, -1).'.html';
                        }

                        return $self->main_controller->getEnhancedUrlPath().'page/'.$page.'.html';
                    }
                ),
            ),
            false
        );
    }

    protected function display_list_species()
    {
        list(, $species) = $this->enhancer_url_segments;

        $this->species = Model_Species::find(
            'first',
            array(
                'where' => array(
                    array('mksp_virtual_name', '=', $species),
                    array('mksp_context', '=', $this->page_from->page_context),
                )
            )
        );

        if (empty($this->species)) {
            throw new \Nos\NotFoundException();
        }

        $this->main_controller->setTitle($this->species->mksp_title);

        $self = $this;
        $link_species = static::get_url_model($this->species);
        $link_pagination = function ($page) use ($self) {
            return $self->species->url(array('page' => $page));
        };

        $list = $this->display_list('species');

        // Add surrounding stuff
        return View::forge(
            'front/list_species',
            array(
                'list' => $list,
                'pagination' => $this->pagination->create_links($link_pagination),
                'species' => $this->species,
                'link_species' => $link_species,
            ),
            false
        );
    }

    protected function display_list($context = 'monkeys')
    {
        $this->config = \Arr::merge($this->config, $this->default_config['display_list'], $this->default_config["display_{$context}"]);

        $where = array(
            array('monk_context', $this->page_from->page_context),
        );
        if (!$this->main_controller->isPreview()) {
            $where[] = array('published', true);
        }
        if (!empty($this->species)) {
            $where[] = array('monk_species_id', $this->species->mksp_id);
        }

        // Get the list of monkeys
        $query = Model_Monkey::query(array(
            'where' => $where,
        ))->related(array('species'));

        $this->pagination->set_config(
            array(
                'total_items' => $query->count(),
                'per_page' => $this->config['item_per_page'],
                'current_page' => $this->current_page,
            )
        );

        $query->rows_offset($this->pagination->offset);
        $query->rows_limit((int) $this->pagination->per_page);

        $query->order_by($this->config['order_by']);

        $monkeys = $query->get();

        // Display them
        return $this->display_items($monkeys, $context);
    }

    /**
     * Display several items (from a list context)
     *
     * @param  array  $items
     * @param  string $context = list_main | list_author | list_species
     * @return string Rendered view
     */
    protected function display_items($items, $context = 'monkeys')
    {
        // Loop meta-data
        $length = count($items);
        $index = 1;
        $output = array();

        // Events based on current iteration
        $this->merge_config('display_list_item');
        $this->merge_config("display_{$context}_item");
        if (!empty($this->config['fields_views'])) {
            $this->views = static::_compute_views($this->config['fields_views']);
        }

        // Render each news
        foreach ($items as $item) {
            $this->loop = array(
                'length' => $length,
                'current' => $index,
                'first' => $index === 1,
                'last' => $index++ === $length,
            );

            if ($this->loop['first']) {
                $this->merge_config('display_list_item_first');
                $this->merge_config("display_{$context}_item_first");
            } else {
                $this->merge_config('display_list_item_following');
                $this->merge_config("display_{$context}_item_following");
            }

            $output[] = $this->monkey($item);
        }

        return implode('', $output);
    }

    /**
     * Display a single monkey (outside a list context)
     *
     * @throws \Nos\NotFoundException
     */
    protected function display_monkey()
    {
        list($item_virtual_name) = $this->enhancer_url_segments;

        $monkey = $this->get_monkey($item_virtual_name);

        if (empty($monkey)) {
            throw new \Nos\NotFoundException();
        }

        $this->merge_config('display_monkey');

        $this->main_controller->setTitle($monkey->monk_name);
        $this->main_controller->setMetaDescription($monkey->monk_summary);

        echo $this->monkey($monkey);
    }

    protected function monkey($monkey, $data = array())
    {
        $data['date_format'] = $this->config['date_format'];

        // Renders all the fields
        $fields = array();
        foreach (preg_split('/[\s,-]+/u', $this->config['fields']) as $field) {
            $view = isset($this->views[$field]) ? $this->views[$field] : $this->config['fields_view'];
            $data['display'] = array($field => true);
            $data['item'] = $monkey;
            $view = static::get_view($view);
            $view->set($data);
            $view->set('item', $monkey, false);
            $fields[$field] = $view;
        }
        $view = static::get_view($this->config['item_view']);
        $view->set($data + $fields, null, false);

        return $view;
    }

    protected function get_monkey($where = array())
    {
        // First argument is a string => it's the virtual name
        if (!is_array($where)) {
            $where = array(array('monk_virtual_name', '=', $where));
        }
        $where[] = array('monk_context', '=', $this->page_from->page_context);

        if (!$this->main_controller->isPreview()) {
            $where[] = array('published', true);
        }

        return Model_Monkey::find('first', array('where' => $where));
    }

    protected static function get_view($which)
    {
        // Cache views
        static $views = array();
        if (empty($views[$which])) {
            $views[$which] = View::forge($which);
        }
        // Return empty views
        return clone $views[$which];
    }

    public static function get_url_model($item, $params = array())
    {
        $model = get_class($item);
        $page = isset($params['page']) ? $params['page'] : 1;

        switch ($model) {
            case 'Nos\Monkey\Model_Monkey' :
                return urlencode($item->monk_virtual_name).'.html';
                break;

            case 'Nos\Monkey\Model_Species' :
                return 'species/'.urlencode($item->mksp_virtual_name).($page > 1 ? '/'.$page : '').'.html';
                break;
        }

        return false;
    }
}
