<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */
return array(
    'query' => array(
        'model' => 'Nos\Monkey\Model_Monkey',
        'related' => array('species'),
        'order_by' => array('monk_name' => 'ASC'),
        'limit' => 20,
    ),
    'search_text' => 'monk_name',
    'dataset' => array(
        'name' => array(
            'column'        => 'monk_name',
            'headerText'    => __('Name')
        ),
        'context' => true,
        'species' => array(
            'value' => function($item) {
                return $item->species->mksp_title;
            },
            'headerText' => __('Species'),
        ),
        'published' => true,
        'preview_url' => array(
            'value' => function($item) {
                return $item->preview_url();
            },
            'visible' => false
        ),
        /*
        'url' => array(
            'value' => function($item) {
                return $item->url_canonical(array('preview' => true));
            },
        ),
        'actions' => array(
            'visualise' => function($item) {
                $url = $item->url_canonical(array('preview' => true));

                return !empty($url);
            }
        ),
        */
    ),
);
