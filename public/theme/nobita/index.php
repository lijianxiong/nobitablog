<?php include __THEME__.'/header.php'; ?>
<div class="nobita-post-list">
    <div class="n-post-list">

        <?php foreach ($article as $item): ?>
        <div class="n-post-item">
            <a href="/post/<?=$item['id']?>" title="<?=$item['title'];?>">
            <div class="n-post-title">
                <h4><?=$item['title'];?></h4>
            </div>
            <div class="n-post-summary">
                <?=$item['thumbnail']?'<img src="'.$item['thumbnail'].'" alt="'.$item['title'].'">':''?>
                <div class="n-post-descript">
                    <p><?=$item['description'];?></p>
                </div>
            </div>
            <p class="n-post-meta"><i class="czs-time-l"></i> <?=$item['create_time']?> <a class="more" href="/post/<?=$item['id'];?>" title="<?=$item['title'];?>"><i
                        class="czs-read-l"></i> Read More</a>
            </p>
            </a>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?= $page?'<div class="nobita-page">'.str_replace(['&laquo;','&raquo;'],['Previous page','Loading More'],@$page).'</div>':'' ?>
<?php include __THEME__.'/footer.php'; ?>
