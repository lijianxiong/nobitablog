<?php include __THEME__ . '/header.php'; ?>
    <section class="person-setting" id="person-setting">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">基础信息</h3>
                        </div>
                        <div class="card-body person-form">
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">用户名</label>
                                <div class="col-sm-7">
                                    <input type="text" <?= $userData['username'] ? 'disabled' : ''; ?> name="username"
                                           id="username" placeholder="" class="form-control"
                                           value="<?= $userData['username'] ? $userData['username'] : ''; ?>">
                                    <small class="form-text">只允许修改一次</small>
                                </div>
                                <?= $userData['username'] ? '' : '<div class="col-sm-3"><span class="btn btn-primary col-lg-12 username-base-btn">提交修改</span></div>'; ?>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">个性名称</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nickname" id="nickname" placeholder="" class="form-control"
                                           value="<?= $userData['nickname'] ? $userData['nickname'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">用户密码</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" id="password" placeholder=""
                                           class="form-control" value="">
                                    <small class="form-text">留空即为不修改密码</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">用户Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" id="email" placeholder="" class="form-control"
                                           value="<?= $userData['email'] ? $userData['email'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">个人介绍</label>
                                <textarea name="description" id="description" class="form-control" cols="30"
                                          rows="5"><?= $userData['description'] ? $userData['description'] : ''; ?></textarea>
                                <small class="form-text">200字以内的个人短介绍</small>
                            </div>
                            <div class="form-group">
                                <span class="btn btn-primary col-lg-12 person-base-btn">提交修改</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">修改头像</h3>
                        </div>
                        <div class="card-body">
                            <form action="/admin/person/uploadface" method="post" enctype="multipart/form-data">
                                <div class="form-group upload-face">
                                    <p class="user-face-upload"><label for="exampleInputFile"><img
                                                    src="<?= $userData['face_url'] ? $userData['face_url'] : '/theme/adminv2/img/default.png' ?>"
                                                    alt="<?= $userData['nickname'] ? $userData['nickname'] : ''; ?>"></label>
                                    </p>
                                    <input type="file" name="file" id="exampleInputFile">
                                    <input type="hidden" name="face_url" value="">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="提交修改" class="btn btn-primary col-lg-12">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include __THEME__ . '/footer.php'; ?>