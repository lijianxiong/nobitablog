<?php include __THEME__ . '/header.php'; ?>
<?php include __THEME__ . '/user/header.php'; ?>
<div class="n-dynamic-list n-page-header">
    <div class="n-user-msg">
        <p id="n-user-msg">资料修改成功!</p>
    </div>
    <div class="douban-movie-form">
        <div class="movie-id">
            <input type="text" name="movie_id" id="movie_id" placeholder="输入豆瓣电影的ID">
        </div>
        <div class="movie-submit submit-button">
            添加电影
        </div>
    </div>

    <div class="douban-list">
        <?php foreach ($data as $item): ?>
        <div class="douban-movie-item">
            <a href="<?=$item['alt'];?>" target="_blank">
                <div class="movie-image" style="background-image: url(<?=$item['images'];?>);">
                    <span class="rating"><?=$item['rating'];?></span>
                </div>
            <div class="movie-title">
                <?=$item['title'];?>
            </div>
            </a>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?= $page ? '<div class="nobita-page">' . str_replace(['&laquo;', '&raquo;'], ['Previous page', 'Loading More'], @$page) . '</div>' : '' ?>
<?php include __THEME__ . '/footer.php'; ?>
