<?php
return array(

    'date_format'   => '%A %e %B %Y',
    'link_on_title' => false,
    'item_per_page' => 10,

    // List view
    'display_list' => array(
        'order_by'    => array('item_created_at' => 'DESC', 'item_id' => 'DESC'),
    ),

    'display_list_main' => array(
        'list_view'   => 'front/list',
    ),

    'display_author' => array(
        'list_view'   => 'front/list_author',
    ),

    'display_tag' => array(
        'list_view'   => 'front/list_tag',
    ),

    // Item view
    'display_list_item' => array(
        'fields'      => 'title author date thumbnail summary tags stats',
        'title_tag'   => 'h2',
        'item_view'   => 'front/item_list',
        'fields_view' => 'front/fields',
    ),

    'display_item' => array(
        'fields'      => 'title author date thumbnail summary tags stats wysiwyg',
        'title_tag'   => 'h1',
        'item_view'   => 'front/item',
        'fields_view' => 'front/fields',
    ),
    'use_recaptcha' => false, // If you set this on true don't forget to add fuel-recaptcha on local/packages/fuel-recaptcha
    'comment_default_state' => 'published'
);
?>
