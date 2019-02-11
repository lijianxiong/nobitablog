<?php include __THEME__ . '/header.php'; ?>
<?php include __THEME__ . '/user/header.php'; ?>
<div class="n-dynamic-list n-page-header">
    <?php foreach ($dynamic as $item): ?>
        <div id="n-dynamic-item-<?=$item['id'];?>" class="n-dynamic-item">
            <div class="n-dynamic-gravatar">
                <img src="<?= $item['face_url']; ?>" alt="<?= $item['nickname']; ?>">
            </div>
            <div class="n-dynamic-meta">
                <p class="content"><?= $item['content']; ?></p>
                <p class="n-dynamic-time"><i class="czs-user-l"></i> <?= $item['nickname']; ?>  <i class="czs-time-l"></i> <?= date('Y-m-d H:i:s',$item['create_time']); ?> <a href="/dynamicpost/<?=$item['id'];?>"><i class="czs-talk-l"></i> 评论</a>
                    <a href="javascript:;" class="dynamic-del" data-id="<?=$item['id'];?>"><i class="czs-trash-l"> </i> 删除</a></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $page ? '<div class="nobita-page">' . str_replace(['&laquo;', '&raquo;'], ['Previous page', 'Loading More'], @$page) . '</div>' : '' ?>
<?php include __THEME__ . '/footer.php'; ?>
