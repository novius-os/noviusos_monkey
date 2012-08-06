<?php
return array (
    'controller_url'  => 'admin/noviusos_monkey/species',
    'model' => 'Nos\\Monkey\\Model_Species',
    'messages' => array(
        'successfully added' => __('Species successfully added.'),
        'successfully saved' => __('Species successfully saved.'),
        'successfully deleted' => __('The species has successfully been deleted!'),
        'you are about to delete, confim' => __('You are about to delete the species <span style="font-weight: bold;">":title"</span>. Are you sure you want to continue?'),
        'you are about to delete' => __('You are about to delete the species <span style="font-weight: bold;">":title"</span>.'),
        'exists in multiple lang' => __('This species exists in <strong>{count} languages</strong>.'),
        'delete in the following languages' => __('Delete this species in the following languages:'),
        'item deleted' => __('This species has been deleted.'),
        'not found' => __('Species not found'),
        'blank_state_item_text' => __('species'),
    ),
    'tab' => array(
        'iconUrl' => 'static/apps/noviusos_monkey/img/16/monkey.png',
        'labels' => array(
            'insert' => __('Add a species'),
            'blankSlate' => __('Translate a species'),
        ),
    ),
    'layout' => array(
        'title' => 'mksp_title',
        'large' => true,
        'content' => array(
            'expander' => array(
                'view' => 'nos::form/expander',
                'params' => array(
                    'title'   => '',
                    'nomargin' => true,
                    'options' => array(
                        'allowExpand' => false,
                    ),
                    'content' => array(
                        'view' => 'nos::form/fields',
                        'params' => array(
                            'begin' => '<table class="fieldset">',
                            'fields' => array(
                                'mksp_virtual_name',
                            ),
                            'end' => '</table>',
                        ),
                    ),
                ),
            ),
        ),
        'save' => 'save',
    ),
    'fields' => array(
        'mksp_title' => array (
            'label' => __('Species'),
            'form' => array(
                'type' => 'text',
            ),
            'validation' => array(
                'required',
                'min_length' => array(2),
            ),
        ),
        'mksp_virtual_name' => array(
            'label' => __('URL: '),
            'form' => array(
                'type' => 'text',
            ),
            'validation' => array(
                'required',
                'min_length' => array(2),
            ),
        ),
        'save' => array(
            'label' => '',
            'form' => array(
                'type' => 'submit',
                'tag' => 'button',
                'value' => __('Save'),
                'class' => 'primary',
                'data-icon' => 'check',
            ),
        ),
    ),
);
