<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2019/2/2
 * Time: 下午3:20
 */

namespace app\admin\controller;

use app\common\model\Page as PageModel;

class Page extends Base
{
    public function index(){
        $pageDate = PageModel::where('status',1)->order('create_time','desc')->select();
        $this->assign([
            'title' => '创作中心',
            'nav_cur' => 'page',
            'article' => $pageDate
        ]);
        return $this->fetch('/page');
    }

    public function write($id){
        $id     = $id > 0 ? intval($id) : 0;
        $title = $id == 0 ? '开始创作' : '编辑创作';
        if ($id > 0){
            $result = PageModel::where('id',$id)
                ->where('user_id',$this->userId())
                ->find();;
            if ($result['status'] == 0){
                $result['content'] =$result['draft'];
            }
        }
        $data = [
            'id' => $id > 0 ? $result['id'] : '',
            'title' => $id > 0 ? $result['title'] : '',
            'create_time' => $id > 0 ? $result['create_time'] : date("Y-m-d H:i:s",time()),
            'content' => $id > 0 ? $result['content'] : '',
            'update_time' => $id > 0 ? $result['update_time'] : date("Y-m-d H:i:s",time()),
            'allow_comment' => $id > 0 ? $result['allow_comment'] : 1,
            'status' => $id > 0 ? $result['status'] : '',
            'slug' => $id > 0 ? $result['slug'] : ''
        ];
        $this->assign([
            'title' => $title,
            'nav_cur' => 'write',
            'data' => $data
        ]);
        return $this->fetch('page/write');
    }

    public function update(){
        $data = input('post.');
        $result = $this->validate($data,"Article");
        if(!$result){
            return false;
        }
        $id    = intval($data['id']);
        //日期为空 给当前时间
        $create_time    = empty($data['create_time']) ? time() : strtotime($data['create_time']);
        $update_time    = empty($data['update_time']) ? time() : strtotime($data['update_time']);
        $data = [
            'user_id'       => $this->userId(),
            'title' => $data['title'],
            'status' => $data['status'],
            'create_time'   => $create_time,
            'update_time'   => $update_time,
            'content' => $data['content'],
            'allow_comment' => @$data['allow_comment']=='on' ? 1 : 0,
            'draft'         => $data['content'],
            'slug'          => @$data['slug']?@$data['slug']:'',
        ];
        if($id == 0){
            $result = PageModel::create($data);
            $id = $result->id;
        }else{
            $data['id']     = $id;
            $result = PageModel::update($data);
        }
        if(!$result){
            $result->getError();
        }else{
            $this->redirect('/admin/page/write/'.$id);
            return true;
        }
    }
}