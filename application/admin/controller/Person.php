<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/24
 * Time: 15:46
 */

namespace app\admin\controller;
use think\Request;
use think\Session;
use app\common\model\User as UserModel;

class Person extends Base
{
    public function index(){
        $userData = UserModel::get($this->userId());
        $this->assign([
            'title' => '个人设置',
            'nav_cur' => 'persion',
            'userData' => $userData
        ]);
        return $this->fetch('/person');
    }

    public function updatePerson(){
        $data = input('post.');
        $salt = config('user.salt');
        $updateData = [
            'nickname' => $data['nickname']?$data['nickname']:'',
            'email' => $data['email'],
            'password' => $data['password']?md5(sha1($data['password']) . $data['email'] . $salt):'',
            'description' => $data['description']
        ];
        if (empty($data['password'])){
            unset($updateData['password']);
        }
        $result = UserModel::where('id',$this->userId())->update($updateData);
        if ($result){
            $msg = [
                'status' => 10001,
                'msg' => '用户基础信息修改成功!'
            ];
            return $msg;
        }else{
            $msg = [
                'status' => 10002,
                'msg' => '用户基础信息修改失败,没有需要修改的内容'
            ];
            return $msg;
        }
    }

    public function username(){
        $data = input('post.');
        $username = htmlspecialchars($data['username']);
        $dbUsername = UserModel::where('id',$this->userId())->value('username');
        if ($dbUsername){
            $msg = [
                'status' => 10002,
                'msg' => '不允许多次修改用户名'
            ];
            return $msg;
        }
        $haveUsername = UserModel::where('username',$username)->value('username');
        if (!empty($haveUsername)){
            $msg = [
                'status' => 10002,
                'msg' => '用户名已经存在'
            ];
            return $msg;
        }else{
            $result = UserModel::where('id',$this->userId())->update([
                'username' => $username
            ]);
            if ($result){
                $msg = [
                    'status' => 10002,
                    'msg' => '用户名修改成功'
                ];
                return $msg;
            }else{
                $msg = [
                    'status' => 10002,
                    'msg' => '用户名修改失败'
                ];
                return $msg;
            }
        }
    }

    public function uploadFace(Request $request){
        if ($request->file('file') == NULL){
            return $this->redirect('/admin/pserson');
        }
        $file = \think\Image::open(request()->file('file'));
        $dirTime = iconv("UTF-8", "GBK", ROOT_PATH . 'public' . DS . 'upload/face/'.$this->userId());
        if (file_exists($dirTime));
        else
            mkdir ($dirTime,0777,true);
        $fileUrl = $dirTime. DS .md5(time()).'.jpg';
        $info = $file->thumb(300, 300)->save($fileUrl);
        if ($info) {
            $faceUrl = strstr($fileUrl,"/upload");
            $updateData = [
                'face_url' => $faceUrl
            ];
            $result = UserModel::where('id',$this->userId())->update($updateData);
            if ($result){
                $user = UserModel::where('id',$this->userId())
                    ->field('id,username,nickname,email,face_url,group')
                    ->find();
                $userArray = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'nickname' => $user['nickname'],
                    'email' => $user['email'],
                    'face_url' => $user['face_url'],
                    'group' => $user['group']
                ];
                Session::set('user',$userArray);
                $this->redirect('/admin/person');
            }else{
                $this->redirect('/admin/person');
            }
        }
        return true;

    }

    public function proFileEdit(){
        $data = input('post.');
        $insertData = [
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'url' => $data['url'],
            'description' => $data['description'],
        ];
        $result = UserModel::where('id',$this->userId())->update($insertData);
        if ($result){
            $msg = [
                'status' => 1001,
                'msg' => '资料修改成功'
            ];
            return $msg;
        }else{
            $msg = [
                'status' => 1002,
                'msg' => '资料修改失败'
            ];
            return $msg;
        }
    }
}