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
use Nos\Model_Page;

use Fuel\Core\Inflector;
use Fuel\Core\Str;
use View;

class Controller_Front extends Controller_Front_Application {

    /**
     * @var Nos\Pagination
     */
    public $pagination;
    public $current_page = 1;

    /**
     * @var Nos\Monkey\Model_Species
     */
    public $author;

    /**
     * @var Nos\Monkey\Model_Tag
     */
    public $tag;

    public $page_from = false;

    public static $item_url = '';

    public $enhancerUrl_segments;

    public function action_main($args = array()) {

        $this->default_config = $this->config;

        $this->page_from = $this->main_controller->getPage();

        $this->merge_config('config');

        $this->config['item_per_page'] = $args['item_per_page'];

        \Nos\I18n::load('noviusos_monkey::comments', 'comments');

        $enhancer_url = $this->main_controller->getEnhancerUrl();
        if (!empty($enhancer_url)) {
	        $this->enhancerUrl_segments = explode('/', $enhancer_url);
            $segments = $this->enhancerUrl_segments;


	        if (empty($segments[1])) {
                return $this->display_item($args);
            } else if ($segments[0] == 'stats') {

                $post = $this->_get_post(array(array('item_id', $segments[1])));
                if (!empty($post)) {
                    $stats = \Session::get('noviusos_monkey_stats', array());
                    if (!in_array($post->item_id, $stats)) {
                        $post->item_read++;
                        $post->save();
                        $stats[] = $post->item_id;
                        \Session::set('noviusos_monkey_stats', $stats);
                    }
                }
                \Nos\Tools_File::send(DOCROOT.'static/apps/noviusos_monkey/img/transparent.gif');

	        } else if ($segments[0] === 'page') {
		        $this->init_pagination(empty($segments[1]) ? 1 : $segments[1]);
		        return $this->display_list_main($args);
	        } else if ($segments[0] === 'author') {
		        $this->init_pagination(!empty($segments[2]) ? $segments[2] : 1);
		        return $this->display_list_author($args);
	        } else if ($segments[0] === 'tag') {
		        $this->init_pagination(!empty($segments[2]) ? $segments[2] : 1);
		        return $this->display_list_tag($args);
	        }

	        throw new \Nos\NotFoundException();
        }

        $this->init_pagination(1);
        return $this->display_list_main($args);
    }

    protected function init_pagination($page) {
        $this->current_page = $page;
        $this->pagination   = new \Nos\Pagination();
    }

    public function display_list_main($params) {

        $list = $this->_display_list('list_main');

        $self   = $this;
        $class = get_class($this);

        // Add surrounding stuff
        return View::forge($this->config['list_view'], array(
            'list'       => $list,
            'pagination' => $this->pagination->create_links(function($page) use ($class, $self) {
                if ($page == 1) {
                    return mb_substr($self->main_controller->getEnhancedUrlPath(), 0, -1).'.html';
                }
                return $self->main_controller->getEnhancedUrlPath().'page/'.$page.'.html';
            }),
        ), false);
    }

    public function display_list_tag($params) {

        list(, $tag) = $this->enhancerUrl_segments;
        $this->tag = Model_Tag::forge(array(
            'tag_label' => strtolower($tag),
        ));


        $class = get_called_class();
        $self  = $this;
        $url   = $this->main_controller->getUrl();

        $link_to_tag = function($tag, $page = 1) use($self, $url) {
            return $self::get_url_model($tag, array('page' => $page)); //, 'urlPath' => $url
        };
        $link_pagination = function($page) use ($link_to_tag, $self) {
            return $link_to_tag($self->tag, $page);
        };

        $list = $this->_display_list('tag');

        // Add surrounding stuff
        return View::forge('front/list_tag', array(
            'list'        => $list,
            'pagination'  => $this->pagination->create_links($link_pagination),
            'tag'         => $this->tag,
            'link_to_tag' => $link_to_tag,
        ), false);
    }

    public function display_list_author($cat_id) {

        list(,,$cat_id, $page) = $this->enhancerUrl_segments;

        $this->author = \Nos\Monkey\Model_Species::find($cat_id);
        $list = $this->_display_list('author');

        $class = get_called_class();
        $self  = $this;
        $url   = $this->main_controller->getUrl();

        $link_to_author = function($author, $page = 1) use($self, $url) {
            return $self::get_url_model($author, array('page' => $page)); //, 'urlPath' => $url
        };
        $link_pagination = function($page) use ($link_to_author, $self) {
            return $link_to_author($self->author, $page);
        };

        // Add surrounding stuff
        echo View::forge($this->config['list_view'], array(
            'list'           => $list,
            'pagination'     => $this->pagination->create_links($link_pagination),
            'author'         => $this->author,
            'link_to_author' => $link_to_author,
        ), false);
    }

