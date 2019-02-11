<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/28
 * Time: 9:41
 */

namespace app\index\controller;

use Parsedown;
use app\common\model\Page as PageModel;

class Single extends Base
{
    public function index($slug = '')
    {
        $singleData = PageModel::where('slug', $slug)->find();
        $singleFormat = $this->articleFormatConversion($singleData);
        $singleViews = ++$singleData['views'];
        PageModel::where('slug', $slug)->update([
            'views' => $singleViews
        ]);
        $this->assign([
            'title' => $singleFormat['title'],
            'article' => $singleFormat,
            'userId' => $this->_N['session']['id']
        ]);
        return $this->view->fetch('/single');
    }

    public function articleFormatConversion($articleData)
    {
        $markDown = new Parsedown();
        $article = [
            'id' => $articleData['id'],
            'views' => $this->numFormat($articleData['views']),
            'title' => $articleData['title'],
            'create_time' => $articleData['create_time'],
            'content' => $markDown->text($articleData['content']),
        ];
        return $article;
    }
}