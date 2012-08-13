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
    'controller_url'  => 'admin/noviusos_monkey/monkey',
    'model' => 'Nos\\Monkey\\Model_Monkey',
    'messages' => array(
        'successfully added' => __('Monkey successfully added.'),
        'successfully saved' => __('Monkey successfully saved.'),
        'successfully deleted' => __('The monkey has successfully been deleted!'),
        'you are about to delete, confim' => __('You are about to delete the monkey <span style="font-weight: bold;">":title"</span>. Are you sure you want to continue?'),
        'you are about to delete' => __('You are about to delete the monkey <span style="font-weight: bold;">":title"</span>.'),
        'exists in multiple lang' => __('This monkey exists in <strong>{count} languages</strong>.'),
        'delete in the following languages' => __('Delete this monkey in the following languages:'),
        'item deleted' => __('This monkey has been deleted.'),
        'not found' => __('Monkey not found'),
        'blank_state_item_text' => __('monkey'),
    ),
    'tab' => array(
        'iconUrl' => 'static/apps/noviusos_monkey/img/16/monkey.png',
        'labels' => array(
            'insert' => __('Add a monkey'),
            'blankSlate' => __('Translate a monkey'),
        ),
    ),
    'layout' => array(
        'title' => 'monk_name',
        'medias' => array('medias->thumbnail->medil_media_id'),
        'large' => true,
        'subtitle' => array('monk_species_id'),
        'content' => array(
            'expander' => array(
                'view' => 'nos::form/expander',
                'params' => array(
                    'title'   => __('content'),
                    'options' => array(
                        'allowExpand' => false,
                    ),
                    'content' => array(
                        'view' => 'nos::form/fields',
                        'params' => array(
                            'field_template' => '{field}',
                            'fields' => array(
                                'monk_summary',
                                'wysiwygs->content->wysiwyg_text',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'menu' => array(
            'expander' => array(
                'view' => 'nos::form/expander',
                'params' => array(
                    'title'   => __('Meta'),
                    'options' => array(
                        'allowExpand' => false,
                    ),
                    'content' => array(
                        'view' => 'nos::form/fields',
                        'params' => array(
                            'fields' => array(
                                'monk_virtual_name',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'save' => 'save',
    ),
    'fields' => array(
        'medias->thumbnail->medil_media_id' => array(
            'label' => '',
            'widget' => 'Nos\Widget_Media',
            'form' => array(
                'title' => 'Thumbnail',
            ),
        ),
        'monk_name' => array (
            'label' => __('Name'),
            'form' => array(
                'type' => 'text',
            ),
            'validation' => array(
                'required',
                'min_length' => array(2),
            ),
        ),
        'monk_summary' => array (
            'label' => __('Summary'),
            'form' => array(
                'type' => 'textarea',
                'rows' => '6',
            ),
        ),
        'wysiwygs->content->wysiwyg_text' => array(
            'label' => __('Content'),
            'widget' => 'Nos\Widget_Wysiwyg',
            'form' => array(
                'style' => 'width: 100%; height: 500px;',
            ),
        ),
        'monk_species_id' => array(
            'label' => 'Species: ',
            'form' => array(
                'type' => 'select',
            ),
        ),
        'monk_virtual_name' => array(
            'label' => __('URL: '),
            'widget' => 'Nos\Widget_Virtualname',
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