<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/28
 * Time: 18:03
 */

namespace app\index\controller;

use Parsedown;
use think\Db;
use app\common\model\User as UserModel;
use app\common\model\Center as CenterModel;
use app\common\model\Article as ArticleModel;
use app\common\model\Comment as CommentModel;
use app\common\model\Visitor as VisitorModel;
use app\common\model\Additional as AdditionalModel;

class User extends Auth
{
    public function index()
    {
        $centerSum = [
            'visitor' => VisitorModel::count(),
            'article_sum' => ArticleModel::where('user_id',$this->userId())->count(),
            'comment_sum' => AdditionalModel::where('user_id',$this->userId())->sum('comment'),
            'article_like' => AdditionalModel::where('user_id',$this->userId())->sum('agree')
        ];
        $insertData = [
            'user_id' => $this->userId(),
            'type' => 'statistical',
            'content' => json_encode($centerSum)
        ];
        $statistical = CenterModel::where('user_id',$this->userId())->where('type','statistical')->value('content');
        if (!$statistical){
            CenterModel::create($insertData);
        }
        $statistical = CenterModel::where('user_id',$this->userId())->where('type','statistical')->value('content');
        $userInfo = json_decode($statistical,true);
        if ($centerSum['article_sum'] > $userInfo['article_sum'] || $centerSum['comment_sum'] > $userInfo['comment_sum'] || $centerSum['article_like'] > $userInfo['article_like'] ){
            CenterModel::where('user_id',$this->userId())->where('type','statistical')->update([
                'content' => json_encode($centerSum)
            ]);
        }
        $this->redirect('/profile/dynamic');
        return $this->view->fetch('/user/index');
    }

    public function article($page = 1)
    {
        $path = url('/profile/article/');
        $articleList = ArticleModel::where('status', 1)
            ->where('user_id',$this->userId())
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
            'title' => '个人文章',
            'page' => $page,
            'article' => $listData,
            'activeArticle' => 'active'
        ]);
        return $this->view->fetch('/user/article');
    }

    public function comment($page = 1){
        $path = url('/profile/comment/');
        $commentData = CommentModel::where('user_id',$this->userId())
            ->whereOr('author_id',$this->userId())
            ->order('time', 'desc')
            ->paginate(10, true, [
                'page' => $page,
                'path' => $path . '[PAGE]'
            ]);
        $commentList = $this->commentFormatConversion($commentData);
        //print_r($commentList);exit;
        $page = $commentData->render();
        $this->assign([
            'title' => '我的评论',
            'page' => $page,
            'comment' => $commentList,
            'activeComment' => 'active'
        ]);
        return $this->view->fetch('/user/comment');
    }

    public function dynamic($page = 1){
        $path = url('/profile/dynamic/');
        $dynamicData = Db::table('nobita_user a,  nobita_dynamic b')
            ->where('a.id = b.user_id')
            ->where('b.user_id',$this->userId())
            ->order('b.create_time', 'desc')
            ->paginate(10, true, [
                'page' => $page,
                'path' => $path . '[PAGE]'
            ]);
        $page = $dynamicData->render();
        $this->assign([
            'title' => '动态',
            'dynamic' => $dynamicData,
            'page' => $page,
            'dynamicActive' => 'active'
        ]);
        return $this->view->fetch('/user/dynamic');
    }

    public function edit(){
        $this->assign([
            'title' => '修改资料',
            'editActive' => 'active'
        ]);
        return $this->view->fetch('/user/edit');
    }

    public function commentFormatConversion($commentData){
        $commentList = [];
        foreach ($commentData as $key => $item){
            $commentList[$key]['id'] = $item['id'];
            $commentList[$key]['title'] = $this->getTitle($item['value'],$item['type']);
            $commentList[$key]['user_id'] = $item['user_id'];
            $commentList[$key]['author_id'] = $item['author_id'];
            $commentList[$key]['parent_id'] = $item['parent_id'];
            $commentList[$key]['type'] = $item['type'];
            $commentList[$key]['value'] = $item['value'];
            $commentList[$key]['author'] = $item['author'];
            $commentList[$key]['email'] = $item['email']?$this->getGravatar($item['email']):$this->getFaceUrl($item['author_id']);
            $commentList[$key]['content'] = $item['content'];
            $commentList[$key]['time'] = $item['time'];
        }
        return $commentList;
    }

    public function getTitle($value,$type){
        if ($type == 'd'){
            $title = '动态';
        }else{
            $title = ArticleModel::where('id',$value)->value('title');
        }
        return $title;
    }

    public function callBackUrl(){
        return $this->view->fetch('/user/callback');
    }

    public function write($id=0){
        $id     = $id > 0 ? intval($id) : 0;
        $title = $id == 0 ? '开始创作' : '编辑创作';
        if ($id > 0){
            $result = ArticleModel::where('id',$id)
                ->where('user_id',$this->userId())
                ->find();
            if ($result['status'] == 0){
                $result['content'] =$result['draft'];
            }
        }
        $data = [
            'id' => $id > 0 ? $result['id'] : '',
            'title' => $id > 0 ? $result['title'] : '',
            'category_id' => $id > 0 ? $result['category_id'] : '',
            'create_time' => $id > 0 ? $result['create_time'] : date("Y-m-d H:i:s",time()),
            'description' => $id > 0 ? $result['description'] : '',
            'content' => $id > 0 ? $result['content'] : '',
            'update_time' => $id > 0 ? $result['update_time'] : date("Y-m-d H:i:s",time()),
            'allow_comment' => $id > 0 ? $result['allow_comment'] : 1,
            'status' => $id > 0 ? $result['status'] : '',
            'password' => $id > 0 ? $result['password'] : ''
        ];

        $userCategory = $this->userCategory();
        $userCategoryTree = $this->categoryTree($userCategory);
        $this->assign([
            'title' => $title,
            'nav_cur' => 'write',
            'userCategory' => $userCategoryTree,
            'data' => $data
        ]);
        return $this->view->fetch('/user/write');
    }
}