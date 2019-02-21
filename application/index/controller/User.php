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
use app\common\model\Douban as DoubanModel;
use app\common\model\Msg as MsgModel;

class User extends Auth
{
    public function index()
    {
        $centerSum = [
            'visitor' => VisitorModel::count(),
            'article_sum' => ArticleModel::where('user_id',$this->userId())->count(),
            'comment_sum' => CommentModel::where('author_id',$this->userId())->count() + CommentModel::where('user_id',$this->userId())->count(),
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
        $this->redirect('/profile/comment');
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

    public function msg($page = 1){
        $path = url('/profile/msg/');
        $msgData = MsgModel::where('user_id',$this->userId())
            ->order('create_time', 'desc')
            ->paginate(10, true, [
                'page' => $page,
                'path' => $path . '[PAGE]'
            ]);
        $page = $msgData->render();
        $this->assign([
            'title' => '我的消息',
            'page' => $page,
            'msgData' => $msgData,
            'activeMsg' => 'active'
        ]);
        return $this->view->fetch('/user/msg');
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

        //print_r($userCategoryTree);exit;
        $this->assign([
            'title' => $title,
            'nav_cur' => 'write',
            'userCategory' => $userCategoryTree,
            'data' => $data
        ]);
        return $this->view->fetch('/user/write');
    }

    public function douBan($page = 1){
        $path = url('/profile/douban/');
        $douBanData = DoubanModel::where('user_id',$this->userId())
            ->order('create_time', 'desc')
            ->paginate(12, true, [
                'page' => $page,
                'path' => $path . '[PAGE]'
            ]);
        $movieResult = $this->douBanFormat($douBanData);
        $page = $douBanData->render();
        $this->assign([
            'title' => '豆瓣电影',
            'data' => $movieResult,
            'page' => $page
        ]);
        return $this->view->fetch('/user/douban');
    }

    public function douBanFormat($data){
        $movieList = [];
        foreach ($data as $key=>$item) {
            $content = json_decode($item['content'],true);
            $movieList[$key]['title'] = $content['title'];
            $movieList[$key]['alt'] = $content['alt'];
            $movieList[$key]['images'] = $content['images']['large'];
            $movieList[$key]['rating'] = $content['rating']['average'];

        }
        return $movieList;
    }

    public function getDouBan(){
        $data = input('post.');
        $id = htmlspecialchars($data['id']);
        $getUrl = 'https://api.douban.com/v2/movie/subject/'.$id;
        $result = file_get_contents($getUrl);
        $haveId = DoubanModel::where('user_id',$this->userId())->where('movie_id',$id)->value('movie_id');
        if (!empty($haveId)){
            $msg = [
                'status' => 1002,
                'msg' => '电影已经存在添加失败'
            ];
            return $msg;
        }else{

            $result = DoubanModel::create([
                'user_id' => $this->userId(),
                'movie_id' => $id,
                'content' => $result,
                'create_time' => time()
            ]);
            if ($result){
                $msg = [
                    'status' => 1001,
                    'msg' => '电影添加成功'
                ];
                return $msg;
            }else{
                $msg = [
                    'status' => 1002,
                    'msg' => '电影添加失败'
                ];
                return $msg;
            }
        }
    }
}