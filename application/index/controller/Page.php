<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2019/1/27
 * Time: 下午10:26
 */

namespace app\index\controller;

use think\Db;
use Parsedown;
use app\common\model\Link as LinkModel;
use app\common\model\Article as ArticleModel;
use app\common\model\Dynamic as DynamicModel;
use app\common\model\Comment as CommentModel;

class Page extends Base
{
    public function album($page = 1)
    {
        $path = url('/album/');
        $articleList = ArticleModel::where('status', 1)
            ->where('category_id', 15)
            ->order('create_time', 'desc')
            ->paginate(18, true, [
                'page' => $page,
                'path' => $path . '[PAGE]'
            ]);
        $page = $articleList->render();
        $markDown = new Parsedown;
        $listData = [];
        foreach ($articleList as $item) {
            $content = $markDown->text($item->content);
            $listData[] = $this->reachAlbum($content, $item->id, $item->title);
        }
        $articleSum = ArticleModel::where('category_id', 15)->count();
        $this->assign([
            'title' => '生活圈',
            'page' => $page,
            'article' => $listData,
            'sum' => $articleSum
        ]);
        return $this->view->fetch('/album');
    }

    public function reachAlbum($content, $id, $title)
    {
        $pattern = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.BMP|\.JPG|\.PNG]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern, $content, $matches);
        $article['thumb'] = empty($matches[1][0]) ? '' : $this->thumb($matches[1][0], 800, 800);
        $article['title'] = $title;
        $article['id'] = $id;
        return $article;
    }

    public function links()
    {
        $linksData = LinkModel::all(function ($query) {
            $query->order('weight', 'asc');
        });
        $linksSum = LinkModel::where('status', 1)->count();
        $this->assign([
            'title' => '邻居',
            'links' => $linksData,
            'sum' => $linksSum,
            'userId' => $this->_N['user_id']
        ]);
        return $this->view->fetch('/links');
    }

    public function linksRegister()
    {
        $data = input('post.');
        $inserData = [
            'title' => $data['title'],
            'url' => $data['url'],
            'email' => $data['email'],
            'description' => $data['description'],
            'status' => 0
        ];
        $result = LinkModel::create($inserData);
        if ($result) {
            $msg = [
                'status' => 1001,
                'msg' => '友链提交申请成功'
            ];
            return json_encode($msg);
        } else {
            $msg = [
                'status' => 1002,
                'msg' => '友链提交申请失败'
            ];
            return json_encode($msg);
        }
    }

    public function archives($page = 1)
    {
        $path = url('/archives/');
        $articleList = ArticleModel::where('status', 1)
            ->order('create_time', 'desc')
            ->paginate(30, true, [
                'page' => $page,
                'path' => $path . '[PAGE]'
            ]);
        $articleSum = ArticleModel::where('status', 1)->count();
        $page = $articleList->render();
        $this->assign([
            'title' => '归档',
            'archives' => $articleList,
            'page' => $page,
            'sum' => $articleSum
        ]);
        return $this->view->fetch('/archives');
    }

    public function dynamic($page = 1)
    {
        $path = url('/dynamic/page/');
        $dynamicData = Db::table('nobita_user a,  nobita_dynamic b')
            ->where('a.id = b.user_id')
            ->order('b.create_time', 'desc')
            ->paginate(10, true, [
                'page' => $page,
                'path' => $path . '[PAGE]'
            ]);
        $dynamicSum = DynamicModel::count();
        $page = $dynamicData->render();
        $this->assign([
            'title' => '动态',
            'dynamic' => $dynamicData,
            'page' => $page,
            'sum' => $dynamicSum
        ]);
        return $this->view->fetch('/dynamic');
    }

    public function dynamicPost($id)
    {
        $articleData = DynamicModel::get($id);
        $commentData = CommentModel::where('value', $id)
            ->where('type', 'd')
            ->order('time', 'asc')
            ->select();
        $views = ++$articleData['views'];
        DynamicModel::where('id',$id)->update([
            'views' => $views
        ]);
        $articleData['comment'] = $commentData;
        $resultData = $this->dynamicFormConversion($articleData);
        $this->assign([
            'title' => '动态',
            'article' => $resultData['article'],
            'comment' => $resultData['comment'],
            'userId' => $this->_N['session']['id']
        ]);
        return $this->view->fetch('/dynamic/post');
    }
    public function dynamicFormConversion($articleData){
        $article = [
            'article' => [
                'id' => $articleData['id'],
                'title' => '动态',
                'user_id' => $articleData['user_id'],
                'views' => $this->numFormat($articleData['views']),
                'type' => 'd',
                'create_time' => $articleData['create_time'],
                'content' => $articleData['content'],
            ],
            'comment' => $this->getCommentList($articleData['comment'])
        ];
        return $article;
    }
}