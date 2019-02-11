<?php include __THEME__ . '/header.php'; ?>
<div class="nobita-post-list">
    <div class="n-post-list">
        <div class="n-archives-header-title">
            <h4>邻居墙 <span class="n-sum-archives">共有<?= $sum; ?> 个邻居</span></h4>
        </div>
        <div class="n-links-list n-page-header">
            <?php foreach ($links as $item): ?>
                <a href="<?= $item['url']; ?>" target="_blank">
                    <div class="n-links-item">
                        <div class="n-links-gravatar">
                            <img src="<?= $_N['site']['site_url']; ?>avatar/<?= md5($item['email']); ?>.jpg?6" alt="">
                        </div>
                        <div class="n-links-meta">
                            <div class="n-links-title">
                                <h4><?= $item['title']; ?></h4>
                            </div>
                            <div class="n-links-description">
                                <p><?= $item['description']; ?></p>
                            </div>

                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="nobita-register-links" style="display: <?=$_N['session']['id']?'block':'none'?>">

    <div class="show-link-form">
        <span>邻居申请注意事项</span>
        <p>在本博客留言达10条以上,建博客3个月以上,通过QQ登录并认证邮箱即可通过并且显示在上面,否则系统判定为不通过无法显示,请勿恶意提交；严重可视为封禁IP无法访问,鼠标点击上方申请即可弹出申请框。</p>
        <p class="links-msg"></p>
    </div>

    <div class="links-form">
        <div class="form-group">
            <label for="author">博客名：</label>
            <input type="text" class="form-control" id="title" name="title" aria-required="true" required="required">
        </div>
        <div class="form-group">
            <label for="author">博客地址：</label>
            <input type="text" class="form-control" id="url" name="url" aria-required="true" required="required">
        </div>
        <div class="form-group">
            <label for="author">联系Email：</label>
            <input type="email" class="form-control" id="email" name="email" aria-required="true" required="required">
        </div>
        <div class="form-group">
            <label for="author">博客介绍：</label>
            <input type="text" class="form-control" id="description" name="description" aria-required="true"
                   required="required">
        </div>
        <div class="links-submit">
            <span>提交申请</span>
        </div>
    </div>

</div>
<?php include __THEME__ . '/footer.php'; ?>
