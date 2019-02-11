<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/21
 * Time: 16:41
 */

namespace app\admin\controller;
use think\Db;
use app\common\model\Article as ArticleModel;
class Bookmark extends Base
{
    public function index(){
//        $article = ArticleModel::where('user_id',$this->userId())
//            ->where('del',NULL)
//            ->where('mark',1)
//            ->order('create_time','desc')
//            ->select();
        $articleData = Db::table('nobita_article a, nobita_additional b')
            ->where('a.user_id',$this->userId())
            ->where('a.del',NULL)
            ->where('mark',1)
            ->where('a.id = b.article_id')
            ->order('create_time','desc')
            ->select();
        $category = $this->getCategory();
        $this->assign([
            'title' => '收藏中心',
            'nav_cur' => 'bookmark',
            'article' => $articleData,
            'category' => $category['item'],
            'categoryList' => $category['list']
        ]);
        return $this->fetch('/center');
    }
}