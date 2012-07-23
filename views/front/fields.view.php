<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

if (!empty($display['title'])) {
    $title = $item->item_title;
    if (!empty($link_title)) {
        $title = '<a href="'.$link_on_title.'">'.$title.'</a>';
    }
    //echo '<'.$title_tag.' class="billet_titre">'.$title.'</'.$title_tag.'>';
    echo $title;
}

if (!empty($display['author'])) {
    $author = $item->author->fullname() ?: $item->item_author;
    if (!empty($link_to_author)) {
        $author = '<a href="'.$link_to_author.'">'.$author.'</a>';
    }
    echo __('Posted: ').$author;
}

if (!empty($display['date']) && !empty($created_at)) {
    $date = Date::forge($created_at)->format(isset($date_format) ? $date_format : 'eu_full');
    if (!empty($link_to_date)) {
        $date = '<a href="'.$link_to_date.'>'.$date.'</a>';
    }
    $styles = !empty($color) ? 'style="color:'.$color.';"' : '';
    echo '<span class="date" '.$styles.'>'.$date.'</span>';
    //echo $date;
}

if (!empty($display['summary']) && !empty($item->item_summary)) {
    echo nl2br($item->item_summary);
}

if (!empty($display['thumbnail']) && !empty($item->medias->thumbnail)) {
    echo $item->medias->thumbnail->get_img_tag_resized(200);
}

if (!empty($display['wysiwyg']) && !empty($item->wysiwygs)) {
    echo $item->wysiwygs->content;
}

if (!empty($display['tags'])) {
    echo '<span style="padding-right:5px;" class="tags_titre">'.__('Tags: ').'</span>';

    $tags = array();
    foreach ($item->tags as $tag) {
        $tags[$link_to_tag($tag)] = $tag->tag_label;
    }
    echo implode(', ', array_map(function($href, $title) {
        return '<a href="'.$href.'">'.$title.'</a>';
    }, array_keys($tags), array_values($tags)));
}


/*
if (!empty($display['stats'])) {
    if (empty($comments_count)) {
        echo '<div class="comments_number" href="'.$link_to_item.'#commentaires">'.__('No comments').'</div>';
    } else {
        echo '<div class="comments_number" href="'.$link_to_item.'#commentaires">'.($comments_count > 1 ? Str::tr(__(':comments comments'), array('comments' => $comments_count)) : __('1 comment')).'</div>';
    }
}
*/