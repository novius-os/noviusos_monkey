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

    protected static $_properties = array(
        'monk_id',
        'monk_context',
        'monk_context_common_id',
        'monk_context_is_main',
        'monk_species_id',
        'monk_name',
        'monk_summary',
        'monk_created_at',
        'monk_updated_at',
        'monk_publication_start',
        'monk_publication_end',
        'monk_published',
        'monk_virtual_name',
    );

    protected static $_belongs_to = array(
        'species' => array(
            'key_from' => 'monk_species_id',
            'model_to' => 'Nos\Monkey\Model_Species',
            'key_to' => 'mksp_id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
    );

    protected static $_observers = array(
        'Orm\\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
            'property' => 'monk_created_at',
        ),
        'Orm\\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => true,
            'property' => 'monk_updated_at',
        ),
    );

    protected static $_behaviours = array(
        'Nos\Orm_Behaviour_Twinnable' => array(
            'events' => array('before_insert', 'after_insert', 'before_save', 'after_delete', 'change_parent'),
            'context_property'      => 'monk_context',
            'common_id_property' => 'monk_context_common_id',
            'is_main_property' => 'monk_context_is_main',
            'invariant_fields'   => array(),
        ),
        'Nos\Orm_Behaviour_Publishable' => array(
            'publication_bool_property' => 'monk_published',
        ),
        'Nos\Orm_Behaviour_Urlenhancer' => array(
            'enhancers' => array('noviusos_monkey'),
        ),
        'Nos\Orm_Behaviour_Virtualname' => array(
            'events' => array('before_save', 'after_save'),
            'virtual_name_property' => 'monk_virtual_name',
        ),
    );
}
