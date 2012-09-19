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
    'model' => 'Nos\Monkey\Model_Monkey',
    'inputs' => array(
        'monk_species_id' => function($value, $query) {
            if ( is_array($value) && count($value) && $value[0]) {
                $query->where(array('monk_species_id', 'in', $value));
            }

            return $query;
        },
    ),
    'splittersVertical' => 250,
    'appdesk' => array(
        'tab' => array(
            'label' => __('Monkey'),
            'iconUrl' => 'static/apps/noviusos_monkey/img/32/monkey.png'
        ),
        'appdesk' => array(
            'inspectors' => array('species')
        ),
    ),
);
