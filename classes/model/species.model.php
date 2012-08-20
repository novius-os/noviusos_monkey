<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

namespace Nos\Monkey;

class Model_Species extends \Nos\Orm\Model {
    protected static $_table_name = 'nos_monkey_species';
    protected static $_primary_key = array('mksp_id');

    protected static $_observers = array(
        'Orm\\Observer_CreatedAt' => array(
            'property' => 'mksp_created_at',
        ),
        'Orm\\Observer_UpdatedAt' => array(
            'property' => 'mksp_updated_at',
        ),
    );

    protected static $_behaviours = array(
        'Nos\Orm_Behaviour_Translatable' => array(
            'events' => array('before_insert', 'after_insert', 'before_save', 'after_delete', 'change_parent'),
            'lang_property'      => 'mksp_lang',
            'common_id_property' => 'mksp_lang_common_id',
            'single_id_property' => 'mksp_lang_single_id',
            'invariant_fields'   => array(),
        ),
        'Nos\Orm_Behaviour_Url' => array(),
        'Nos\Orm_Behaviour_Virtualname' => array(
            'events' => array('before_save', 'after_save'),
            'virtual_name_property' => 'mksp_virtual_name',
        ),
    );

    public function get_possible_lang() {
        return array_keys(\Config::get('locales'));
    }
}

