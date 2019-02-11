<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/26
 * Time: 11:13
 */

namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
    protected $rule = [
        ['title','require|min:1|max:255'],
        ['slug','require|/^[0-9a-zA-Z\-]*$/|min:1|max:50']
    ];
}