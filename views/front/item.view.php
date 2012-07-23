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
<div class="billet">
      <h1><?= $title ?></h1>
      <div class="date"><?= $date ?></div>
      <br class="clearfloat"/>

      <div class="resume" style="text-align:justify"><?= $summary ?></div>
      <div class="post"><?= $wysiwyg ?></div>
      <div style="clear:both;"></div>
      <img src="<?= $link_to_stats ?>" title="" alt="" />

      <div class="tags"><?= $tags ?></div>
      <div class="comments" id="comments">
<?php
          if (count($item->comments) == 0) {
              echo '<div class="comments_number" href="'.$link_to_item.'#commentaires">'.__('No comments').'</div>';
          } else {
              echo '<div class="comments_number" href="'.$link_to_item.'#commentaires">'.(count($item->comments) > 1 ? Str::tr(__(':comments comments'), array('comments' => count($item->comments))) : __('1 comment')).'</div>';
          }
?>
          <?= render('front/comments_list', array('item' => $item), true) ?>
          <?= render('front/comment_form', array('item' => $item, 'add_comment_success' => $add_comment_success, 'use_recaptcha' => $use_recaptcha), true) ?>
      </div>

      <?= $comments ?>
</div>