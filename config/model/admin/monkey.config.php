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
    'dataset' => array(
        'id' => 'monk_id',
        'name' => array(
            'column'        => 'monk_name',
            'headerText'    => __('Name')
        ),
        'lang' => true,
        'species' => array(
            'value' => function($item) {
                return $item->species->mksp_title;
            },
            'headerText' => __('Species'),
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
    'actions' => array(
        'update' => array(
            'action' => array(
                'action' => 'nosTabs',
                'tab' => array(
                    'url' => "admin/noviusos_monkey/monkey/insert_update/{{id}}",
                    'label' => __('Edit'),
                ),
            ),
            'label' => __('Edit'),
            'primary' => true,
            'icon' => 'pencil'
        ),
        'delete' => array(
            'action' => array(
                'action' => 'confirmationDialog',
                'dialog' => array(
                    'contentUrl' => 'admin/noviusos_monkey/monkey/delete/{{id}}',
                    'title' => __('Delete a monkey'),
                ),
            ),
            'label' => __('Delete'),
            'primary' => true,
            'icon' => 'trash'
        ),
        'visualise' => array(
            'label' => 'Visualise',
            'primary' => true,
            'iconClasses' => 'nos-icon16 nos-icon16-eye',
            'action' => array(
                'action' => 'window.open',
                'url' => '{{url}}?_preview=1'
            ),
            'enabled' =>  function($item, $context) {
                $url = $item->url_canonical(array('preview' => true));

                return !empty($url);
            }
        )
        /*'crud' => 'monkey', 'additionnals' => */,
    )
);
