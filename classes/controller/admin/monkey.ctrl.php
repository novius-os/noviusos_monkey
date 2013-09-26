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

class Controller_Admin_Monkey extends \Nos\Controller_Admin_Crud
{
    protected function fieldset($fieldset)
    {
        $fieldset = parent::fieldset($fieldset);

        $species = Model_Species::findMainOrContext($this->item->monk_context);
        $options = array();
        foreach ($species as $sp) {
            $options[$sp->mksp_context_common_id] = $sp->mksp_title;
        }
        $fieldset->field('monk_species_common_id')->set_options($options);

        return $fieldset;
    }
}
