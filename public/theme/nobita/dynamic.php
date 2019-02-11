<?php include __THEME__ . '/header.php'; ?>
<div class="nobita-post-list">
    <div class="n-post-list dynamic-body">
        <div class="n-archives-header-title">
            <h4>动态 <span class="n-sum-archives">共有<?= $sum; ?> 条动态</span></h4>
        </div>
        <?php if ($_N['session']['id']): ?>
        <div class="nobita-dynamic-body">
            <div class="nobita-dynamic-form">
                <div class="dynamic-gravatar">
                    <img src="<?=$_N['session']['face_url'];?>" alt="<?=$_N['session']['nickname'];?>">
                </div>
                <div class="dynamic-form">
                    <input type="hidden" class="nickname" value="<?=$_N['session']['nickname'];?>">
                    <input type="hidden" class="face_url" value="<?=$_N['session']['face_url'];?>">
                <textarea class="form-control" placeholder="世事如书，我偏爱你这一句。" id="dynamic-content" name="content"
                          style="resize:none" rows="1"></textarea>
                    <div class="n-dynamic">
                        <p class="msg">动态发布成功</p>
                    </div>
                </div>
            </div>
            <div class="dynamic-submit">
                <span class="dynamic-post">发布</span>
            </div>
        </div>
        <?php endif;?>

        <div class="n-dynamic-list n-page-header">
            <?php foreach ($dynamic as $item): ?>
                <div class="n-dynamic-item">
                    <div class="n-dynamic-gravatar">
                        <img src="<?= $item['face_url']; ?>" alt="<?= $item['nickname']; ?>">
                    </div>
                    <div class="n-dynamic-meta">
                        <p class="content"><?= $item['content']; ?></p>
                        <p class="n-dynamic-time"><i class="czs-user-l"></i> <?= $item['nickname']; ?>  <i class="czs-time-l"></i> <?= date('Y-m-d H:i:s',$item['create_time']); ?> <a href="/dynamicpost/<?=$item['id'];?>"><i class="czs-talk-l"></i> 评论</a></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $page ? '<div class="nobita-page">' . str_replace(['&laquo;', '&raquo;'], ['Previous page', 'Loading More'], @$page) . '</div>' : '' ?>
<?php include __THEME__ . '/footer.php'; ?>
