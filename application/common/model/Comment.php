<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/15
 * Time: 9:25
 */

namespace app\common\model;


use think\Model;

class Comment extends Model
{
    protected $name = 'comment';

    protected function getTimeAttr($time){
        return date("Y-m-d H:i:s",$time);
    }

    protected function getStatusStrAttr($value,$data){
        $status = [
            0   => '<span>待审核</span>',
            1   => '<span>已审核</span>',
            2   => '<span>未审核</span>'
        ];
        return $status[$data['status']];
    }
}