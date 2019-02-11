<?php include __THEME__.'/header.php'; ?>
<!-- Projects Section-->
<section class="projects">
    <div class="container-fluid">
        <?php foreach ($article as $item): ?>
            <div id="item-<?=$item['id'];?>" class="project">
                <div class="row bg-white has-shadow">
                    <div class="left-col col-lg-8 d-flex align-items-center justify-content-between">
                        <div class="project-title d-flex align-items-center article-title">
                            <a href="/<?=$item['id'];?>" target="_blank">
                                <div class="text">
                                    <h3 class="h4 article-info"><small class="mark-<?=$item['id'];?> marks <?=$item['mark']==1?'show':''?>"><i class="fa fa-star" style="color: #796aee;"></i></small><?=$item['title'];?></h3> <small> <i class="fa fa-clock-o"></i> <?=date('Y-m-d H:i:s' , $item['create_time']);?> #ID: <?=$item['id'];?></small>
                                </div>
                            </a>
                        </div>
                        <div class="project-category"><span class="hidden-sm-down">Category: <a href="/admin/category/show/<?=$item['category_id'];?>"><?=@$category[$item['category_id']];?></a></span></div>
                    </div>
                    <div class="right-col col-lg-3 d-flex align-items-center article-meta">
                        <div class="time"><i class="fa fa-eye"></i><?=$item['views'];?> Views</div>
                        <div class="comments"><i class="fa fa-comment-o"></i><?=$item['comment'];?> Comment</div>
                    </div>
                    <div class="right-col col-lg-1 d-flex align-items-center">
                        <div class="article-setting">
                            <a href="javascript:;" onclick="action('/admin/api/action',<?=$item['id'];?>,'trash','article')" data-id="<?=$item['id'];?>" class="untrash"><i class="fa fa-mail-reply"></i></a>
                            <a href="javascript:;" onclick="action('/admin/api/action',<?=$item['id'];?>,'mark','article')" class="fa fa-bookmark mark-btn" data-id="<?=$item['id'];?>" title="<?=$item['mark']==1?'取消收藏':'收藏';?><?=$item['title'];?>"><i class="czs-book-l"></i></a>
                            <a href="/admin/article/write/<?=$item['id'];?>" class="fa fa-pencil"></a>
                            <a href="javascript:;" onclick="action('/admin/api/action',<?=$item['id'];?>,'destory','article')" class="fa fa-times delete-btn" data-id="<?=$item['id'];?>" title="一旦删除无法恢复!"></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php include __THEME__.'/footer.php'; ?>
