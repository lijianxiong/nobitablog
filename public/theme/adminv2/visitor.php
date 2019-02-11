<?php include __THEME__.'/header.php'; ?>
<section class="visitor">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>访问地址</th>
                                    <th>来源IP</th>
                                    <th>访问时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($visitorData as $item): ?>
                                <?php $v = json_decode($item['value'],true);?>
                                <tr>
                                    <th scope="row"><?=$item['id'];?></th>
                                    <td><?=$v['url'];?></td>
                                    <td><?=$v['ip'];?></td>
                                    <td><?=date('Y-m-d H:i:s');?></td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= @$page?'<div class="container-fluid page-nav">'.str_replace(['&laquo;','&raquo;'],['Previous page','Loading More'],@$page).'</div>':''  ?>
<?php include __THEME__.'/footer.php'; ?>
