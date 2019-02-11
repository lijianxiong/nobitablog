<?php include __THEME__ . '/header.php'; ?>
<div class="nobita-post-list">
    <div class="n-archives-header-title">
        <h4><?= $article['title']; ?> <span class="n-sum-archives">浏览：<?= $article['views']; ?> 次</span></h4>
    </div>
    <div class="n-post-list">
        <div class="n-post-content">
            <div class="n-content js-gallery markdown">
                <?= $article['content']; ?>
            </div>
        </div>
    </div>
</div>
<?php include __THEME__ . '/footer.php'; ?>
