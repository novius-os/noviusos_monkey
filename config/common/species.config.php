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
    'query' => array(
        'model' => 'Nos\Monkey\Model_Species',
        'order_by' => array('mksp_title' => 'ASC'),
    ),
    'data_mapping' => array(
        'mksp_title' => array(
            'title'    => __('Species')
        ),
    )
);