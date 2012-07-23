<li class="comment" id="comment<?= $comment->comm_id ?>">
    <div class="comment_infos">
        <span class="comment_author"><?= Str::tr(__('Comment by :author'), array('author' => $comment->comm_author)) ?></span>
        <span class="comment_date"><?= Date::forge(strtotime($comment->comm_created_at))->format(__('%m/%d/%Y at %H:%M')) ?></span>
        <br class="clearfloat">
    </div>
    <div class="comment_content">
        <?= Str::textToHtml($comment->comm_content) ?>
    </div>
</li>