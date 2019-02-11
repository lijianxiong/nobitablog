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
                                    <h3 class="h4 article-info"><?=$item['title'];?></h3>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="right-col col-lg-3 d-flex align-items-center article-meta">
                        <div class="time"><i class="fa fa-eye"></i><?=$item['views'];?> Views</div>
                    </div>
                    <div class="right-col col-lg-1 d-flex align-items-center">
                        <div class="article-setting">
                            <a href="/admin/page/write/<?=$item['id'];?>" class="fa fa-pencil"></a>
                            <a href="javascript:;" onclick="action('/admin/api/action',<?=$item['id'];?>,'del','article')" class="fa fa-times delete-btn" data-id="<?=$item['id'];?>"></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?= @$page?'<div class="container-fluid page-nav">'.str_replace(['&laquo;','&raquo;'],['Previous page','Loading More'],@$page).'</div>':''  ?>
<?php include __THEME__.'/footer.php'; ?>
