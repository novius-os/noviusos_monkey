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

class Controller_Admin_Breed extends \Nos\Controller_Admin_Crud {

    protected function fieldset($fieldset)
    {
        $fieldset = parent::fieldset($fieldset);
        $fieldset->field('mkbr_virtual_name')->set_template('<th>{label}{required}</th><td><div class="table-field">{field} <span>&nbsp;.html</span></div></td>');
        return $fieldset;
    }
}