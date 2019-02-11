<?php include __THEME__ . '/header.php'; ?>
<div class="nobita-post-list">
    <div class="n-post-list">
        <div class="n-post-content">
            <div class="n-content-title">
                <h4><?= $article['title']; ?></h4>
            </div>
            <div class="n-content-meta">
                <time>发布时间：<?= date('Y-m-d H:i:s',$article['create_time']); ?></time>
                <span> / 浏览：<?= $article['views'];?> 次</span>
                <?= $userId==$article['user_id']?'<span> / <a href="/profile/write/'.$article['id'].'" target="_blank">修改</a></span>':'';?>


            </div>
            <div class="n-content js-gallery markdown">
                <?= $article['content']; ?>
            </div>
        </div>
        <div class="comment-header" id="comment">
            <p>如果你想转载，请注明来源或者出处</p>
        </div>
    </div>
</div>
<?php
include __THEME__.'/comment.php';
?>
<?php include __THEME__ . '/footer.php'; ?>
