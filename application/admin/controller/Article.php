<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/8
 * Time: 9:43
 */

namespace app\admin\controller;

use app\common\model\Additional as AdditionalModel;
use app\common\model\Article as ArticleModel;

class Article extends Base
{
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
        return $this->fetch('write');
    }

    public function update(){
        $data   = input('post.');
        $result = $this->validate($data,"Article");
        if(!$result){
            return false;
        }
        $id    = intval($data['id']);
        //日期为空 给当前时间
        $create_time    = empty($data['create_time']) ? time() : strtotime($data['create_time']);
        $update_time    = empty($data['update_time']) ? time() : strtotime($data['update_time']);
        //status!=2 设置个毛密码
        $password       = $data['status']==2 ? $data['password'] : '';
        $data    = [
            'user_id'       => $this->userId(),
            'title'         => $data['title'],
            'slug'          => @$data['slug']?@$data['slug']:'',
            'status'        => intval($data['status']),
            'category_id'   => $data['category_id'],
            'content'       => $data['content'],
            'allow_comment' => @$data['allow_comment']=='on' ? 1 : 0,
            'draft'         => $data['content'],
            'description'   => $data['description'],
            'password'      => $password,
            'thumb'         => @$data['thumb'],
            'create_time'   => $create_time,
            'update_time'   => $update_time,
        ];
        if ($data['status'] !== 0){
            $data['draft'] = '';
        }
        if($id == 0){
            $result = ArticleModel::create($data);
            $id = $result->id;
            AdditionalModel::create([
                'user_id' => $this->userId(),
                'article_id' => $id
            ]);
        }else{
            $data['id']     = $id;
            $result = ArticleModel::update($data);
        }
        if(!$result){
            $result->getError();
        }else{
            $this->redirect('/profile/write/'.$id);
            return true;
        }
    }

    public function search(){
        $data = input('get.');
        $article = ArticleModel::where('user_id',$this->userId())
            ->where('title|content','like','%'.htmlspecialchars($data['keyword']).'%')
            ->order('create_time','desc')
            ->select();
        $category = $this->getCategory();
        $this->assign([
            'title' => '创作中心',
            'nav_cur' => 'article',
            'article' => $article,
            'category' => $category['item'],
            'categoryList' => $category['list']
        ]);
        return $this->fetch('/center');
    }

    public function autoSave(){
        $data = input('post.');
        $content = $data['content'];
        if(!empty($content)){
            $id = abs(intval($data['id']));
            if($id == 0){
                $data = [
                    'user_id' => $this->userId(),
                    'title'         => empty($data['title']) ? '[无标题]' : trim($data['title']),
                    'draft'         => $content,
                    'category_id'   => 1,
                    'status'        => 0,
                    'allow_comment' => 1,
                    'create_time'   => time(),
                    'update_time'   => time()
                ];
                $result = ArticleModel::create($data);
                if(!$result){
                    $msg = [
                        'status' => 1002,
                        'msg' => '未知原因,自动保存失败'
                    ];
                }else{
                    $id = $result->id;
                    $msg = [
                        'status' => 1001,
                        'msg' => '自动保存成功',
                        'id' => $id
                    ];
                    AdditionalModel::create([
                        'user_id' => $this->userId(),
                        'article_id' => $id
                    ]);
                }
                return $msg;
            }else{
                $result = ArticleModel::where('id',$id)
                    ->where('user_id',$this->userId())
                    ->update([
                    'title' => empty($data['title']) ? '[无标题]' : trim($data['title']),
                    'draft' => $content
                ]);
                if(!$result){
                    $msg = [
                        'status' => 1002,
                        'msg' => '已经有相同的内容，不进行自动保存',
                        'id' => $id
                    ];
                }else{
                    $msg = [
                        'status' => 1001,
                        'msg' => '自动保存成功',
                        'id' => $id
                    ];
                }

                return $msg;
            }
        }else{
            $json['err']    = 1;
            return $json;
        }


    }
}