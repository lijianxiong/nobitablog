<?php include __THEME__.'/header.php'; ?>
    <div class="content-right col-md-10">
        <div class="row">
            <div class="category-body col-md-8">
                <div class="row">
                    <?php foreach($category as $item): ?>
                        <div class="col-md-6 item-card-body category-id-<?=$item['id'];?>">
                            <div class="category-del" data-id="<?=$item['id'];?>"><i class="czs-close-l"></i></div>
                            <div class="item-card" data-id="<?=$item['id'];?>">
                                <div class="category-info col-md-12">
                                    <div class="category-title">
                                        <p>名称: <?=$item['title'];?></p>
                                    </div>
                                    <div class="category-slug">
                                        <p>别名: <?=$item['slug'];?></p>
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
                        <h4>分类操作</h4>
                    </div>
                    <form method="POST" action="/admin/category/update" id="menu-form">
                        <input type="hidden" name="id" id="id" value="0">
                        <div class="form-group">
                            <label for="title">名称</label>
                            <input type="text" class="form-control" id="title" name="title">
                            <p class="help-block">这将展示在链接栏</p>
                        </div>
                        <div class="form-group">
                            <label for="description">别名</label>
                            <input type="text" class="form-control" id="slug" name="slug">
                            <p class="help-block">用于导航栏链接</p>
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