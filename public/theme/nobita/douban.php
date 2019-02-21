<?php include __THEME__ . '/header.php'; ?>
<div class="nobita-post-list">
    <div class="n-post-list">
        <div class="n-archives-header-title">
            <h4>看过的电影 <span class="n-sum-archives">共有<?= $sum; ?> 部电影</span></h4>
        </div>
        <div class="n-douban-list">
            <?php foreach ($article as $item): ?>
                <div class="n-douban-item">
                    <a href="<?= $item['alt']; ?>" target="_blank" title="<?= $item['title'] ?>">
                        <div class="n-douban-thumb" style="
                                background-image: url(<?= $item['images']; ?>);
                                "><span class="rating"><?= $item['rating']; ?></span></div>
                        <div class="n-douban-title">
                            <?= $item['title']; ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $page ? '<div class="nobita-page">' . str_replace(['&laquo;', '&raquo;'], ['Previous page', 'Loading More'], @$page) . '</div>' : '' ?>
<?php include __THEME__ . '/footer.php'; ?>
