<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/29
 * Time: 14:41
 */

namespace app\index\controller;


use think\Controller;
use app\common\model\User as UserModel;
use app\common\model\Center as CenterModel;
use app\common\model\Category as CategoryModel;

class Auth extends Base
{
    public $userData;
    public function _initialize()
    {
        parent::_initialize();
        $session = $this->_N['session']['id'];
        if (!$session){
            $this->redirect('/');
            return false;
        }
        $userData['base'] = UserModel::get($this->userId());
        $userData['center'] = json_decode(CenterModel::where('user_id', $this->userId())->where('type', 'statistical')->value('content'), true);
        $this->userData = $userData;
        $this->assign([
            'title' => '用户中心',
            'userData' => $this->userData
        ]);
    }

    public function userCategory(){
        $GetCategoryAll = CategoryModel::where('user_id',$this->userId())
            ->where('del',0)
            ->select();
        return $GetCategoryAll;
    }

    public function categoryTree($data,$parentid=0,$deep=0){
        static $tree = array();
        foreach ($data as $rows){
            if ($rows['parent_id'] == $parentid){
                $rows['deep'] = $deep;
                $tree[] = $rows;
                self::categoryTree($data,$rows['id'],$deep+1);
            }
        }
        return $tree;
    }
}