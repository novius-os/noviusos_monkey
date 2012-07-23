<?php
return array (
    'controller_url'  => 'admin/noviusos_monkey/breed',
    'model' => 'Nos\\Monkey\\Model_Breed',
    'messages' => array(
        'successfully added' => __('Breed successfully added.'),
        'successfully saved' => __('Breed successfully saved.'),
        'item deleted' => __('This breed has been deleted.'),
        'blank_state_item_text' => __('breed'),
    ),
    'tab' => array(
        'iconUrl' => 'static/apps/noviusos_monkey/img/16/monkey.png',
        'labels' => array(
            'update' => 'mkbr_title',
            'insert' => __('Add a breed'),
            'blankSlate' => __('Translate a breed'),
        ),

        'actions' => array(
            'visualise' => function($item) {
                return array(
                    'label' => __('Visualise'),
                    'action' => array(
                        'openWindow' => $item->first_url() . '?_preview=1',
                    ),
                    'iconClasses' => 'nos-icon16 nos-icon16-eye',
                );
            }
        ),
    ),
    'layout' => array(
        'title' => 'mkbr_title',
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
                                'mkbr_virtual_name',
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
        'mkbr_id' => array (
            'label' => __('Id: '),
            'widget' => 'Nos\Widget_Text',
            'editable' => false,
        ),
        'mkbr_title' => array (
            'label' => __('Breed'),
            'form' => array(
                'type' => 'text',
            ),
            'validation' => array(
                'required',
                'min_length' => array(2),
            ),
        ),
        'mkbr_virtual_name' => array(
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
