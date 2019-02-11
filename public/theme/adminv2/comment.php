<?php include __THEME__.'/header.php'; ?>
<section class="projects comment" id="comment-edit">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>评论分类 </strong>
                    </div>
                    <div class="card-body category-header-btn">
                            <a href="/admin/comment"><span class="btn btn-outline-primary btn-sm">所有</span></a>
                        <a href="/admin/comment?status=1"><span class="btn btn-outline-primary btn-sm">已发布</span></a>
                        <a href="/admin/comment?status=2"><span class="btn btn-outline-primary btn-sm">待审核</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card comment-edit">
                    <div class="card-close">
                        <div class="dropdown">
                            <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow"><a href="javascript:;" class="dropdown-item remove-edit"> <i class="fa fa-times"></i>Close</a></div>
                        </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">编辑评论</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-inline">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-group">
                                <label for="author" class="sr-only">评论者</label>
                                <input id="author" type="text" name="author" placeholder="大雄" class="mr-3 form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">评论邮箱</label>
                                <input id="email" type="text" name="email" placeholder="4020426@qq.com" class="mr-3 form-control" value="">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="content" class="sr-only">评论内容</label>
                                <input id="content" type="text" name="content" placeholder="评论内容..." class="mr-3 form-control col-lg-12" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary comment-submit-btn">提交修改</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($commentList as $item): ?>
        <div class="project" id="item-<?=$item['id'];?>">
            <div class="row bg-white has-shadow">
                <div class="left-col col-lg-10 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                        <div class="image has-shadow"><img src="<?=$avatar($item['email']);?>" alt="..." class="img-fluid"></div>
                        <div class="text">
                            <h3 class="h4"><?=$item['author'];?></h3><small class="comment-email"><?=$item['email'];?></small>
                            <p class="comment-content"><?=$item['content'];?></p>
                        </div>
                    </div>
                </div>
                <div class="right-col col-lg-2 d-flex align-items-center comment-info">
                    <div class="time"><i class="fa fa-clock-o"></i> <?=$item['time'];?> <br> <i class="fa fa-check"> <span class="comment-status"><?=$item['status']==1?'已审核':'未审核';?></span></i></div>
                    <div class="article-setting">
                        <a href="javascript:;" onclick="action('/admin/api/action',<?=$item['id'];?>,'status','comment')" class="comment-status-btn fa fa-eye-slash" data-id="<?=$item['id'];?>" title="设置为<?=$item['status']==1?'未审核':'已审核';?>"></a>
                        <a href="#header" class="fa fa-pencil comment-edit-btn" data-id="<?=$item['id'];?>"></a>
                        <a href="/<?=$item['id'];?>" class="fa fa-mail-reply" title="回复<?=$item['author'];?>的评论"></a>
                        <a href="javascript:;" onclick="action('/admin/api/action',<?=$item['id'];?>,'del','comment')" class="fa fa-times comment-delete-btn" data-id="<?=$item['id'];?>"></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</section>
<?= @$page?'<div class="container-fluid page-nav">'.str_replace(['&laquo;','&raquo;'],['Previous page','Loading More'],@$page).'</div>':''  ?>
<?php include __THEME__.'/footer.php'; ?>
