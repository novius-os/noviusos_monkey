<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */
?>
<div class="expander">
    <h3>Options</h3>
    <div>
        <p><label for="item_per_page"><?= __('Monkey per page:') ?></label> <input type="text" name="item_per_page" id="item_per_page" value="<?= \Arr::get($enhancer_args, 'item_per_page', 10) ?>" /></p>
    </div>
</div>
