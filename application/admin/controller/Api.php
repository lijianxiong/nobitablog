<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/21
 * Time: 15:40
 */

namespace app\admin\controller;
use app\common\model\Article as ArticleModel;
use app\common\model\Comment as CommentModel;

class Api extends Base
{
    public function messageStatus($result,$msg){
        if ($result){
            return json_encode([
                'status' => 10001,
                'msg' => $msg['success']
            ]);
        }else{
            return json_encode([
                'status' => 10002,
                'msg' => $msg['error']
            ]);
        }
    }

    public function action(){
        $data = input('post.');
        $id = htmlspecialchars($data['id']);
        $type = htmlspecialchars($data['type']);
        $model = htmlspecialchars($data['model']);
        $msg = [];
        if ($type == 'del'){
            if ($model == 'article'){
                $result = ArticleModel::where('id',$id)
                    ->update([
                    'del' => 1
                ]);
                $msg = [
                    'success' => '创作删除成功!',
                    'error' => '创作删除失败!'
                ];
            }elseif($model == 'comment') {
                $result = CommentModel::where('id', $id)
                    ->delete();
                $msg = [
                    'success' => '评论删除成功!',
                    'error' => '评论删除失败!'
                ];
            }
            return $this->messageStatus($result,$msg);
        }
        if ($type == 'mark'){
            if ($model == 'article'){
                $articleData = ArticleModel::where('id',$id)
                    ->where('user_id',$this->userId())
                    ->find();
                if ($articleData['mark'] == 1){
                    $result = ArticleModel::where('id',$id)
                        ->where('user_id',$this->userId())
                        ->update([
                        'mark' => 0
                    ]);
                    $msg = [
                        'success' => '创作【'.$articleData['title'].'】取消收藏成功!',
                        'error' => '创作【'.$articleData['title'].'】取消收藏失败!'
                    ];
                    return $this->messageStatus($result,$msg);
                }else{
                    $result = ArticleModel::where('id',$id)
                        ->where('user_id',$this->userId())
                        ->update([
                        'mark' => 1
                    ]);
                    $msg = [
                        'success' => '创作【'.$articleData['title'].'】收藏成功!',
                        'error' => '创作【'.$articleData['title'].'】收藏失败!'
                    ];
                    return $this->messageStatus($result,$msg);
                }

            }
        }
        if ($type == 'destory'){
            if ($model == 'article'){
                $result = ArticleModel::where('id',$id)
                    ->where('user_id',$this->userId())
                    ->delete();
            }
            return $this->state($result);
        }
        if($type == 'trash'){
            $articleData = ArticleModel::where('id',$id)
                ->where('user_id',$this->userId())
                ->find();
            $result = ArticleModel::where('id',$id)
                ->where('user_id',$this->userId())
                ->update([
                'del' => NULL
            ]);
            if ($result){
                return json_encode([
                    'status' => 10001,
                    'msg' => '创作【'.$articleData['title'].'】恢复成功!'
                ]);
            }else{
                return json_encode([
                    'status' => 10002,
                    'msg' => '创作【'.$articleData['title'].'】恢复失败!'
                ]);
            }
            //return $this->state($result);
        }
        if($type == 'status'){
            if ($model == 'comment'){
                $comment = CommentModel::where('id',$id)
                    ->where('user_id',$this->userId())
                    ->value('status');
                if ($comment == 1){
                    $result = CommentModel::where('id',$id)
                        ->where('user_id',$this->userId())
                        ->update([
                        'status' => 0
                    ]);
                    $msg = [
                        'success' => '设置为未审核成功!',
                        'error' => '设置为未审核失败!'
                    ];
                    return $this->messageStatus($result,$msg);
                }else{
                    $result = CommentModel::where('id',$id)
                        ->where('user_id',$this->userId())
                        ->update([
                        'status' => 1
                    ]);
                    $msg = [
                        'success' => '设置为审核成功!',
                        'error' => '设置为审核失败!'
                    ];
                    return $this->messageStatus($result,$msg);
                }

            }
        }
    }

    public function state($result){
        if ($result){
            echo 1;
        }else{
            echo 2;
        }
    }
}