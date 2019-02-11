<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/6
 * Time: 14:29
 */
namespace app\admin\controller;

use app\common\model\Article as ArticleModel;
use app\common\model\Center as CenterModel;
use app\common\model\Visitor as VisitorModel;
use app\common\model\Comment as CommentModel;
use app\common\model\Additional as AdditionalModel;
use think\Db;

use think\Session;

class Index extends Base
{
    public function index(){
        $centerSum = [
            'visitor' => VisitorModel::count(),
            'article_sum' => ArticleModel::where('user_id',$this->userId())->count(),
            'comment_sum' => AdditionalModel::where('user_id',$this->userId())->sum('comment'),
            'article_like' => AdditionalModel::where('user_id',$this->userId())->sum('agree')
        ];
        $insertData = [
            'user_id' => $this->userId(),
            'type' => 'statistical',
            'content' => json_encode($centerSum)
        ];
        $statistical = CenterModel::where('user_id',$this->userId())->where('type','statistical')->value('content');
        if (!$statistical){
            CenterModel::create($insertData);
        }
        $statistical = CenterModel::where('user_id',$this->userId())->where('type','statistical')->value('content');
        $this->assign([
            'title' => '仪表盘',
            'statistical' => json_decode($statistical,true)
        ]);
        $group = Session::get('user.group');
        if ($group == 1){
            return $this->view->fetch('/index');
        }else{
            return '没有后台权限!';
        }

    }
}