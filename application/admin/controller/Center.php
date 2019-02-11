<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/8
 * Time: 9:35
 */

namespace app\admin\controller;
use app\common\model\Article as ArticleModel;
use think\Db;
class Center extends Base
{
    public function index($page=1){
        $path = url('/admin/center/');
        $articleData = Db::table('nobita_additional a, nobita_article b')
            ->where('b.user_id',$this->userId())
            ->where('b.del',NULL)
            ->where('b.id = a.article_id')
            ->order('create_time','desc')
            ->paginate(18,true, [
                'page'     => $page,
                'path'     => $path.'[PAGE]'
            ]);
        $page = $articleData->render();
        $category = $this->getCategory();
        $this->assign([
            'title' => '创作中心',
            'nav_cur' => 'article',
            'article' => $articleData,
            'page' => $page,
            'category' => $category['item'],
            'categoryList' => $category['list']
        ]);
        return $this->fetch('/center');
    }
}