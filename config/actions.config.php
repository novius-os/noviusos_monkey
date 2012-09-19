<?php
return array(
    'Nos\Monkey\Model_Monkey.add' => array(
        'label' => __('Add a monkey'),
        'action' => array(
            'action' => 'nosTabs',
            'method' => 'add',
            'tab' => array(
                'url' => 'admin/noviusos_monkey/monkey/insert_update?lang={{lang}}',
                'label' => __('Add a new monkey'),
            ),
        ),

        'type' => 'add'
    ),
    'Nos\Monkey\Model_Monkey.edit' => array(
        'action' => array(
            'action' => 'nosTabs',
            'tab' => array(
                'url' => "admin/noviusos_monkey/monkey/insert_update/{{id}}",
                'label' => __('Edit'),
            ),
        ),
        'label' => __('Edit'),
        'primary' => true,
        'icon' => 'pencil',
        'type' => 'item'
    ),
    'Nos\Monkey\Model_Monkey.delete' => array(
        'action' => array(
            'action' => 'confirmationDialog',
            'dialog' => array(
                'contentUrl' => 'admin/noviusos_monkey/monkey/delete/{{id}}',
                'title' => __('Delete a monkey'),
            ),
        ),
        'label' => __('Delete'),
        'primary' => true,
        'icon' => 'trash',
        'type' => 'item'
    ),
    'Nos\Monkey\Model_Monkey.visualise' => array(
        'label' => 'Visualise',
        'primary' => true,
        'iconClasses' => 'nos-icon16 nos-icon16-eye',
        'action' => array(
            'action' => 'window.open',
            'url' => '{{url}}?_preview=1'
        ),
        'enabled' =>  function($item, $context = array()) {
            $url = $item->url_canonical(array('preview' => true));

            return !empty($url);
        },
        'type' => 'item'
    ),
    'Nos\Monkey\Model_Species.add' => array(
        'label' => __('Add a species'),
        'action' => array(
            'action' => 'nosTabs',
            'method' => 'add',
            'tab' => array(
                'url' => 'admin/noviusos_monkey/species/insert_update?lang={{lang}}',
                'label' => 'Add a species'
            ),
        ),
        'type' => 'add'
    ),
    'Nos\Monkey\Model_Species.edit' => array(
        'action' => array(
            'action' => 'nosTabs',
            'tab' => array(
                'url' => "admin/noviusos_monkey/species/insert_update/{{id}}",
                'label' => __('Edit'),
            ),
        ),
        'label' => __('Edit'),
        'name' => 'edit',
        'primary' => true,
        'icon' => 'pencil',
        'type' => 'item'
    ),
    'Nos\Monkey\Model_Species.delete' => array(
        'action' => array(
            'action' => 'confirmationDialog',
            'dialog' => array(
                'contentUrl' => 'admin/noviusos_monkey/species/delete/{{id}}',
                'title' => __('Delete a species'),
            ),
        ),
        'label' => __('Delete'),
        'name' => 'delete',
        'primary' => true,
        'icon' => 'trash',
        'type' => 'item'
    ),
);