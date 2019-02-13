<?php include __THEME__.'/header.php'; ?>
<section class="category" id="category-edit">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">编辑分类</h3>
                    </div>
                    <div class="card-body category-edit">
                        <form class="form-inline" method="POST" action="/admin/category/update" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id" value="0">
                            <div class="form-group col-lg-2">
                                <select name="parent_id">
                                    <option value="0">请选择父级分类</option>
                                    <?php foreach ($userCategory as $item): ?>
                                        <option value="<?=$item['id']?>"><?=str_repeat('-',$item['deep'] * 2).$item['title']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="title" class="sr-only">分类名称</label>
                                <input type="text" name="title" id="title" placeholder="我的日记" class="mr-3 form-control col-lg-12">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="url" class="sr-only">分类别名</label>
                                <input type="text" name="slug" id="slug" placeholder="dairy" class="mr-3 form-control col-lg-12">
                            </div>
                            <div class="form-group thumb col-lg-4">
                                <input type="file" name="file" id="exampleInputFile">
                                <input type="hidden" name="thumb" id="thumb" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">提交操作</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php foreach ($category as $item): ?>
                <div class="col-lg-3" id="item-<?=$item['id']?>">
                    <div class="card">
                        <div class="category-thumb" style="background-image: url(<?=@$item['thumb']?>);"></div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <h5 class="text-sm-center mt-2 mb-1"><?=$item['title'];?></h5>
                                <div class="location text-sm-center"><?=$item['slug'];?></div>
                            </div>
                            <hr>
                            <div class="card-text text-sm-center">
                                <a href="#header"><i class="fa fa fa-pencil pr-1 edit-category" data-id="<?=$item['id'];?>"></i></a>
                                <a href="/admin/category/show/<?=$item['id'];?>" target="_blank"><i class="fa fa-link pr-1"></i></a>
                                <a href="javascript:;"><i class="fa fa fa-times pr-1 category-del" data-id="<?=$item['id'];?>"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php include __THEME__.'/footer.php'; ?>
