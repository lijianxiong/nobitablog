<?php include __THEME__.'/header.php'; ?>
    <div class="content-right col-md-10">
        <div class="person-body">
            <div class="row">
                <div class="col-md-6 item-card-body"><div class="item-card">
                        <div class="person-title">
                            <h4>个人信息</h4>
                        </div>
                        <div class="person-info">

                            <div class="form-group user-face">
                                <label for="exampleInputFile"><img src="<?=@$userData['face_url'];?>" alt="">
                                </label>
                                <input type="file" name="file" id="exampleInputFile" style="display: none;">
                                <input type="hidden" name="face_url" value="<?=@$userData['face_url'];?>">
                            </div>

                            <div class="form-group">
                                <label for="username">用户名</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?=@$userData['username'];?>" disabled="<?=@$userData['username']?'readonly':'disabled';?>">
                                <p class="help-block">通常只允许修改一次</p>
                            </div>
                            <div class="form-group">
                                <label for="password">用户密码</label>
                                <input type="password" class="form-control" id="password" name="password" value="">
                                <p class="help-block">留空即不修改原密码</p>
                            </div>
                            <div class="form-group">
                                <label for="nickname">个性名称</label>
                                <input type="text" class="form-control" id="nickname" name="nickname" value="<?=@$userData['nickname'];?>">
                                <p class="help-block">我们称之为马甲</p>
                            </div>
                            <div class="form-group">
                                <label for="email">邮箱地址</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?=@$userData['email'];?>">
                                <p class="help-block">用作登录的账号,请如实填写</p>
                            </div>
                            <div class="form-group">
                                <label for="description">个性签名</label>
                                <input type="text" class="form-control" id="description" name="description" value="<?=@$userData['description'];?>">
                                <p class="help-block">用一小段话诠释自己,如面朝大海春暖花开</p>
                            </div>


                            <div class="form-group">
                                <div class="a-submit create-item">
                                    <button type="submit"> 更改头像</button>
                                </div>
                            </div>

                        </div>
                    </div></div>
            </div>
        </div>
    </div>
<?php include __THEME__.'/footer.php'; ?>