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
    'data_mapping' => array(
        'monk_name' => array(
            'title'    => __('Name')
        ),
        'context' => true,
        'species' => array(
            'title' => __('Species'),
            'value' => function($item) {
                return $item->species ? $item->species->mksp_title : __('None');
            },
        ),
        'monk_published' => array(
            'title' => __('Status'),
            'method' => 'publication_status',
            'multiContextHide' => true,
        ),
        'preview_url' => array(
            'method' => 'preview_url',
        ),
    ),
    'query' => array(
        'model' => 'Nos\Monkey\Model_Monkey',
        'related' => array('species'),
        'order_by' => array('monk_name' => 'ASC'),
        'limit' => 20,
    ),
);
