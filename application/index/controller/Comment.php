<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2019/1/27
 * Time: 下午3:38
 */

namespace app\index\controller;

use app\common\model\Comment as CommentModel;
use app\common\model\Additional as AdditionalModel;
use app\common\model\User as UserModel;
use app\common\model\Msg as MsgModel;

class Comment extends Base
{
    public function post()
    {
        $data = input('post.');
        $commentInertData = [
            'title' => $data['title'],
            'user_id' => $data['user_id'],
            'author_id' => $data['author_id'],
            'parent_id' => $data['parent_id'],
            'parent_content' => $data['parent_content'],
            'parent_author' => $data['parent_author'],
            'type' => $data['type'],
            'value' => $data['value'],
            'author' => $data['author'],
            'email' => $data['email'],
            'url' => $data['url'],
            'content' => $data['content'],
            'time' => time(),
            'user_agent' => request()->header()['user-agent'],
            'ip' => request()->ip(),
        ];
        if ($data['email'] == NULL) {
            unset($commentInertData['email']);
        }
        if ($data['url'] == NULL) {
            unset($commentInertData['url']);
        }
        if (empty($commentInertData['content'])) {
            $msg = [
                'status' => 1002,
                'msg' => '评论失败,请输入评论内容!'
            ];
            return $msg;
        }
        $mailTemplate = $this->mailTemplate($commentInertData,$data['type']);
        if ($commentInertData['parent_id'] > 0) {
            $parentItem = CommentModel::where('id', $commentInertData['parent_id'])->field('id,email,author_id,content,value')->find();
            if (!empty($parentItem['email'])) {
                $this->sendMail($parentItem['email'], '您在“' . $commentInertData['title'] . '”收到了新的评论', $mailTemplate['replyEmail']);
            }
            unset($commentInertData['parent_content'], $commentInertData['parent_author'], $commentInertData['title']);
            if ($this->userId()){
                $msgInsert = [
                    'user_id' => $parentItem['author_id'],
                    'title' => $commentInertData['author'].' 回复了 您的<a href="/post/'.$parentItem['value'].'#n-comment-item-'.$parentItem['id'].'">评论</a>',
                    'content' => $commentInertData['content'],
                    'status' => 0,
                    'create_time' => time(),
                ];
                MsgModel::create($msgInsert);
            }
        } else {
            $sendUser = UserModel::where('id', $commentInertData['user_id'])->value('email');
            if (!empty($sendUser)) {
                $this->sendMail($sendUser, '您在“' . $commentInertData['title'] . '”收到了新的评论', $mailTemplate['newEmail']);
            }
            unset($commentInertData['parent_content'], $commentInertData['parent_author'], $commentInertData['title']);
        }
        $result = CommentModel::create($commentInertData);
        if ($result) {
            $commentSum = AdditionalModel::where('article_id', $data['value'])->value('comment');
            $commentCount = ++$commentSum;
            AdditionalModel::where('article_id', $data['value'])->update(['comment' => $commentCount]);
            $msg = [
                'status' => 1001,
                'msg' => '评论成功!'
            ];
        } else {
            $msg = [
                'status' => 1002,
                'msg' => '评论失败!'
            ];
        }
        return $msg;
    }
}