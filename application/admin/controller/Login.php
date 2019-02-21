<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/6
 * Time: 14:29
 */
namespace app\admin\controller;
use think\Session;
use think\View;
use think\Controller;
use app\common\model\User as UserModel;
use app\common\model\Safecode as SafecodeModel;
use app\common\model\Invitationcode as InviModel;
use app\common\model\Site as SiteModel;

class Login extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        //视图实例化，冲定义模板路径
        $this->view = new View([
            'type'          => 'php',
            'view_path'     => './theme/admin/',
            'view_suffix'   => 'php',
            'view_depr'     => '/',
        ]);
        if(!defined('__THEME__')){
            define('__THEME__','./theme/admin');
            define('__PUBLIC__','/theme/admin');
        }
    }

    public function index(){
        //如已登录，跳回首页
        $flag = Session::get('user.id');
        if($flag){
            $this->redirect('/admin');
            return false;
        }
        $this->assign([
            'title' => '开始登入'
        ]);
        return $this->view->fetch('/login/index');
    }

    public function register(){
        $this->assign([
            'title' => '注册账户'
        ]);
        return $this->view->fetch('/login/register');
    }
    public function addUser(){
        $data = input('post.');
        $user = [
            'username' => htmlspecialchars($data['username']),
            'code' => htmlspecialchars($data['code']),
            'password' => htmlspecialchars($data['password']),
            'repassword' => htmlspecialchars($data['repassword'])
        ];
        if (!empty($data) && !empty($user['password']) || !empty($user['repassword'])){
            if ($user['password'] != $user['repassword']) {
                return $this->tips('两次输入的密码不一致，请重新输入!','error');
            } else {
                $userInfo = UserModel::where('email', $user['username'])->value('email');
                if (!empty($userInfo)){
                    return $this->tips('邮箱已经存在了,请更换邮箱地址!','error');
                }else{
                    //校验邀请码
                    $inviCode = InviModel::where('code',$user['code'])->field('email,group')->find();
                    if (empty($inviCode)){
                        return $this->tips('该邀请码不存在!','error',5);
                    }
                    if (!empty($inviCode['email'])){
                        return $this->tips('该邀请码已经被使用!','error',5);
                    }
                    $salt = config('user.salt');
                    $result = UserModel::create([
                        'email' => htmlspecialchars($user['username']),
                        'password' => htmlspecialchars(md5(sha1($user['password']) . $user['username'] . $salt)),
                        'create_time' => time(),
                        'update_time' => time(),
                        'group' => $inviCode['group']
                    ]);
                    if ($result) {
                        InviModel::where('code',$user['code'])->update([
                            'email' => $user['username'],
                            'use_time' => time()
                        ]);
                        $this->logOut();
                        return $this->tips('注册成功,感谢你加入我们!','success',5,'/admin/login');
                    } else {
                        return $this->tips('注册失败,你的填写有误，请重新填写，如无法注册请联系我们4020426#QQ.com!','error');
                    }
                }
            }
        }
        return $this->tips('请认真填写注册信息!','error',3,'/admin/login/register');

    }

    public function join(){
        $data = input('post.');
        $salt = config('user.salt');
        $validate = htmlspecialchars($data['username']);
        $user = UserModel::where('email',$validate)->field('id,username,nickname,password,email,face_url,group')->find();
        $rePassword = md5(sha1($data['password']) . $data['username'] . $salt);
        if ($user['password'] == $rePassword){
            $userArray = [
                'id' => $user['id'],
                'username' => $user['username'],
                'nickname' => $user['nickname'],
                'email' => $user['email'],
                'face_url' => $user['face_url'],
                'group' => $user['group']
            ];
            Session::set('user',$userArray);
            $getSession = Session::get('user');
            if ($getSession){
                return $this->redirect('/admin');
            }else{
                return $this->tips('登入失败,账号或密码错误,请检查!','error');
            }
        }else{
            return $this->tips('登入失败,账号或密码错误,请检查!','error');
        }
    }

    public function senCode(){
        $data = input('post.');
        $email = htmlspecialchars($data['email']);
        $salt = config('user.salt');
        $user = UserModel::where('email',$email)->field('id,email')->find();
        if (empty($user['email'])){
            return $this->tips('邮箱地址为空请重试!','error',3);
        }else{
            $SetSafeCode = md5(sha1($user['email']).$salt.time());
            $safeCode = SafecodeModel::where('user_id',$user['id'])->value('safe_code');
            if ($safeCode == null){
                SafecodeModel::create([
                    'user_id' => $user['id'],
                    'safe_code' => $SetSafeCode
                ]);
                return $this->sendPassword($SetSafeCode,$email);
            }else{
                return $this->sendPassword($safeCode,$email);
            }
        }
    }

    public function sendPassword($safeCode,$email){
        $blogInfo = SiteModel::where('type','site_setting')->value('value');
        $blogUrl = json_decode($blogInfo,true);
        $this->assign([
            'title' => '发送重置密码链接'
        ]);
        if ($safeCode){
            $content = '<a href="'.$blogUrl['site_url'].'/admin/login/setpassword?safe_code='.$safeCode.'&email='.$email.'">点击重置密码</a>';
            $sendEmail = new Mailhelper();
            $sendEmail->sendMail($email,'找回密码，系统邮件请勿直接回复',$content);
            return $this->tips('安全码已经发送至'.$email.'请注意查收!','success',5,'/admin/login');
        }else{
            return $this->tips('安全码发送至'.$email.'失败,请重试,或者检查邮箱是否正确!','error',5,'/admin/login');
        }
    }

    public function update(){
        $data = input('post.');
        $user = [
            'safeCode' => htmlspecialchars($data['safe']),
            'email' => htmlspecialchars($data['email']),
            'password' => htmlspecialchars($data['password']),
            'repassword' => htmlspecialchars($data['repassword'])
        ];
        if (empty($user['password']) && empty($user['repassword'])){
            return $this->tips('密码为空请重试!','error',3);
        }
        if ($user['password'] != $user['repassword']){
            return $this->tips('两次输入的密码不一致!','error',3,'/admin/login');
        }
        $userId = SafecodeModel::where('safe_code',$user['safeCode'])->value('user_id');
        $salt = config('user.salt');
        $rePassword = md5(sha1($data['password']) . $user['email'] . $salt);
        $result = UserModel::where('id',$userId)->update([
            'password' => $rePassword
        ]);
        if ($result){
            return $this->tips('密码重置成功!','success',3,'/admin/login');
        }else{
            return $this->tips('密码重置失败!','error',3,'/admin/login');
        }
    }

    public function logOut(){
        Session::clear();
        return $this->tips('退出成功!','success','1','/');
    }

    public function tips($msg,$type,$time=3,$url=null){
        $this->assign([
            'title' => '提示信息!',
            'msg' => $msg,
            'time' => $time,
            'url' => $url,
            'type' => $type
        ]);
        if ($type == 'error'){
            return $this->view->fetch('/error');
        }
        else{
            return $this->view->fetch('/success');
        }
    }


    public function setPassword(){
        $this->assign([
            'title' => '重置用户密码'
        ]);
        return $this->view->fetch('/login/setpassword');
    }

    public function retrievePass(){
        $this->assign([
            'title' => '重置密码'
        ]);
        return $this->view->fetch('/login/retrieve-pass');
    }

    public function errorTip($msg){
        return $msg;
    }

    public function successTip($msg){
        return $msg;
    }
}