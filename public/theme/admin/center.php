<?php include __THEME__.'/header.php'; ?>
    <div class="content-right col-md-10">
        <div class="show-list row">
            <?php foreach ($article as $item): ?>
            <div id="item-<?=$item['id'];?>" class="item-card-body col-md-4">
                <div class="item-card" <?=$item['mark']?'style="border-bottom: 3px solid #117a8b;"':'';?>>
                    <div class="author-face">
                        <img src="<?=$userInfo['face_url'];?>" alt="">
                    </div>
                <div class="item-content">
                    <a href="<?=$item['id'];?>">
                <div class="title"><p><?=$item['title'];?></p></div>
                        <div class="item-times">
                            <span>时间: <?=$item['create_time'];?></span> / <span><a href="/admin/category/show/<?=$item['category_id'];?>">分类: <?=@$category[$item['category_id']];?></a></span>
                        </div>
                    </a>
                </div>
                    <div class="clear"></div>
                    <div class="item-info">
                        <ul>
                            <li><a onclick="action('/admin/api/action',<?=$item['id'];?>,'mark','article','创作收藏成功','创作收藏失败')"><i class="czs-book-l"></i> <?=@$item['mark'] == NULL ? '添加收藏':'取消收藏'?></a></li>
                            <li><a href="/<?=$item['id'];?>" target="_blank"><i class="czs-eye-l"></i> 查看</a></li>
                            <li><a href="/admin/article/write/<?=$item['id'];?>"><i class="czs-pen-write"></i> 修改</a></li>
                            <li><a onclick="action('/admin/api/action',<?=$item['id'];?>,'del','article','创作删除成功','创作删除失败')"><i class="czs-trash-l"></i> 删除</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <?php if (@$page): ?>
        <div class="page-nav">
            <?php echo str_replace(['&laquo;','&raquo;'],['Previous page','Loading More'],@$page);   //输出分页代码 ?>
        </div>
        <?php else:?>
        <?php endif;?>
    </div>
<?php include __THEME__.'/footer.php'; ?>