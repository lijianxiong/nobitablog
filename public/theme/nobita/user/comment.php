<?php include __THEME__ . '/header.php'; ?>
<?php include __THEME__ . '/user/header.php'; ?>
<div class="n-user-comment-list">
    <?php foreach ($comment as $item): ?>
        <div class="n-user-comment-item">
            <div class="n-user-comment-gravatar">
                <img src="<?= $item['email']; ?>" alt="<?= $item['author']; ?>">
            </div>
            <div class="n-user-comment-meta">
                <div class="n-user-comment-nickname">
                    <p><?= $item['author']; ?> <span class="n-user-comment-small">评论了</span> <a
                                href="<?= $item['type'] == 'article' ? '/post/' : '/dynamicpost/'; ?><?= $item['value']; ?>#n-comment-<?= $item['id']; ?>"
                                target="_blank"><?= $item['title']; ?></a></p>
                </div>
                <div class="n-user-comment-time">
                    <p><i class="czs-time-l"></i> <?= $item['time']; ?></p>
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
