<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2019/1/28
 * Time: 下午9:12
 */

namespace app\admin\controller;

use app\common\model\Dynamic as DynamicModel;
use app\common\model\Comment as CommentModel;

class Dynamic extends Base
{
    public function post(){
        $data = input('post.');
        $insertData = [
            'user_id' => $this->userId(),
            'content' => htmlspecialchars($data['content']),
            'create_time' => time(),
            'ip' => request()->ip()
        ];
        $result = DynamicModel::create($insertData);
        if ($result){
            $msg = [
                'status' => 1001,
                'msg' => '动态发布成功',
                'content' => htmlspecialchars($data['content']),
                'create_time' => date('Y-m-d H:i:s',time()),
                'id' => $result->id
            ];
            return $msg;
        }else{
            $msg = [
                'status' => 1002,
                'msg' => '动态发布失败'
            ];
            return $msg;
        }
    }

    public function del(){
        $data = input('post.');
        $id = htmlspecialchars($data['id']);
        $result = DynamicModel::destroy($id);
        if ($result){
            CommentModel::where('type','d')
                ->where('value',$id)
                ->delete();
            $msg = [
                'status' => 1001,
                'msg' => '动态删除成功'
            ];
            return $msg;
        }else{
            $msg = [
                'status' => 1002,
                'msg' => '动态删除失败'
            ];
            return $msg;
        }

    }
}