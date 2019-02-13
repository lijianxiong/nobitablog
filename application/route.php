<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get('admin/center/[:page]', 'admin/center/index');
Route::get('admin/visitor/[:page]', 'admin/visitor/index');
Route::get('admin/comment/page/[:page]', 'admin/comment/index');
Route::get('admin/comment/edit/[:id]', 'admin/comment/edit');
Route::rule('admin/comment/update', 'admin/comment/update');
Route::post('admin/comment/del', 'admin/comment/del');
Route::get('admin/article/write/[:id]', 'admin/article/write');
Route::get('admin/page/write/[:id]', 'admin/page/write');

Route::rule('admin/article/del/[:id]', 'admin/article/del');
Route::rule('admin/article/autoSave', 'admin/article/autoSave');
Route::rule('admin/article/recoveryArticle', 'admin/article/recoveryArticle');
Route::get('admin/category/show/[:id]', 'admin/category/show');
Route::get('admin/article/search/[:page]', 'admin/article/search');
Route::post('admin/links/edit', 'admin/links/edit');
Route::rule('admin/api', 'admin/api/action');
//首页
Route::get('index/[:page]', 'index/index');
Route::get('post/[:id]', 'index/post');
Route::get('single/[:slug]', 'single/index');
Route::get('links', 'page/links');
Route::post('links/register', 'page/linksRegister');
Route::get('archives/[:page]', 'page/archives');
Route::get('album/[:page]', 'page/album');
Route::get('category/[:id]', 'category/index');
Route::get('category/[:id]/page/[:page]', 'category/index');
Route::post('comment/post', 'comment/post');


Route::get('user', 'user/index');
Route::get('profile/article/[:page]', 'user/article');
Route::get('profile/comment/[:page]', 'user/comment');
Route::get('profile/dynamic/[:page]', 'user/dynamic');
Route::get('profile/edit', 'user/edit');
Route::get('profile/msg/[:page]', 'user/msg');
Route::get('profile/write/[:id]', 'user/write');


Route::get('dynamic', 'page/dynamic');
Route::get('dynamic/page/[:page]', 'page/dynamic');
Route::get('dynamicPost/[:id]', 'page/dynamicPost');
Route::get('search/[:param]','index/search');

//访客
Route::rule('visitor', 'index/visitor/index');
Route::rule('views', 'index/visitor/views');
//QQ互联登录
Route::rule('login', 'index/visitor/login');
Route::rule('qqCallBack', 'index/visitor/qqCallback');
Route::rule('callBackUrl', 'index/visitor/callBackUrl');

//文章页
Route::get(['[:id]'=>['index/post',[],['id'=>'\d+']]]);

//Rss
Route::rule('rss/[:num]','index/rss/index');
