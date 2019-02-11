<?php include __THEME__ . '/header.php'; ?>
<div class="nobita-post-list">
    <div class="n-post-list">
        <div class="n-archives-header-title">
            <h4>归档 <span class="n-sum-archives">共有<?=$sum;?> 篇文章</span></h4>
        </div>
        <div class="n-archives-list n-page-header">
            <?php foreach ($archives as $item): ?>
                <div class="n-archives-item">
                    <div class="n-archives-title">
                        <h4><a href="/post/<?= $item['id']; ?>"><?= $item['title']; ?></a></h4>
                    </div>
                    <div class="n-archive-time">
                        <span><i class="czs-time-l"> </i> <?= $item['create_time']; ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $page?'<div class="nobita-page">'.str_replace(['&laquo;','&raquo;'],['Previous page','Loading More'],@$page).'</div>':'' ?>
<?php include __THEME__ . '/footer.php'; ?>
