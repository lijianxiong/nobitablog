<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/25
 * Time: 17:15
 */

namespace app\index\controller;

use app\common\model\Site as SiteModel;
use app\common\model\User as UserModel;
use think\Controller;
use think\View;
use Parsedown;
use think\Session;
use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;

class Base extends Controller
{
    public $_N;

    public function _initialize()
    {
        parent::_initialize();
        error_reporting(0);
        $this->view = new View([
            'type' => 'php',
            'view_path' => './theme/nobita/',
            'view_suffix' => 'php',
            'view_depr' => '/',
        ]);
        if (!defined('__THEME__')) {
            define('__THEME__', './theme/nobita');
            define('__PUBLIC__', '/theme/nobita');
        }
        $this->_N['site'] = json_decode(SiteModel::where('type', 'site_setting')->value('value'), true);
        $userSession = Session::get('user');
        //print_r($userSession);exit;
        $this->_N['session'] = $userSession;
        //print_r($this->_N['session']);exit;
        $this->assign([
            '_N' => $this->_N,
            'title' => '首页'
        ]);
    }

    public function listFormatConversion($listItem)
    {
        $pattern = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.BMP|\.JPG|\.PNG]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern, $listItem['content'], $matches);
        //添加描述
        $listItemDescription = str_replace("\n", "", mb_substr(strip_tags($listItem['content']), 0, 100, 'utf-8') . '...');
        if ($listItemDescription == '...') {
            $listItemDescription = '';
        }
        $listItemThumbnail = empty($matches[1][0]) ? '' : $this->listItemThumbnail($matches[1][0],800,800);
        $processingData = [
            'id' => $listItem['id'],
            'title' => $listItem['title'],
            'thumbnail' => $listItem['thumb'] ? $listItem['thumb'] : $listItemThumbnail,
            'create_time' => $listItem['create_time'],
            'description' => $listItem['description'] ? $listItem['description'] : $listItemDescription,
        ];
        return $processingData;
    }

