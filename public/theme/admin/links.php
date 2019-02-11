<?php include __THEME__.'/header.php'; ?>
<div class="content-right col-md-10">
<div class="row">
    <div class="links-body col-md-8">
        <div class="row">
        <?php foreach($links as $item): ?>
        <div class="col-md-6 item-card-body links-id-<?=$item['id'];?>">
            <div class="links-del" data-id="<?=$item['id'];?>"><i class="czs-close-l"></i></div>
            <div class="item-card" data-id="<?=$item['id'];?>">
            <div class="link-face col-md-4">
                <img src="<?=$item['email'];?>" alt="">
            </div>
            <div class="link-info col-md-8">
                <div class="links-title">
                    <p><?=$item['title'];?></p>
                </div>
                <div class="link-url">
                    <p><?=$item['url'];?></p>
                </div>
                <div class="link-description">
                    <p>NO:<?=$item['weight'];?> / <?=$item['description'];?></p>
                </div>
            </div>
            </div>
        </div>
        <?php endforeach; ?>
        </div>

    </div>
    <div class="add-links col-md-4">
        <div class="from-body item-card">

            <div class="add-title">
                <h4>添加链接</h4>
            </div>
            <form method="POST" action="/admin/links/update" id="menu-form">
                <input type="hidden" name="id" id="id" value="0">
                <div class="form-group">
                    <label for="title">排序</label>
                    <input type="text" class="form-control" id="weight" name="weight">
                    <p class="help-block">友情链接排序</p>
                </div>
                <div class="form-group">
                    <label for="title">名称</label>
                    <input type="text" class="form-control" id="title" name="title">
                    <p class="help-block">这将展示在链接栏</p>
                </div>
                <div class="form-group">
                    <label for="title">站长邮箱</label>
                    <input type="text" class="form-control" id="email" name="email">
                    <p class="help-block">用于显示Gravatar头像</p>
                </div>
                <div class="form-group">
                    <label for="url">URL地址</label>
                    <input type="text" class="form-control" id="url" name="url">
                    <p class="help-block">要跳转到的地址，通常以http/https开头</p>
                </div>
                <div class="form-group">
                    <label for="description">描述</label>
                    <input type="text" class="form-control" id="description" name="description">
                    <p class="help-block">[可空]如何描述这个链接</p>
                </div>
                <div class="create-item">
                <button type="submit" class="submit">提交</button>
                </div>
                <p class="clear-link">清空内容</p>
            </form>
        </div>
    </div>
</div>
</div>
<?php include __THEME__.'/footer.php'; ?>
