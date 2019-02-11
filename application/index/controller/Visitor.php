<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 11/27
 * Time: 15:54
 */

namespace app\index\controller;
use app\common\model\Visitor as VisitorModel;
use app\common\model\Article as ArticleModel;
use app\common\model\Page as PageModel;
use app\common\model\User as UserModel;
use app\common\model\Additional as AdditionalModel;
use think\Controller;
use qq_connect\Oauth;
use Redis;
use think\Db;
use think\Session;

class Visitor extends Controller
{
    public function index(){
        $data = input('get.');
        $data['ip'] = request()->ip();
        $data['browser'] = $this->getBrowser();
        $data['os'] = $this->getOs();
        $data['lang'] = $this->getLang();
        $data['create_time'] = time();
//        $result = VisitorModel::create([
//            'value' => json_encode($data)
//        ]);
        $value = json_encode($data);
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        //$redis->del('visitor');
//        $res = $redis->blPop('visitor', 10);
//
//        print_r($res);exit;

        $redis->lpush('visitor', $value);
        $res = $redis->lrange('visitor', 0, -1);
        sort($res);
        $length = $redis->lsize('visitor');
        if ($length>100){
            foreach ($res as $item){
                VisitorModel::create([
                    'value' => $item
                ]);
            }
            $redis->del('visitor');
        }
        if ($value){
            //$redis->del('article');exit;
            $num = $redis->get('vis');
            if (empty($num)){
                $article = AdditionalModel::sum('views');
                $visitor = VisitorModel::count('id');
                $pageNum = PageModel::sum('views');
                $num = $article + $visitor + $pageNum;
                $redis->set('vis',$num,10800);
            }
            return $num;
        }else{
            return '记录失败!';
        }
    }

    ////获得访客浏览器类型
    function getBrowser(){
        $sys = $_SERVER['HTTP_USER_AGENT'];  //获取用户代理字符串
        if (stripos($sys, "Firefox/") > 0) {
            preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
            $exp[0] = "Firefox";
            $exp[1] = $b[1];  //获取火狐浏览器的版本号
        } elseif (stripos($sys, "Maxthon") > 0) {
            preg_match("/Maxthon\/([\d\.]+)/", $sys, $aoyou);
            $exp[0] = "傲游";
            $exp[1] = $aoyou[1];
        } elseif (stripos($sys, "MSIE") > 0) {
            preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
            $exp[0] = "IE";
            $exp[1] = $ie[1];  //获取IE的版本号
        } elseif (stripos($sys, "OPR") > 0) {
            preg_match("/OPR\/([\d\.]+)/", $sys, $opera);
            $exp[0] = "Opera";
            $exp[1] = $opera[1];
        } elseif(stripos($sys, "Edge") > 0) {
            //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配
            preg_match("/Edge\/([\d\.]+)/", $sys, $Edge);
            $exp[0] = "Edge";
            $exp[1] = $Edge[1];
        } elseif (stripos($sys, "Chrome") > 0) {
            preg_match("/Chrome\/([\d\.]+)/", $sys, $google);
            $exp[0] = "Chrome";
            $exp[1] = $google[1];  //获取google chrome的版本号
        } elseif(stripos($sys,'rv:')>0 && stripos($sys,'Gecko')>0){
            preg_match("/rv:([\d\.]+)/", $sys, $IE);
            $exp[0] = "IE";
            $exp[1] = $IE[1];
        }else {
            $exp[0] = "未知浏览器";
            $exp[1] = "";
        }
        return $exp[0].'('.$exp[1].')';
    }

    ////获得访客浏览器语言
    function getLang(){
        if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
            $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
            $lang = substr($lang,0,5);
            if(preg_match("/zh-cn/i",$lang)){
                $lang = "简体中文";
            }
            elseif(preg_match("/zh/i",$lang)){
                $lang = "繁体中文";
            }
            else{
                $lang = "English";
            }
            return $lang;
        }
        else{
            return "unknow";
        }
    }

    ////获取访客操作系统
    function getOs(){
        if(!empty($_SERVER['HTTP_USER_AGENT'])){
            $OS = $_SERVER['HTTP_USER_AGENT'];
            if (preg_match('/win/i',$OS)) {
                $OS = 'Windows';
            }
            elseif (preg_match('/mac/i',$OS)) {
                $OS = 'MAC';
            }
            elseif (preg_match('/linux/i',$OS)) {
                $OS = 'Linux';
            }
            elseif (preg_match('/unix/i',$OS)) {
                $OS = 'Unix';
            }
            elseif (preg_match('/bsd/i',$OS)) {
                $OS = 'BSD';
            }
            else {
                $OS = 'Other';
            }
            return $OS;
        }
        else{
            return "unknow";
        }
    }

    public function views(){
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $res = $redis->lrange('visitor', 0, -1);
        foreach ($res as $item){
            echo $item.'<br>';
        }
    }

    //唤起qq登录
    public function login(){
        $oauth = new Oauth();
        $oauth->qq_login();
    }

    //qq回调函数
    public function qqCallback(){
        //请求accesstoken
        $oauth = new \qq_connect\Oauth();
        $accesstoken = $oauth->qq_callback();
        //获取open_id
        $openid = $oauth->get_openid();
        //根据accesstoken和open_id获取用户的基本信息
        $qc = new \qq_connect\QC($accesstoken,$openid);
        $userinfo = $qc->get_user_info();
        //print_r($userinfo);exit;
        $userFaceUrl = $userinfo['figureurl_qq_2'];
        $userNickname = $userinfo['nickname'];

        //设置有效时长(7天)
        //cookie('accesstoken', $accesstoken, 24*60*60*7);
        //cookie('openid', $openid, 24*60*60*7);
        $user = Db::name('user')->where('openid',$openid)->find();
        if ($user){
            $userArray = [
                'id' => $user['id'],
                'username' => $user['username'],
                'nickname' => $user['nickname'],
                'email' => $user['email'],
                'face_url' => $user['face_url'],
                'url' => $user['url'],
                'group' => $user['group']
            ];
            Session::set('user',$userArray);
            $url = Session::get('callBackUrl');
            $this->redirect($url);
        }else{
            $result = UserModel::create([
                'nickname' => $userNickname,
                'openid' => htmlspecialchars($openid),
                'face_url' => 'https'.substr($userFaceUrl,4),
                'create_time' => time(),
                'update_time' => time(),
                'group' => 3
            ]);
            if($result){
                $user = Db::name('user')->where('openid',$openid)->find();
                $userArray = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'nickname' => $user['nickname'],
                    'email' => $user['email'],
                    'face_url' => $user['face_url'],
                    'group' => $user['group']
                ];
                Session::set('user',$userArray);
                $this->redirect('/profile/edit');
            }else{
                $this->redirect('/login');
            }
        };exit;
    }

    public function callBackUrl(){
        $data = input('post.');
        Session::set('callBackUrl',$data['url']);
        $msg = [
            'status' => 1001,
            'msg' => '回调地址写入成功!'
        ];
        return $msg;
    }
}