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
    'name'    => 'Monkey : Novius OS Application Bootstrap',
    'version' => 'chiba.2',
    'provider' => array(
        'name' => 'Provider',
    ),
    'namespace' => 'Nos\Monkey',
    'permission' => array(

    ),
    'launchers' => array(
        'noviusos_monkey' => array(
            'name'    => 'Monkey',
            'action' => array(
                'action' => 'nosTabs',
                'tab' => array(
                    'url' => 'admin/noviusos_monkey/appdesk',
                    'iconUrl' => 'static/apps/noviusos_monkey/img/32/monkey.png',
                ),
            ),
        ),
    ),
    'enhancers' => array(
        'noviusos_monkey' => array(
            'title' => 'Monkey',
            'desc'  => '',
            //'enhancer' => 'noviusos_monkey/front',
            'urlEnhancer' => 'noviusos_monkey/front/main',
            'iconUrl' => 'static/apps/noviusos_monkey/img/16/monkey.png',
            'dialog' => array(
                'contentUrl' => 'admin/noviusos_monkey/enhancer/popup',
                'width' => 450,
                'height' => 200,
                'ajax' => true,
            ),
        ),
    ),
    'icons' => array(
        16  => 'static/apps/noviusos_monkey/img/16/monkey.png',
        32 => 'static/apps/noviusos_monkey/img/32/monkey.png',
        64    => 'static/apps/noviusos_monkey/img/64/monkey.png',
    ),
);
