<?php include __THEME__ . '/header.php'; ?>
<div class="nobita-post-list">
    <div class="n-post-list">
        <div class="n-archives-header-title">
            <h4>生活圈 <span class="n-sum-archives">共有<?= $sum; ?> 张照片</span></h4>
        </div>
        <div class="n-album-list">
            <?php foreach ($article as $item): ?>
                <div class="n-album-item">
                    <a href="/post/<?= $item['id']; ?>" target="_blank" title="<?= $item['title'] ?>">
                        <div class="n-album-thumb" style="
                                background-image: url(<?= $item['thumb']; ?>);
                                "></div>
                        <div class="n-album-title"><?= $item['title']; ?></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $page ? '<div class="nobita-page">' . str_replace(['&laquo;', '&raquo;'], ['Previous page', 'Loading More'], @$page) . '</div>' : '' ?>
<?php include __THEME__ . '/footer.php'; ?>
