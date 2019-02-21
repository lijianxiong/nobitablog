<?php include __THEME__.'/header.php'; ?>
<section class="site-setting" id="site-setting">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">公共显示设置</h3>
                    </div>
                    <div class="card-body">
                        <form action="/admin/setting/update" method="post" class="form-horizontal">
                            <input type="hidden" name="type" value="site_setting">
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">网站名称</label>
                                <div class="col-sm-9">
                                    <input id="title" type="text" name="title" placeholder="" class="form-control form-control-success" value="<?=$siteData['title'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">副标题</label>
                                <div class="col-sm-9">
                                    <input id="name" type="text" name="name" placeholder="" class="form-control form-control-success" value="<?=$siteData['name'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">网站地址</label>
                                <div class="col-sm-9">
                                    <input id="site_url" type="text" name="site_url" placeholder="" class="form-control form-control-success" value="<?=$siteData['site_url'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">管理员邮箱</label>
                                <div class="col-sm-9">
                                    <input id="email" type="text" name="email" placeholder="" class="form-control form-control-success" value="<?=$siteData['email'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">ICP备案号</label>
                                <div class="col-sm-9">
                                    <input id="site_icp" type="text" name="site_icp" placeholder="" class="form-control form-control-success" value="<?=$siteData['site_icp'];?>">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                    <input type="submit" value="提交修改" class="btn btn-primary col-lg-5">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">邮件设置</h3>
                    </div>
                    <div class="card-body">
                        <form action="/admin/setting/update" method="post" class="form-horizontal">
                            <input type="hidden" name="type" value="site_email">
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">SMTP服务器地址</label>
                                <div class="col-sm-9">
                                    <input id="host" type="text" name="host" placeholder="" class="form-control form-control-success" value="<?=$siteEmail['host'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">SMTP服务器端口</label>
                                <div class="col-sm-9">
                                    <input id="port" type="text" name="port" placeholder="" class="form-control form-control-success" value="<?=$siteEmail['port'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">是否需要SSL</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="radio col-lg-6">
                                            <label>
                                                <input type="radio" name="secure" value="ssl" <?=$siteEmail['secure'] == 'ssl'?'checked':''?>> 使用SSL
                                            </label>
                                        </div>
                                        <div class="radio col-lg-6">
                                            <label>
                                                <input type="radio" name="secure" value="not" <?=$siteEmail['secure'] == 'not'?'checked':''?>> 不需要
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">发件人名称</label>
                                <div class="col-sm-9">
                                    <input id="nickname" type="text" name="nickname" placeholder="" class="form-control form-control-success" value="<?=$siteEmail['nickname'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">发件人邮箱地址</label>
                                <div class="col-sm-9">
                                    <input id="post_email" type="text" name="username" placeholder="" class="form-control form-control-success" value="<?=$siteEmail['username'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">发件人邮箱密码</label>
                                <div class="col-sm-9">
                                    <input id="post_password" type="text" name="password" placeholder="" class="form-control form-control-success" value="<?=$siteEmail['password'];?>">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" value="提交修改" class="btn btn-primary col-lg-12">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __THEME__.'/footer.php'; ?>