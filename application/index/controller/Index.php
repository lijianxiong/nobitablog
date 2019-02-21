<?php

namespace app\index\controller;

use think\Db;
use Parsedown;
use think\Request;
use app\common\model\Article as ArticleModel;
use app\common\model\Comment as CommentModel;
use app\common\model\Additional as AdditionalModel;

class Index extends Base
{
    public function index($page = 1)
    {
        $path = url('/index/');
        $articleList = ArticleModel::where('status', 1)
            ->where('del',NULL)
            ->order('create_time', 'desc')
            ->paginate(10, true, [
                'page' => $page,
                'path' => $path . '[PAGE]'
            ]);
        $page = $articleList->render();
        $markDown = new Parsedown;
        $listData = [];
        foreach ($articleList as $listItem) {
            $listItem['description'] = $markDown->text($listItem['description']);
            $listItem['content'] = $markDown->text($listItem['content']);
            $listData[] = $this->listFormatConversion($listItem);
        }
        $this->assign([
            'page' => $page,
            'article' => $listData
        ]);
        return $this->view->fetch('/index');
    }

    public function post($id)
    {
        //$data = input('get.');
        //$pageNum = $data['page'] ? htmlspecialchars($data['page']) : 1;
        //$path = url('/post/' . $id . '/comment?page=');
        $articleData = Db::table('nobita_additional a, nobita_article b')
            ->where('a.article_id', $id)
            ->where('b.del', NULL)
            ->where('b.status', 1)
            ->where('b.id = a.article_id')
            ->order('b.create_time', 'desc')
            ->find();
//        $commentData = CommentModel::where('value', $id)
//            ->order('time', 'asc')
//            ->paginate(10, true, [
//                'page' => $pageNum,
//                'path' => $path . '[PAGE]'
//            ]);
        $articleStatus = $articleData['status'];
        if ($articleStatus!=1){
            echo '<a href="/">返回首页</a>';
            return '你没有访问权限!';
        }
        $articleViews = ++$articleData['views'];
        AdditionalModel::where('article_id', $id)->update([
            'views' => $articleViews
        ]);
        $commentData = CommentModel::where('value', $id)
            ->where('type','article')
            ->order('time', 'asc')
            ->select();
        $commentNum = CommentModel::where('value', $id)
            ->where('type','article')
            ->count();
        $articleData['comment'] = $commentData;
        $resultData = $this->articleFormatConversion($articleData);
        $this->assign([
            'title' => $resultData['article']['title'],
            'article' => $resultData['article'],
            'comment' => $resultData['comment'],
            'commentNum' => $commentNum,
            'userId' => $this->_N['session']['id']
        ]);
        return $this->view->fetch('/post');
    }

    public function search()
    {
        $data = input('get.');
        $keyWord = htmlspecialchars($data['kw']);
        $searchData = ArticleModel::where('title|content', 'like', '%' . $keyWord . '%')
            ->where('status', 1)
            ->order('create_time', 'desc')
            ->paginate(10, true, [
                'page' => $data['page'],
                'path' => 'search?kw=' . $keyWord . '&page=' . '[PAGE]'
            ]);
        $page = $searchData->render();
        $markDown = new Parsedown;
        $listData = [];
        foreach ($searchData as $listItem) {
            $listItem['description'] = $markDown->text($listItem['description']);
            $listItem['content'] = $markDown->text($listItem['content']);
            $listData[] = $this->listFormatConversion($listItem);
        }
        $this->assign([
            'title' => $keyWord.'的搜索结果',
            'page' => $page,
            'article' => $listData
        ]);
        return $this->view->fetch('/index');
    }

}