    /**
     * Display several items (from a list context)
     *
     * @param   string  $context = list_main | list_author | list_tag
     */
    protected function _display_list($context = 'list_main') {

        // Allow events for each or all context
        $this->trigger('display_list');
        $this->trigger("display_{$context}");


        $this->config = \Arr::merge($this->config, $this->default_config['display_list'], $this->default_config["display_{$context}"]);


        // Get the list of posts
        $query = Model_Monkey::query()
                ->related(array('author'));

        $query->where(array('item_published', true));

		$query->where(array('item_lang', $this->page_from->page_lang));


        if (!empty($this->author)) {
            $query->where(array('item_cat_id', $this->author->cat_id));
        }
        if (!empty($this->tag)) {
            $query->related(array('tags'));
            $query->where(array('tags.tag_label', $this->tag->tag_label));
        }



        $this->pagination->set_config(array(
            'total_items'    => $query->count(),
            'per_page'       => $this->config['item_per_page'],
            'current_page'   => $this->current_page,
        ));

        $query->rows_offset($this->pagination->offset);
        $query->rows_limit((int)$this->pagination->per_page);
        //$query->group_by('item_id');


        $query->order_by($this->config['order_by']);

        $posts = $query->get();

        // Re-fetch with a 2nd request to get all the relations (not only the filtered ones)
        if (!empty($this->tag)) {
            $keys = array_keys((array) $posts);
            $posts = Model_Monkey::query(array(
                'where' => array(
                    array('item_id', 'IN', $keys),
                ),
                'related' => array('author', 'tags'),
            ))->get();
        }

        // Display them
        return $this->_display_items($posts, $context);
    }

    /**
     * Display several items (from a list context)
     *
     * @param   array   $items
     * @param   string  $context = list_main | list_author | list_tag
     * @return  string  Rendered view
     */
    protected function _display_items($items, $context = 'list_main')  {

        $retrieve_stats = !empty($this->config['stats']) && $this->config['stats'];
        $comments_count = array();

        $ids = array();
        foreach ($items as $post) {
            $ids[] = $post->item_id;
        }

        if ($retrieve_stats) {

            // Retrieve the comment counts for each post (1 request)
            $comments_count = \Db::select(\Db::expr('COUNT(comm_id) AS count_result'), 'comm_parent_id')
                    ->from(\Nos\Monkey\Model_Comment::table())
                    ->and_where('comm_type', '=', 'item')
                    ->and_where('comm_parent_id', 'in', $ids)
                    ->group_by('comm_parent_id')
                    ->execute()->as_array();
            $comments_count = \Arr::assoc_to_keyval($comments_count, 'comm_parent_id', 'count_result');

        }

        // Loop meta-data
        $length = count($items);
        $index  = 1;
        $output = array();

        // Events based on current iteration
        $this->trigger('display_list_item');
        $this->trigger("display_{$context}_item");
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
                'first'  => $index == 1,
                'last'   => $index++ == $length,
            );

            $this->trigger('display_list_item_loop');
            $this->trigger("display_{$context}_item_loop");

            if ($this->loop['first']) {
                $this->merge_config('display_list_item_first');
                $this->merge_config("display_{$context}_item_first");
            } else {
                $this->merge_config('display_list_item_following');
                $this->merge_config("display_{$context}_item_following");
            }