//    public function listItemThumbnail($filename)
//    {
//        $dir = trim(strrchr($filename, '/'), '/');
//        return 'https://199508.com/thumbnail/' . $dir;
//    }

    public function listItemThumbnail($fileNames,$width,$height)
    {
        $dir = trim(strrchr($fileNames, '/'), '/');
        $haveFilename = './thumbnail/' . $dir;
        if (file_exists($haveFilename)) {
            return '/thumbnail/' . $dir;
        }
        if ($dir){
            $fileNames = substr($fileNames, strlen($this->_N['site']['site_url']));
            if(preg_match('/[\x7f-\xff]/', $fileNames)){
                return $fileNames;
            }else{
                $image = \think\Image::open('./' . $fileNames);
                $image->thumb($width, $height)->save('./thumbnail/' . $dir);
            }
            return '/thumbnail/'.$dir;
        }
        return '/thumbnail/'.$dir;
    }

    public function sendMail($to = [], $subject = '', $content = '')
    {
        $config = config('email');
        $mail = new Message();
        if (empty($config['host']) || empty($config['username']) || empty($config['password'])) {
            return false;
        }
        if (is_array($to)) {
            foreach ($to as $v) {
                $mail->addTo($v);
            }
        } else {
            $mail->addTo($to);
        }
        $mail->setFrom($config['username'], $config['nickname']);
        $mail->setSubject($subject);
        $mail->setHTMLBody($content);
        $mailer = new SmtpMailer($config);
        return $mailer->send($mail);
    }

    public function mailTemplate($commentInertData,$type)
    {
        if ($type == 'article') {
            $commentInertData['url'] = 'post';
        }
        if ($type == 'd') {
            $commentInertData['url'] = 'dynamicpost';
        }
        return [
            'newEmail' => '<meta charset="UTF-8"><div class="mail_body" style=" font-family: microsoft yahei; color: #444; font-size: 16px; font-weight: 400; line-height: 1.88; padding-top: 4rem; margin-bottom: 1rem; max-width: 500px; margin: auto; text-align: center;"><div class="blog_face"><img src="https://199508.com/theme/nobita/images/face.jpg" alt="" style=" border-radius: 100em; -webkit-box-shadow: 0px 14px 30px -15px rgba(0,0,0,0.75); -moz-box-shadow: 0px 14px 30px -15px rgba(0,0,0,0.75); -ms-box-shadow: 0px 14px 30px -15px rgba(0,0,0,0.75); -o-box-shadow: 0px 14px 30px -15px rgba(0,0,0,0.75); box-shadow: 0px 14px 30px -15px rgba(0,0,0,0.75);width: 100px;"></div><div class="dear_name" style=" font-size: 20px; font-weight: 700;"><p>' . $this->_N['site']['title'] . '，你好。</p></div><div class="mail_title" style=" font-size: 14px;"><b>“<a href="' . $this->_N['site']['site_url'] . $commentInertData['url'].'/' . $commentInertData['value'] . '" style="color: #444;text-decoration: none;">' . $commentInertData['title'] . '</a>”</b>有新的评论：<br>' . $commentInertData['author'] . '：' . $commentInertData['content'] . '</div><div class="mail_href" style=" margin-top: 30px;"><a href="' . $this->_N['site']['site_url'] . $commentInertData['url'].'/' . $commentInertData['value'] . '" style=" color: #ffffff; text-decoration: none; display: inline-block; min-height: 26px; line-height: 27px; padding-top: 0; padding-right: 40px; padding-bottom: 0; padding-left: 40px; outline: 0; background: #3eae5f; font-size: 14px; text-align: center; font-style: normal; font-weight: 400; border: 0; vertical-align: bottom; white-space: nowrap; border-radius: 999em;">去看看</a></div><div style=" color: #b3b3b1; font-size: 12px; text-align: center; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0; margin-top: 25px; margin-right: 0; margin-left: 0; font-weight: 100;">本邮件由<a href="https://199508.com" style=" text-decoration: none; color: #b3b3b1;">大雄的邮递员</a>自动生成，<span style="color:#3eae5f">请勿回复</span>。</div></div>',
            'replyEmail' => '<div class="mail_body" style=" font-family: microsoft yahei; color: #444; font-size: 16px; font-weight: 400; line-height: 1.88; padding-top: 4rem; margin-bottom: 1rem; max-width: 500px; margin: auto; text-align: center;"><div class="blog_face"><img src="https://199508.com/theme/nobita/images/face.jpg" alt="" style=" border-radius: 100em; -webkit-box-shadow: 0px 14px 30px -15px rgba(0,0,0,0.75); -moz-box-shadow: 0px 14px 30px -15px rgba(0,0,0,0.75); -ms-box-shadow: 0px 14px 30px -15px rgba(0,0,0,0.75); -o-box-shadow: 0px 14px 30px -15px rgba(0,0,0,0.75); box-shadow: 0px 14px 30px -15px rgba(0,0,0,0.75);width: 100px;"></div><div class="dear_name" style=" font-size: 20px; font-weight: 700;"><p>' . $commentInertData['parent_author'] . '，你好。</p></div><div class="mail_title" style=" font-size: 14px;">您在<b>"<a href="' . $this->_N['site']['site_url'] . '/post/' . $commentInertData['value'] . '" style="color: #444;text-decoration: none;">' . $commentInertData['title'] . '</a>"</b>下的回复：<br>' . $commentInertData['parent_content'] . '</div><div class="mail_report" style=" border-top: 1px solid #eee; margin-top: 20px; padding-top: 20px;"><b style=" font-weight: 700; font-size: 21px;">' . $commentInertData['author'] . '</b>：对您回复</div><div class="mail_report_content">' . $commentInertData['content'] . '</div><div class="mail_href" style=" margin-top: 30px;"><a href="' . $this->_N['site']['site_url'] . $commentInertData['url'].'/' . $commentInertData['value'] . '" style=" color: #ffffff; text-decoration: none; display: inline-block; min-height: 26px; line-height: 27px; padding-top: 0; padding-right: 40px; padding-bottom: 0; padding-left: 40px; outline: 0; background: #3eae5f; font-size: 14px; text-align: center; font-style: normal; font-weight: 400; border: 0; vertical-align: bottom; white-space: nowrap; border-radius: 999em;">去看看</a></div><div style=" color: #b3b3b1; font-size: 12px; text-align: center; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0; margin-top: 25px; margin-right: 0; margin-left: 0; font-weight: 100;">本邮件由<a href="https://199508.com" style=" text-decoration: none; color: #b3b3b1;">大雄的邮递员</a>自动生成，<span style="color:#3eae5f">请勿回复</span>。</div></div>'];
    }

    function getGravatar($email)
    {
        /**
         * 修改这个函数 收到$email 先md5，检测本地是否存在缓存过的文件，如果存在 直接返回本地的地址
         * 如果不存在 file_get_contens得到图片资源后，file_put_contents缓存下来，然后还是返回本地的地址
         */
        $id = md5(strtolower(trim($email)));
        $filePath = './avatar/';
        $fileName = $filePath . $id . '.jpg';
        if (!is_file($fileName)) {
            //缓存不存在
            if (!is_dir($filePath)) {
                mkdir($filePath);
            }
            $url = 'http://secure.gravatar.com/avatar/' . $id;
            $res = file_get_contents($url);
            if (!file_put_contents($fileName, $res)) {
                return '//secure.gravatar.com/avatar/' . $id;
            }
        }
        return '/avatar/' . $id . '.jpg?6';
    }

    public function thumb($filename, $width, $height)
    {
        $dir = trim(strrchr($filename, '/'), '/');
        $haveFilename = './thumbnail/' . $dir;
        if (file_exists($haveFilename)) {
            return '/thumbnail/' . $dir;
        }
        if ($dir) {
            $filenames = substr($filename, $this->_K['setting']['siteurlnum']);
            if (preg_match('/[\x7f-\xff]/', $filenames)) {
                return $filenames;
            } else {
                $image = \think\Image::open('.' . $filenames);
                $image->thumb($width, $height)->save('./thumbnail/' . $dir);
            }
            return '/thumbnail/' . $dir;
        }
        return '/thumbnail/' . $dir;
    }

    public function numFormat($num)
    {
        if ($num >= 10000) {
            $num = round($num / 10000 * 100) / 100 . ' W';
        } elseif ($num >= 1000) {
            $num = round($num / 1000 * 100) / 100 . ' K';
        } else {
            $num = $num;
        }
        return $num;
    }

    public function userId()
    {
        $userId = $this->_N['session']['id'];
        return $userId;
    }

    public function articleFormatConversion($articleData)
    {
        $markDown = new Parsedown();
        $article = [
            'article' => [
                'id' => $articleData['id'],
                'user_id' => $articleData['user_id'],
                'title' => $articleData['title'],
                'views' => $this->numFormat($articleData['views']),
                'type' => 'article',
                'create_time' => $articleData['create_time'],
                'content' => $markDown->text($articleData['content']),
            ],
            'comment' => $this->getCommentList($articleData['comment'])
        ];
        return $article;
    }

    public function getCommentList($commentData, $parentId = 0)
    {
        $commentList = [];
        foreach ($commentData as $commentItem) {
            if ($commentItem['parent_id'] == $parentId) {
                //$commentItem['email'] = $commentItem['email']?$this->getGravatar($commentItem['email']):$this->getFaceUrl($commentItem['author_id']);
                $commentItem['email'] = $this->getFaceUrl($commentItem['author_id'])?$this->getFaceUrl($commentItem['author_id']):$this->getGravatar($commentItem['email']);
                $commentItem['reply'] = $this->getChildrenComment($commentData, $commentItem['id'], $commentItem['author']);
                if (empty($commentItem['reply'])) {
                    unset($commentItem['reply']);
                }
                unset($commentItem['ip'], $commentItem['user_agent']);
                $commentList[] = $commentItem;
            }
        }
        return $commentList;
    }

    public function getChildrenComment($commentData, $parentId = 0, $parentAuthor)
    {
        $commentChildrenList = [];
        foreach ($commentData as $commentItem) {
            if ($commentItem['parent_id'] == $parentId) {
                $commentItem['parent_author'] = $parentAuthor;
                $commentItem['email'] = $commentItem['email']?$this->getGravatar($commentItem['email']):$this->getFaceUrl($commentItem['author_id']);
                unset($commentItem['ip'], $commentItem['user_agent']);
                $commentChildrenList[] = $commentItem;
                $commentChildrenList = array_merge($commentChildrenList, self::getChildrenComment($commentData, $commentItem['id'], $commentItem['author']));
            }
        }
        return $commentChildrenList;
    }

    public function getFaceUrl($authorId){
        $faceUrl = UserModel::where('id',$authorId)->value('face_url');
        return $faceUrl;
    }

}