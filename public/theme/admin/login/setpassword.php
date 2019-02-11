<?php include __THEME__.'/login/header.php'; ?>
    <div class="login-register">
        <div class="container">
            <div class="row">
                <div class="col-md-6 register">
                    <div class="login-right">
                        <div class="form-submit">
                            <div class="default-face row">
                                <div class="col-md-4">
                                    <img src="<?=__PUBLIC__?>/static/images/default.jpg" alt="">
                                </div>
                                <div class="col-md-8">
                                    <div class="form-header"><h3>重置密码</h3></div>
                                    <div class="form-info"><p>从有记忆开始，就喜欢站在屋檐下听雨声。</p></div>
                                </div>
                            </div>
                            <form class="form-type-material" action="/admin/login/update" method="post">
                                <input type="hidden" name="safe" value="<?=$_GET['safe_code']?>">
                                <input type="hidden" name="email" value="<?=$_GET['email']?>">
                                <div class="form-group">
                                    <label for="password">用户密码</label>
                                    <input type="password" class="form-control" id="password" name="password" value="">
                                </div>
                                <div class="form-group">
                                    <label for="password-conf">重复用户密码</label>
                                    <input type="password" class="form-control" id="password-conf" name="repassword" value="">
                                </div>
                                <br>
                                <button class="btn btn-bold btn-block btn-primary" type="submit">立刻重置</button>
                            </form>
                            <div class="tips">
                                <p class="text-center">如果你已经有了账户? <a href="/admin/login">登入</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include __THEME__.'/login/footer.php'; ?>