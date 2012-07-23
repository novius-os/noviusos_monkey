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

use View;

class Controller_Admin_Appdesk extends \Nos\Controller_Admin_Appdesk
{
    public function action_delete($item_id)
    {
        $item = Model_Monkey::find($item_id);
        return \View::forge($this->config['views']['delete'], array('item' => $item));
    }

    public function action_delete_confirm()
    {
        $dispatchEvent = null;
        $item = Model_Monkey::find(\Input::post('id', 0));
        if (!empty($item))
        {
            $dispatchEvent = array(
                'name' => get_class($item),
                'action' => 'delete',
                'id' => $item->item_id,
                'lang_common_id' => $item->item_lang_common_id,
                'lang' => $item->item_lang,
            );
            $item->delete();
        }

        $this->response(array(
            'notify' => __('The item has successfully been deleted!'),
            'dispatchEvent' => $dispatchEvent,
        ));
    }
}

