<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/22
 * Time: 9:30
 */

namespace app\admin\validate;


use think\Validate;

class Link extends Validate
{
    protected $rule = [
        ['title','require|min:1|max:255'],
        ['url','require|url|max:255'],
        ['description','min:0|max:300'],
        ['weight','number']
    ];
}