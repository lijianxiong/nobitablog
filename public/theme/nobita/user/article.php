<?php include __THEME__ . '/header.php'; ?>
<?php include __THEME__ . '/user/header.php'; ?>
<div class="user-post">
<?php foreach ($article as $item): ?>
    <div class="n-post-item">
        <a href="/post/<?=$item['id']?>" title="<?=$item['title'];?>" target="_blank">
            <div class="n-post-title">
                <h4><?=$item['title'];?></h4>
            </div>
            <div class="n-post-summary">
                <div class="n-post-thumb" style="
    background-image: url(<?=$item['thumbnail'];?>);
">
                </div>
                <div class="n-post-descript">
                    <p><?=$item['description'];?></p>
                </div>
            </div>
            <p class="n-post-meta"><i class="czs-time-l"></i> <?=$item['create_time']?> <a class="more" href="/post/<?=$item['id'];?>" title="<?=$item['title'];?>" target="_blank"><i
                        class="czs-read-l"></i> Read More</a>
            </p>
        </a>
    </div>
<?php endforeach;?>
</div>
<?= $page?'<div class="nobita-page">'.str_replace(['&laquo;','&raquo;'],['Previous page','Loading More'],@$page).'</div>':'' ?>
<?php include __THEME__ . '/footer.php'; ?>

