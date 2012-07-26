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

    'date_format'   => '%A %e %B %Y',
    'item_per_page' => 10,

    // List view
    'display_list' => array(
        'order_by' => array('monk_name' => 'ASC', 'monk_id' => 'DESC'),
    ),

    'display_monkeys' => array(
        'list_view' => 'front/list',
    ),

    'display_species' => array(
        'list_view' => 'front/list_species',
    ),

    // Item view
    'display_list_item' => array(
        'fields' => 'name species thumbnail',
        'item_view' => 'front/item_list',
        'fields_view' => 'front/fields',
    ),

    'display_monkey' => array(
        'fields' => 'name species date thumbnail summary wysiwyg',
        'item_view' => 'front/item',
        'fields_view' => 'front/fields',
    ),
);
