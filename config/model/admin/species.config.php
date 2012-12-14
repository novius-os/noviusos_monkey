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
    'dataset' => array(
        'title' => array(
            'column'        => 'mksp_title',
            'title'    => __('Species')
        ),
    )
);