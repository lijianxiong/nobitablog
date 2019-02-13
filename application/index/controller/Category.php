<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2019/1/27
 * Time: 下午10:10
 */

namespace app\index\controller;

use Parsedown;
use app\common\model\Article as ArticleModel;
use app\common\model\Category as CategoryModel;

class Category extends Base
{
    public function index($id = 1, $page = 1)
    {
        $path = url('/category/' . $id . '/page/');
        $articleList = ArticleModel::where('status', 1)
            ->where('category_id', $id)
            ->order('create_time', 'desc')
            ->paginate(10, true, [
                'page' => $page,
                'path' => $path . '[PAGE]'
            ]);
        $categoryList = CategoryModel::where('parent_id',$id)
            ->select();
        $page = $articleList->render();
        $markDown = new Parsedown;
        $listData = [];
        foreach ($articleList as $listItem) {
            $listItem['description'] = $markDown->text($listItem['description']);
            $listItem['content'] = $markDown->text($listItem['content']);
            $listData[] = $this->listFormatConversion($listItem);
        }
        $categoryTitle = CategoryModel::where('id',$id)->value('title');
        $this->assign([
            'title' => $categoryTitle,
            'page' => $page,
            'article' => $listData,
            'childrenCategory' => $categoryList
        ]);
        return $this->view->fetch('/index');
    }

    public function categoryTree($data,$parentId=0,$deep=0){
        $tree = [];
        foreach ($data as $rows){
            if ($rows['parent_id'] == $parentId){
                $rows['deep'] = $deep;
                $tree[] = $rows;
                $tree = array_merge($tree, self::categoryTree($data,$rows['id'],$deep+1));
            }
        }
        return $tree;
    }
}