<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=@$title;?></title>
    <link rel="stylesheet" href="<?=__PUBLIC__?>/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=__PUBLIC__?>/static/caomei/style.css">
    <link href="<?=__PUBLIC__?>/static/css/style.css?ver=<?=time()?>" type="text/css" rel="stylesheet"/>
    <script src="<?=__PUBLIC__?>/static/js/jquery.min.js"></script>
    <link rel="icon" href="/favicon.png">
</head>
<body>
<div class="wrapper">
    <div id="tips" style="display: none;">
        <p><i class="czs-bell-l"></i> <span class="t-info"></span></p>
    </div>
<div class="note-header row">
    <div class="logo col-md-2">
        <div class="site-name">
                    <span>
                        <i class="czs-layers"></i><a href="/admin">SecretNote</a>
                    </span>
        </div>
    </div>
    <div class="search col-md-4">
        <div class="row">
            <div class="search-icon col-md-1">
                <i class="czs-search-l"></i>
            </div>
            <div class="search-input col-md-11">
                <form class="" action="/admin/article/search" method="get">
                    <input type="text" name="keyword" placeholder="搜索感兴趣的知识和文章" value="<?=@$_GET['keyword']?@$_GET['keyword']:'' ?>">
                </form>
            </div>
        </div>
    </div>
    <div class="header-user col-md-6">
        <div class="row">
            <div class="col-md-10 right-title">
                <p><span class="czs-message-l"></span> <span class="czs-bell-l"> </span></p>
            </div>
            <div class="col-md-2">
                <div class="user-info">
                    <img src="<?=$userInfo['face_url']?$userInfo['face_url']:'/static/images/face.png';?>" alt="创作中心">
                    <div class="mask"></div>
                    <div class="dropdown-user" style="display: none;">
                                                    <a class="dropdown-item" href="/admin/person"><i class="ti-user"></i> 个人设置</a>
<!--                                                    <a class="dropdown-item" href="/admin/loginlog"><i class="ti-desktop"></i> 登录日志</a>-->
<!--                                                    <a class="dropdown-item" href="/admin/setting/user"><i class="ti-user"></i> 用户管理</a>-->
<!--                                                    <a class="dropdown-item" href="/admin/invitation"><i class="ti-gift"></i> 邀请码管理</a>-->
                                                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/admin/login/logout"><i class="ti-power-off"></i> 登出账号</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div id="site-bar" class="row">
        <div class="content-left col-md-2">
            <div class="sidebar">
                <div class="create-item">
                    <p><a href="/admin/article/write">
                            <button>
                                <i class="czs-write-l"></i> 新建日记
                            </button>
                        </a>
                    </p>
                </div>
                <div class="navigate">
                    <ul>
                        <?php
                        foreach ($navBar as $t_list) {
                            foreach ($t_list as $t_row) {
                                if (empty($nav_cur) && $t_row[0] == 'article') {
                                    $t = ' class="active"';
                                } else {
                                    $t = @$nav_cur == $t_row[0] ? ' class="active"' : '';
                                }
                                echo '<li' . $t . '><a href="' . $t_row[1] . '">' . $t_row[2] . '</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>