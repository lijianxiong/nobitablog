<?php include __THEME__.'/header.php'; ?>
    <div class="content-right col-md-10">
        <div class="show-list row">
            <?php foreach ($commentList as $item): ?>
            <div id="item-<?=$item['id'];?>" class="item-card-body col-md-4">
                <div class="item-card">
                    <div class="author-face">
                        <img src="<?=$avatar($item['email']);?>" alt="">
                    </div>
                <div class="item-content">
                <div class="title"><p><a href="<?=$item['url'];?>" target="_blank"><?=$item['author'];?></a><span class="comment-time"> - <?=$item['time'];?></span></p></div>
                        <div class="item-times">
                            <span><?=$item['content'];?></span>
                        </div>
                </div>
                    <div class="clear"></div>
                    <div class="item-info">
                        <ul>
                            <li class="comment-view" data-id="<?=$item['id'];?>"><a href="javascript:;"><i class="czs-eye-l"></i> 查看完整</a></li>
                            <li onclick="action('/admin/api/action',<?=$item['id'];?>,'status','comment','状态修改成功','状态修改失败')"><a href="javascript:;" title="设置为<?=$item['status'] == 1?'未审核':'已审核';?>"><i class="czs-message-l"></i> <span class="comment-status"><?=$item['status'] == 1?'已审核':'未审核';?></span></a></li>
                            <li><a href="/<?=$item['value'];?>"><i class="czs-pen-write"></i> 回复</a></li>
                            <li><a onclick="action('/admin/api/action',<?=$item['id'];?>,'del','comment','创作删除成功','创作删除失败')"><i class="czs-trash-l"></i> 删除</a></li>
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