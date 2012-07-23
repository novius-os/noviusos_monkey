<ul class="comments_list">
    <?php foreach($item->comments as $comment) { ?>
        <?= render('front/comment', array('comment' => $comment), true) ?>
    <?php } ?>
</ul>