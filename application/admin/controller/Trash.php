<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/24
 * Time: 15:28
 */

namespace app\admin\controller;
use think\Db;
use app\common\model\Article as ArticleModel;
use app\common\model\Category as CategoryModel;


class Trash extends Base
{
    public function index(){
        $articleData = Db::table('nobita_additional a, nobita_article b')
            ->where('b.user_id',$this->userId())
            ->where('b.del',1)
            ->where('b.id = a.article_id')
            ->order('create_time','desc')
            ->select();
        $category = $this->getCategory();
        $this->assign([
            'title' => '回收站',
            'nav_cur' => 'trash',
            'article' => $articleData,
            'category' => $category['item'],
            'categoryList' => $category['list']
        ]);
        return $this->fetch('/trash');
    }
}