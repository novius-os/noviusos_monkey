<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

if (!empty($display['name'])) {
    echo'<a href="'.$item->url().'">'.$item->monk_name.'</a>';
}

if (!empty($display['summary']) && !empty($item->monk_summary)) {
    echo nl2br($item->monk_summary);
}

if (!empty($display['thumbnail']) && !empty($item->medias->thumbnail)) {
    echo $item->medias->thumbnail->get_img_tag_resized(200);
}

if (!empty($display['wysiwyg']) && !empty($item->wysiwygs)) {
    echo $item->wysiwygs->content;
}

if (!empty($display['species'])) {
    echo '<a href="'.$item->species->url().'">'.$item->species->mksp_title.'</a>';
}
