<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?> - <?= $_N['site']['title'] ?></title>
    <meta name="description" content="<?= $_N['site']['name']; ?>">
    <meta name="keywords" content="大雄,模板,nobita,199508,wordpress">
    <link type="image/vnd.microsoft.icon" href="/favicon.png" rel="shortcut icon">
    <link rel="stylesheet" href="<?= __PUBLIC__ ?>/css/reset.css">
    <link rel="stylesheet" href="<?= __PUBLIC__ ?>/font/icon/caomei1.2.8/style.css?ver=<?= time(); ?>">
    <link rel="stylesheet" href="<?= __PUBLIC__ ?>/css/main.css?ver=<?= time(); ?>">
    <script src="<?= __PUBLIC__ ?>/js/jquery.min.js"></script>
</head>
<body>
<div class="nobita-section">
    <div class="nobita-container">
        <div class="nobita-sidebar">
            <div class="n-gravatar">
                <a href="<?= $_N['site']['site_url']; ?>"><img
                            src="<?=$_N['session']['face_url']?$_N['session']['face_url']:'/theme/nobita/images/face.jpg'?>"
                            alt="<?= $_N['site']['title']; ?>">
                </a>
            </div>
            <div class="n-site-link">
                <ul>
                    <li><a href="<?= $_N['site']['site_url']; ?>"><i class="czs-home-l"></i> <?= $_N['site']['title'] ?>
                        </a></li>
                    <li><a href="/single/phper" title="phper"><i class="czs-web-edit"></i> phper</a></li>
                    <li><a href="/single/after95" title="after 95"><i class="czs-crown"></i> after 95</a></li>
                    <li><a href="/single/location" title="location"><i class="czs-location"></i> location</a></li>
                    <li><a href="/archives" title="archives"><i class="czs-read-l"></i> archives</a></li>
                    <?= $_N['session']['id'] ? '<li><a href="/user" title="我的中心"><i class="czs-user"></i> My-User</a></li>' : '<li><a href="javascript:;" class="user-login" title="QQ登录账号"><i class="czs-qq"></i> QQ-Login</a></li>' ?>
                </ul>
            </div>
        </div>
        <div class="nobita-menu">
            <div class="n-menu-top">
                <div class="n-search">
                    <form action="/search" role="search">
                        <div class="input">
                            <input name="kw" placeholder="时间真是个残忍的坏蛋" value="<?= $_GET['kw'] ? $_GET['kw'] : ''; ?>">
                            <button id="search-submit" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="n-nav">
                    <ul>
                        <li><a href="/" title="首页">首页</a></li>
                        <li><a href="/dynamic" title="碎碎念">碎碎念</a></li>
                        <li><a href="/category/1" title="日记簿">日记簿</a></li>
                        <li><a href="/category/3" title="代码录">代码录</a></li>
                        <li><a href="/album" title="生活圈">生活圈</a></li>
                        <li><a href="/single/about" title="关于我">关于我</a></li>
                        <li><a href="/links" title="我的邻居">我的邻居</a></li>
                        <?= $_N['session']['id'] ? '<li><a href="/user" title="我的中心">我的中心</a></li>' : '' ?>
                    </ul>
                </div>
            </div>

        </div>