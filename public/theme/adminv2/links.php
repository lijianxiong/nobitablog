<?php include __THEME__.'/header.php'; ?>
    <section class="links" id="link-edit">
        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h3 class="h4">编辑友链</h3>
                            </div>
                            <div class="card-body link-edit">
                                <form class="form-inline" method="POST" action="/admin/links/update">
                                    <input type="hidden" name="id" id="id" value="0">
                                    <div class="form-group">
                                        <label for="title" class="sr-only">站点名</label>
                                        <input id="title" type="text" name="title" placeholder="大雄" class="mr-3 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="url" class="sr-only">站点Url</label>
                                        <input id="url" type="text" name="url" placeholder="http://199508.com" class="mr-3 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="sr-only">站长Email</label>
                                        <input id="email" type="text" name="email" placeholder="4020426@qq.com" class="mr-3 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="sr-only">站点介绍</label>
                                        <input id="description" type="text" name="description" placeholder="时光真是个残忍的坏蛋" class="mr-3 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="weight" class="sr-only">站点排序</label>
                                        <input id="weight" type="text" name="weight" placeholder="1" class="mr-3 form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">提交操作</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($links as $item): ?>
                    <div id="links-<?=$item['id'];?>" class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block" src="<?=$item['email'];?>" alt="<?=$item['title'];?>">
                                    <h5 class="text-sm-center mt-2 mb-1"><?=$item['title'];?></h5>
                                    <div class="location text-sm-center"><?=$item['description'];?></div>
                                    <p class="text-sm-center"><?=$item['url'];?></p>
                                </div>
                                <hr>
                                <div class="card-text text-sm-center">
                                    <a href="#header"><i class="fa fa fa-pencil pr-1 edit-links" data-id="<?=$item['id'];?>"></i></a>
                                    <a href="<?=$item['url'];?>" target="_blank"><i class="fa fa-link pr-1"></i></a>
                                    <a href="javascript:;"><i class="fa fa fa-times pr-1 del-links" data-id="<?=$item['id'];?>"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div><!-- .row -->
            </div><!-- .animated -->
        </div>
    </section>
<?php include __THEME__.'/footer.php'; ?>