            $output[] = $this->_display_item($item, array(
                'comment_count' => isset($comments_count[$item->item_id]) ? $comments_count[$item->item_id] : null,
            ));
        }
        return implode('', $output);
    }

    /**
     * Display a single item (outside a list context)
     *
     * @param   type  $item_id
     * @return  \Fuel\Core\View
     */
    public function display_item($args) {
        if ($this->config['use_recaptcha']) {
            \Package::load('fuel-recatpcha', APPPATH.'packages/fuel-recaptcha/');
        }

        list($item_virtual_name) = $this->enhancerUrl_segments;

        $post = $this->_get_post(array(array('item_virtual_name', '=', $item_virtual_name), array('item_lang', '=', $this->page_from->page_lang)));

        if (empty($post)) {
            throw new \Nos\NotFoundException();
        }
        $add_comment_success = $this->_add_comment($post);

        $this->trigger('display_item');
        $this->merge_config('display_item');

        echo $this->_display_item($post, array('add_comment_success' => $add_comment_success, 'use_recaptcha' => $this->config['use_recaptcha']));
    }

    protected function _get_post($where = array()) {
        // First argument is a string => it's the virtual name
        if (!is_array($where)) {
            $where = array(array('item_virtual_name', '=', $where));
        }

        if (!$this->main_controller->isPreview()) {
            $where[] = array('item_published', '=', true);
        }
        return Model_Monkey::find('first', array('related' => array('comments' => array('order_by' => array('comm_created_at' => 'ASC'))), 'where' => $where));
    }

    protected function _add_comment($post) {
        if (\Input::post('todo') == 'add_comment') {
            if (!$this->config['use_recaptcha'] || \ReCaptcha\ReCaptcha::instance()->check_answer(\Input::real_ip(), \Input::post('recaptcha_challenge_field'), \Input::post('recaptcha_response_field')))
            {
                $comm = new Model_Comment();
                $comm->comm_type = 'item';
                $comm->comm_email = \Input::post('comm_email');
                $comm->comm_author = \Input::post('comm_author');
                $comm->comm_content = \Input::post('comm_content');
                $date = new \Fuel\Core\Date();
                $comm->comm_created_at = \Date::forge()->format('mysql');
                $comm->post = $post;
                $comm->comm_state = $this->config['comment_default_state'];
                $comm->save();

                \Cookie::set('comm_email', \Input::post('comm_email'));
                \Cookie::set('comm_author', \Input::post('comm_author'));
                return true;
            } else {
                return false;
            }
        }
        return 'none';
    }

    /**
     *  Display a single item (from any context)
     *
     * @param   \Nos\Monkey\Model_Monkey  $item  An instance of the model
     * @param   array                 $data  Additionnal data to pass to the view
     *  - comment_count : the number of comment for this post
     * @return  \Fuel\Core\View
     */
    protected function _display_item($item, $data = array()) {

        $data['date_format'] = $this->config['date_format'];
        $data['title_tag']   = $this->config['title_tag'];

        // Main data from model, probably not needed thanks to Orm\Observers\Typing
        $data['created_at'] = strtotime($item['item_created_at']);

        // Additional data calculated per-item
        $data['link_to_author'] = $item->author ? self::get_url_model($item->author) : '';
        $data['link_to_item']   = self::get_url_model($item);
        $data['link_on_title']  = $this->config['link_on_title'] ? $data['link_to_item'] : false;
        $data['link_to_stats']  = $this->url_stats($item);

        $self = get_called_class();
        $url  = $this->main_controller->getUrl();
        $data['link_to_tag'] = function($tag, $page = 1) use($self, $url) {
            return $self::get_url_model($tag, array('page' => $page)); //, 'urlPath' => $url
        };

        // Renders all the fields
        $fields = array();
        foreach (preg_split('/[\s,-]+/u', $this->config['fields']) as $field) {
            $view = isset($this->views[$field]) ? $this->views[$field] : $this->config['fields_view'];
            $data['display'] = array($field => true);
            $data['item']    = $item;
            $view = static::get_view($view);
            $view->set($data);
            $view->set('item', $item, false);
            $fields[$field] = $view;
        }
        $view = static::get_view($this->config['item_view']);
        $view->set($data + $fields, null, false);
        return $view;
    }

    public static function get_view($which) {
        // Cache views
        static $views = array();
        if (empty($views[$which])) {
            $views[$which] = View::forge($which);
        }
        // Return empty views
        return clone $views[$which];
    }

    protected function url_stats($item) {
        return $this->main_controller->getEnhancedUrlPath().'stats/'.urlencode($item->item_id).'.html';
    }

	static function get_url_model($item, $params = array()) {
		$model = get_class($item);
		$url = isset($params['urlPath']) ? $params['urlPath'] : \Nos\Nos::main_controller()->getEnhancedUrlPath();
		$page = isset($params['page']) ? $params['page'] : 1;

		switch ($model) {
			case 'Nos\Monkey\Model_Monkey' :
				return $url.urlencode($item->item_virtual_name).'.html';
				break;

			case 'Nos\Monkey\Model_Tag' :
				return $url.'tag/'.urlencode($item->tag_label).($page > 1 ? '/'.$page : '').'.html';
				break;

			case 'Nos\Monkey\Model_Species' :
				return $url.'author/'.urlencode($item->fullname()).($page > 1 ? '/'.$page : '').'.html';
				break;
		}
        return false;
	}
}
