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
            $parentEmail = CommentModel::where('id', $commentInertData['parent_id'])->value('email');
            if (!empty($parentEmail)) {
                $this->sendMail($parentEmail, '您在“' . $commentInertData['title'] . '”收到了新的评论', $mailTemplate['replyEmail']);
            }
            unset($commentInertData['parent_content'], $commentInertData['parent_author'], $commentInertData['title']);
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