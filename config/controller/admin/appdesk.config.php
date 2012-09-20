<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */
use Nos\I18n;

I18n::load('noviusos_monkey::item');

return array(
    'query' => array(
        'model' => 'Nos\Monkey\Model_Monkey',
        'related' => array('species'),
        'order_by' => array('monk_name' => 'ASC'),
        'limit' => 20,
    ),
    'search_text' => 'monk_name',
    'selectedView' => 'default',
    'views' => array(
        'default' => array(
            'name' => __('Default view'),
        ),
    ),
    'i18n' => array(
        'addDropDown' => __('Select an action'),
        'columns' => __('Columns'),
        'showFiltersColumns' => __('Filters column header'),
        'visibility' => __('Visibility'),
        'settings' => __('Settings'),
        'vertical' => __('Vertical'),
        'horizontal' => __('Horizontal'),
        'hidden' => __('Hidden'),
        'item' => __('monkey'),
        'items' => __('Monkeys'),
        'showNbItems' => __('Showing {{x}} monkeys out of {{y}}'),
        'showOneItem' => __('Show 1 monkey'),
        'showNoItem' => __('No monkey'),
        'showAll' => __('Show all monkeys'),
        'views' => __('Views'),
        'viewGrid' => __('Grid'),
        'viewTreeGrid' => __('Tree grid'),
        'viewThumbnails' => __('Thumbnails'),
        'preview' => __('Preview'),
        'loading' => __('Loading...'),
        'languages' => __('Languages'),
    ),
    'dataset' => array(
        'id' => 'monk_id',
        'name' => 'monk_name',
        'species' => array(
            'value' => function ($item) {
                return $item->species->mksp_title;
            },
        ),
        'url' => array(
            'value' => function ($item) {
                return $item->url_canonical(array('preview' => true));
            },
        ),
        'actions' => array(
            'visualise' => function ($item) {
                $url = $item->url_canonical(array('preview' => true));

                return !empty($url);
            }
        ),
    ),
    'inputs' => array(
        'monk_species_id' =>
            function ($value, $query)
            {
                if (is_array($value) && count($value) && $value[0]) {
                    $query->where(array('monk_species_id', 'in', $value));
                }

                return $query;
            },
    ),
    'appdesk' => array(
        'tab' => array(
            'label' => __('Monkey'),
            'iconUrl' => 'static/apps/noviusos_monkey/img/32/monkey.png'
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
            ),
        ),
        'reloadEvent' => 'Nos\\Monkey\\Model_Monkey',
        'appdesk' => array(
            'buttons' => array(
                'monkey' => array(
                    'label' => __('Add a monkey'),
                    'action' => array(
                        'action' => 'nosTabs',
                        'method' => 'add',
                        'tab' => array(
                            'url' => 'admin/noviusos_monkey/monkey/insert_update?lang={{lang}}',
                            'label' => __('Add a new monkey'),
                        ),
                    ),
                ),
                'species' => array(
                    'label' => __('Add a species'),
                    'action' => array(
                        'action' => 'nosTabs',
                        'method' => 'add',
                        'tab' => array(
                            'url' => 'admin/noviusos_monkey/species/insert_update?lang={{lang}}',
                            'label' => 'Add a species'
                        ),
                    ),
                ),
            ),
            'splittersVertical' => 250,
            'grid' => array(
                'urlJson' => 'admin/noviusos_monkey/appdesk/json',
                'columns' => array(
                    'name' => array(
                        'headerText' => __('Name'),
                        'dataKey' => 'name'
                    ),
                    'lang' => array(
                        'lang' => true
                    ),
                    'species' => array(
                        'headerText' => __('Species'),
                        'dataKey' => 'species'
                    ),
                    'published' => array(
                        'headerText' => __('Status'),
                        'dataKey' => 'publication_status'
                    ),
                    'actions' => array(
                        'actions' => array('update', 'delete', 'visualise'),
                    ),
                ),
            ),
            'inspectors' => array(
                'species' => array(
                    'reloadEvent' => 'Nos\\Monkey\\Model_Species',
                    'label' => __('Speciess'),
                    'url' => 'admin/noviusos_monkey/inspector/species/list',
                    'langChange' => true,
                    'grid' => array(
                        'columns' => array(
                            'title' => array(
                                'headerText' => __('Species'),
                                'dataKey' => 'title'
                            ),
                            'actions' => array(
                                'showOnlyArrow' => true,
                                'actions' => array(
                                    array(
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
                                        'icon' => 'pencil'
                                    ),
                                    array(
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
                                        'icon' => 'trash'
                                    ),
                                ),
                            ),

                        ),
                        'urlJson' => 'admin/noviusos_monkey/inspector/species/json'
                    ),
                    'inputName' => 'monk_species_id[]',
                    'vertical' => true
                ),
            ),
        ),
    ),
);
