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

use Nos\Controller;

class Controller_Admin_Popup extends \Nos\Controller_Admin_Application {

	public function action_index() {
		return \View::forge($this->config['views']['index']);
	}
}
