<?php include __THEME__.'/login/header.php'; ?>
    <meta http-equiv="Refresh" content="<?=@$time;?>; url=<?=@$url;?>"/>
    <div class="tips">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tips-body">
                    <div class="login-right">
                        <p class="tips-text">提示信息:<?=@$msg;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include __THEME__.'/login/footer.php'; ?>