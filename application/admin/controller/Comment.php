<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/15
 * Time: 9:24
 */

namespace app\admin\controller;
use app\common\model\Comment as CommentModel;
use app\common\model\Additional as AdditionalModel;

class Comment extends Base
{
    public function index($page=1){
        $data = input('get.');
        $id = htmlspecialchars(@$data['status']?$data['status']:0);
        $path = url('/admin/comment/page/');
        if(!empty($id)){
            $t = $id == 1 ? 1 : 0;
            $where      = ['status'   => $t];
            $commentData = CommentModel::where($where)
                ->where('user_id',$this->userId())
                ->order('id','desc')
                ->paginate(18,true, [
                    'page'     => $page,
                    'path'     => $path.'[PAGE]'.'?status='.$id
                ]);
        }else{
            $commentData    = CommentModel::where('id','>',0)
                ->where('user_id',$this->userId())
                ->order('id','desc')
                ->paginate(18,true, [
                    'page'     => $page,
                    'path'     => $path.'[PAGE]'.'?status='.$id
                ]);
        }
        $page = $commentData->render();
        $this->assign([
            'nav_cur' => 'comment',
            'commentList' => $commentData,
            'page' => $page,
            'avatar' => 'getGravatar',
            'title' => '评论管理',
        ]);
        return $this->fetch('/comment');
    }

    public function edit(){
        $data = input('post.');
        $id = htmlspecialchars($data['id']);
        $commentData = CommentModel::get($id);
        return $commentData;
    }

    public function update(){
        $data = input('post.');
        $id = htmlspecialchars($data['id']);
        $updata = [
            'author' => htmlspecialchars($data['author']),
            'email' => htmlspecialchars($data['email']),
            'content' => htmlspecialchars($data['content'])
        ];
        $result = CommentModel::where('id',$id)->update($updata);
        if ($result){
            $messageSataus = [
                'status' => 10001,
                'msg' => '评论修改成功!'
            ];
            return $messageSataus;
        }else{
            $messageSataus = [
                'status' => 10002,
                'msg' => '评论修改失败,内容相同或者网络错误!'
            ];
            return $messageSataus;
        }
    }

    public function del(){
        $data = input('post.');
        $result = CommentModel::destroy($data['id']);
        if ($result){
            $commentSum = AdditionalModel::where('article_id',$data['value'])->value('comment');
            $commentCount = --$commentSum;
            AdditionalModel::where('article_id',$data['value'])->update(['comment' => $commentCount]);
            $msg = [
                'status' => 1001,
                'msg' => '评论删除成功'
            ];
        }else{
            $msg = [
                'status' => 1002,
                'msg' => '评论删除失败'
            ];
        }
        return json_encode($msg);

    }
}