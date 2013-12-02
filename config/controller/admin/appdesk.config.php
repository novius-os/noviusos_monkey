<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

Nos\I18n::current_dictionary(array('noviusos_monkey::common', 'nos::common'));

return array(
    'model' => 'Nos\Monkey\Model_Monkey',
    'inspectors' => array('species'),
    'search_text' => 'monk_name',
    'i18n' => array(
        'item' => __('monkey'),
        'items' => __('monkeys'),
        'NItems' => n__(
            '1 monkey',
            '{{count}} monkeys'
        ),
        'showNbItems' => n__(
            'Showing 1 monkey out of {{y}}',
            'Showing {{x}} monkeys out of {{y}}'
        ),
        'showNoItem' => __('No monkey'),
        'showAll' => __('Showing all monkeys'),
    ),
);
