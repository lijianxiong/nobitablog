<?php include __THEME__ . '/header.php'; ?>
<?php include __THEME__ . '/user/header.php'; ?>
<div class="n-user-comment-list">
    <?php foreach ($msgData as $item): ?>
        <div class="n-user-comment-item">
            <div class="n-user-comment-meta">
                <div class="n-user-comment-nickname">
                    <p><?= $item['title']; ?></p>
                </div>
                <div class="n-user-comment-time">
                    <p><i class="czs-time-l"></i> <?= $item['create_time']; ?></p>
                </div>
                <div class="n-user-comment-content">
                    <p><?= $item['content']; ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $page ? '<div class="nobita-page">' . str_replace(['&laquo;', '&raquo;'], ['Previous page', 'Loading More'], @$page) . '</div>' : '' ?>
<?php include __THEME__ . '/footer.php'; ?>
