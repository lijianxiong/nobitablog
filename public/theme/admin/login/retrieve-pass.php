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
                                    <div class="form-header"><h3>取回密码</h3></div>
                                    <div class="form-info"><p>使用邮箱地址找回密码</p></div>
                                </div>
                            </div>
                            <form class="form-type-material" action="/admin/login/sencode" method="post">
                                <div class="form-group">
                                    <label for="email">邮箱地址</label>
                                    <input type="email" class="form-control" id="email" name="email" value="" >
                                </div>
                                <br>
                                <button class="btn btn-bold btn-block btn-primary" type="submit">立刻找回</button>
                            </form>
                            <div class="tips">
                                <p class="text-center">还没有账号吗? <a href="/admin/login/register">开始注册</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include __THEME__.'/login/footer.php'; ?>