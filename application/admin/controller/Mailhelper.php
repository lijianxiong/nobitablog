<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/6
 * Time: 17:20
 */
namespace app\admin\controller;
use think\Controller;
use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;
class Mailhelper extends Controller
{
    public function sendMail($to=[],$subject='',$content=''){
        $config = config('email');
        $mail = new Message();
        if(empty($config['host']) || empty($config['username']) || empty($config['password'])){
            return false;
        }
        if (is_array($to)){
            foreach ($to as $v) {
                $mail->addTo($v);
            }
        } else {
            $mail->addTo($to);
        }
        $mail->setFrom($config['username'],$config['nickname']);
        $mail->setSubject($subject);
        $mail->setHTMLBody($content);
        $mailer = new SmtpMailer($config);
        return $mailer->send($mail);
    }
}