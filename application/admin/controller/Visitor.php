<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/25
 * Time: 14:50
 */

namespace app\admin\controller;
use app\common\model\Visitor as VisitorModel;

class Visitor extends Base
{
    public function index($page=1){
        $path = url('/admin/visitor/');
        $visitorData = VisitorModel::order('id','desc')
            ->paginate(50,true, [
                'page'     => $page,
                'path'     => $path.'[PAGE]'
            ]);
        $page = $visitorData->render();
        $this->assign([
            'title' => '访客统计',
            'nav_cur' => 'visitor',
            'visitorData' => $visitorData,
            'page' => $page,
        ]);
        return $this->fetch('/visitor');
    }
}