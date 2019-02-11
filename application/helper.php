<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/15
 * Time: 10:26
 */

/**
 * 获取Gravatar头像链接
 * @param $email
 * @return string
 */
function getGravatar($email) {
    /**
     * 修改这个函数 收到$email 先md5，检测本地是否存在缓存过的文件，如果存在 直接返回本地的地址
     * 如果不存在 file_get_contens得到图片资源后，file_put_contents缓存下来，然后还是返回本地的地址
     */
    $id = md5(strtolower(trim($email)));
    $filePath = './avatar/';
    $fileName = $filePath.$id.'.jpg';
    if(!is_file($fileName)){
        //缓存不存在
        if(!is_dir($filePath)){
            mkdir($filePath);
        }
        $url = 'http://secure.gravatar.com/avatar/'.$id;
        $res = file_get_contents($url);
        if(!file_put_contents($fileName,$res)){
            return '//secure.gravatar.com/avatar/'.$id;
        }
    }
    return '/avatar/'.$id.'.jpg?6';
}