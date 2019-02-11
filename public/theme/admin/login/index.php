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
                                    <div class="form-header"><h3>登入账户</h3></div>
                                    <div class="form-info"><p>从有记忆开始，就喜欢站在屋檐下听雨声。</p></div>
                                </div>
                            </div>
                            <form class="form-type-material" action="/admin/login/join" method="post">
                                <div class="form-group">
                                    <label for="email">邮箱地址</label>
                                    <input type="text" class="form-control" id="email" name="username" value="" >
                                </div>
                                <div class="form-group">
                                    <label for="password">用户密码</label>
                                    <input type="password" class="form-control" id="password" name="password" value="">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 check">
                                    <input type="checkbox" checked> 记住登录
                                    </div>
                                    <div class="col-md-6 remember">
                                    <a class="text-muted" href="/admin/login/retrievepass">忘记密码?</a>
                                </div>
                                </div>
                                <br>
                                <button class="btn btn-bold btn-block btn-primary" type="submit">立刻登入</button>
                            </form>
                            <div class="tips">
                                <p class="text-center">还没有账号吗? <a href="/admin/login/register">开始注册</a> / <a href="/login" style="text-decoration: none;color: #333;">QQ登录</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include __THEME__.'/login/footer.php'; ?>