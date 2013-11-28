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
    'application' => array(
        'name'  => __('Monkey'),
        'actions' => array(
            /*'crud' => array('Nos\Monkey\Model_Monkey', 'Nos\Monkey\Model_Species')*/
            'crud' => array(
                'Nos\Monkey\Model_Monkey' => array(
                    'labels' => array(
                        'add' => __('Add a monkey'),
                    ),
                ),
                'Nos\Monkey\Model_Species' => array(
                    'labels' => array(
                        'add' => __('Add a species'),
                    ),
                )
            ),
        )
    )
);
