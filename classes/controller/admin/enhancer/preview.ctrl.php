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

class Controller_Admin_Enhancer_Preview extends \Nos\Controller_Admin_Application {

    public function action_index() {
        return $this->action_save();
    }

    public function action_save() {

        $body = array(
            'config'  => \Format::forge()->to_json($_POST),
            'preview' => \View::forge($this->config['views']['index'], $_POST)->render(),
        );
        \Response::json($body);
    }
}
