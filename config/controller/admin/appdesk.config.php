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
		'related' => array('breed'),
        'order_by' => array('monk_name' => 'ASC'),
		'limit' => 20,
	),
	'search_text' => 'monk_name',
	'selectedView' => 'default',
	'views' => array(
		'default' => array(
			'name' => __('Default view'),
			'json' => array('static/apps/noviusos_monkey/js/admin/monkey.js'),
		),
	),
	'dataset' => array(
		'id' => 'monk_id',
		'name' => 'monk_name',
		'breed' => array(
			'search_relation' => 'breed',
			'search_column'   => 'breed.mkbr_title',
			'value' =>  'mkbr_title',
		),
		'url' => array(
			'value' => function($object) {
				return $object->first_url();
			},
		),
		'actions' => array(
			'visualise' => function($object) {
				$url = $object->first_url();
				return !empty($url);
			}
		),
	),
	'inputs' => array(
		'monk_breed_id' => function($value, $query) {
			if ( is_array($value) && count($value) && $value[0]) {
				$query->where(array('monk_breed_id', 'in', $value));
			}
			return $query;
		},
	),
);