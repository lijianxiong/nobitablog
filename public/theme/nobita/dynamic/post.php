<?php include __THEME__ . '/header.php'; ?>
<div class="nobita-post-list">
    <div class="n-post-list">
        <div class="n-post-content">
            <div class="n-archives-header-title">
                <h4>动态 <span class="n-sum-archives">共有 <?= $article['views']; ?> 次围观</span></h4>
            </div>
            <div class="n-content js-gallery markdown">
                <p class="t"><?= $article['content']; ?></p>
            </div>

            <div class="n-content-meta">
                <time><i class="czs-time-l"></i> 发布时间：<?= $article['create_time']; ?></time>


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
