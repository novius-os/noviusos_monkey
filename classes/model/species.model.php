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

class Model_Species extends \Nos\Orm\Model
{
    protected static $_table_name = 'nos_monkey_species';
    protected static $_primary_key = array('mksp_id');

    protected static $_title_property = 'mksp_title';
    protected static $_properties = array(
        'mksp_id' => array(
            'default' => null,
            'data_type' => 'int',
            'null' => false,
        ),
        'mksp_context' => array(
            'default' => null,
            'data_type' => 'varchar',
            'null' => false,
        ),
        'mksp_context_common_id' => array(
            'default' => null,
            'data_type' => 'int',
            'null' => false,
        ),
        'mksp_context_is_main' => array(
            'default' => 0,
            'data_type' => 'tinyint',
            'null' => false,
        ),
        'mksp_title' => array(
            'default' => '',
            'data_type' => 'varchar',
            'null' => false,
        ),
        'mksp_virtual_name' => array(
            'default' => null,
            'data_type' => 'varchar',
            'null' => false,
        ),
        'mksp_created_at' => array(
            'default' => null,
            'data_type' => 'datetime',
            'null' => false,
        ),
        'mksp_updated_at' => array(
            'default' => null,
            'data_type' => 'datetime',
            'null' => false,
        ),
    );

    protected static $_observers = array(
        'Orm\\Observer_CreatedAt' => array(
            'mysql_timestamp' => true,
            'property' => 'mksp_created_at',
        ),
        'Orm\\Observer_UpdatedAt' => array(
            'mysql_timestamp' => true,
            'property' => 'mksp_updated_at',
        ),
    );

    protected static $_behaviours = array(
        'Nos\Orm_Behaviour_Twinnable' => array(
            'context_property'      => 'mksp_context',
            'common_id_property' => 'mksp_context_common_id',
            'is_main_property' => 'mksp_context_is_main',
            'invariant_fields'   => array(),
        ),
        'Nos\Orm_Behaviour_Urlenhancer' => array(
            'enhancers' => array('noviusos_monkey'),
        ),
        'Nos\Orm_Behaviour_Virtualname' => array(
            'virtual_name_property' => 'mksp_virtual_name',
        ),
    );
}
