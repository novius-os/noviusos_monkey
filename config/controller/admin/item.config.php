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
    'base_url'  => 'admin/noviusos_monkey/item',
    'blank_state_item_text' => __('post'),
    'tabInfos' => array(
        'label' => function($item) {
            return $item->is_new() ? __('Add a post') : $item->item_title;
        },
        'iconUrl' => 'static/apps/noviusos_monkey/img/16/monkey.png',
    ),
    'tabInfosBlankSlate' => array(
        'label' => __('Translate a post'),
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
);