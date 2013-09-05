<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

return array (
    'controller_url'  => 'admin/noviusos_monkey/species',
    'model' => 'Nos\\Monkey\\Model_Species',
    'messages' => array(
        'successfully added' => __('Species successfully added.'),
        'successfully saved' => __('Species successfully saved.'),
        'successfully deleted' => __('The species has successfully been deleted!'),
        'you are about to delete, confim' => __('You are about to delete the species <span style="font-weight: bold;">":title"</span>. Are you sure you want to continue?'),
        'you are about to delete' => __('You are about to delete the species <span style="font-weight: bold;">":title"</span>.'),
        'exists in multiple context' => __('This species exists in <strong>{count} contextuages</strong>.'),
        'delete in the following contextuages' => __('Delete this species in the following contextuages:'),
        'item deleted' => __('This species has been deleted.'),
        'not found' => __('Species not found'),
        'error added in context not parent' => __('This species cannot be added {context} because its {parent} is not available in this contextuage yet.'),
        'error added in context' => __('This species cannot be added {context}.'),
        'item inexistent in context yet' => __('This species has not been added in {context} yet.'),
        'add an item in context' => __('Add a new species in {context}'),
        'delete an item' => __('Delete a species'),
    ),
    'tab' => array(
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
            'renderer' => 'Nos\Renderer_Virtualname',
            'template' => '<th>{label}{required}</th><td><div class="table-field">{field} <span>&nbsp;.html</span></div>{use_title_checkbox}</td>',
            'validation' => array(
                'required',
                'min_length' => array(2),
            ),
        ),
    ),
);
