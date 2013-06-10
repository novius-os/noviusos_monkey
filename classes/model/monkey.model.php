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

class Model_Monkey extends \Nos\Orm\Model
{
    protected static $_table_name = 'nos_monkey';
    protected static $_primary_key = array('monk_id');

    protected static $_title_property = 'monk_name';
    protected static $_properties = array(
        'monk_id' => array(
            'default' => null,
            'data_type' => 'int unsigned',
            'null' => false,
        ),
        'monk_context' => array(
            'default' => null,
            'data_type' => 'varchar',
            'null' => false,
        ),
        'monk_context_common_id' => array(
            'default' => null,
            'data_type' => 'int',
            'null' => false,
        ),
        'monk_context_is_main' => array(
            'default' => 0,
            'data_type' => 'tinyint',
            'null' => false,
        ),
        'monk_species_common_id' => array(
            'default' => null,
            'data_type' => 'int',
            'null' => false,
        ),
        'monk_name' => array(
            'default' => '',
            'data_type' => 'varchar',
            'null' => false,
        ),
        'monk_summary' => array(
            'default' => null,
            'data_type' => 'text',
            'null' => true,
            'convert_empty_to_null' => true,
        ),
        'monk_created_at' => array(
            'default' => null,
            'data_type' => 'datetime',
            'null' => false,
        ),
        'monk_updated_at' => array(
            'default' => null,
            'data_type' => 'datetime',
            'null' => false,
        ),
        'monk_publication_start' => array(
            'default' => null,
            'data_type' => 'datetime',
            'null' => true,
            'convert_empty_to_null' => true,
        ),
        'monk_publication_end' => array(
            'default' => null,
            'data_type' => 'datetime',
            'null' => true,
            'convert_empty_to_null' => true,
        ),
        'monk_published' => array(
            'default' => 1,
            'data_type' => 'tinyint',
            'null' => false,
        ),
        'monk_virtual_name' => array(
            'default' => null,
            'data_type' => 'varchar',
            'null' => false,
        ),
        'monk_birth_year' => array(
            'default' => null,
            'data_type' => 'int',
            'null' => true,
        ),
    );

    protected static $_twinnable_belongs_to = array(
        'species' => array(
            'key_from' => 'monk_species_common_id',
            'model_to' => 'Nos\Monkey\Model_Species',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
    );

    protected static $_observers = array(
        'Orm\\Observer_CreatedAt' => array(
            'mysql_timestamp' => true,
            'property' => 'monk_created_at',
        ),
        'Orm\\Observer_UpdatedAt' => array(
            'mysql_timestamp' => true,
            'property' => 'monk_updated_at',
        ),
    );

    protected static $_behaviours = array(
        'Nos\Orm_Behaviour_Twinnable' => array(
            'context_property'      => 'monk_context',
            'common_id_property' => 'monk_context_common_id',
            'is_main_property' => 'monk_context_is_main',
            'common_fields'   => array('monk_species_common_id', 'monk_birth_year'),
        ),
        'Nos\Orm_Behaviour_Publishable' => array(
            'publication_state_property'    => 'monk_published',
            'publication_start_property'    => 'monk_publication_start',
            'publication_end_property'      => 'monk_publication_end',
        ),
        'Nos\Orm_Behaviour_Urlenhancer' => array(
            'enhancers' => array('noviusos_monkey'),
        ),
        'Nos\Orm_Behaviour_Virtualname' => array(
            'virtual_name_property' => 'monk_virtual_name',
        ),
    );

    public static $shared_medias_context = array(
        'thumbnail',
    );
}
