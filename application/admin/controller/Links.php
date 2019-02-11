<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/21
 * Time: 18:08
 */

namespace app\admin\controller;
use app\common\model\Link as LinkModel;

class Links extends Base
{
    public function index(){
        $result = LinkModel::all(function($query){
            $query->order('weight','asc');
        });
        $links = [];
        foreach ($result as $item){
            $links[] = $this->trans($item);
        }
        $this->assign([
            'title' => '友情链接',
            'nav_cur' => 'links',
            'links' => $links,
            'avatar' => 'getGravatar',
        ]);
        return $this->fetch('/links');
    }

    public function trans($data){
        $result = [];
        for ($i=0;$i<count($data);$i++){
            $result['id'] = $data['id'];
            $result['title'] = $data['title'];
            $result['email'] = $this->getGravatar($data['email']);
            $result['url'] = $data['url'];
            $result['description'] = $data['description'];
            $result['weight'] = $data['weight'];
        }
        return $result;
    }

    public function update(){
        $data   = input('post.');
        $id     = $data['id'];
        $result = $this->validate($data,'Link');
        if (true !== $result) {
            $this->error('提交失败');
            return false;
        }
        $data = [
            'title' => $data['title'],
            'url' => $data['url'],
            'description' => $data['description'],
            'weight' => $data['weight']?$data['weight']:0,
            'email' => $data['email']
        ];
        if($id == 0){
            $result = LinkModel::create($data);
        }else{
            $data['id'] = $id;
            $result = LinkModel::update($data);
        }
        if(!$result){
            $this->error('提交失败');
            return false;
        }
        $this->redirect('/admin/links');
        return true;
    }

    public function edit(){
        $data = input('post.');
        $id = htmlspecialchars($data['id']);
        $links = LinkModel::where('id',$id)->find();
        return $links;
    }

    public function del(){
        $data = input('post.');
        $id = htmlspecialchars($data['id']);
        $result = LinkModel::destroy($id);
        if ($result){
            $msg = [
                'status' => 10001,
                'msg' => '友链删除成功'
            ];
            return json_encode($msg);
        }else{
            $msg = [
                'status' => 10002,
                'msg' => '友链删除失败'
            ];
            return json_encode($msg);
        }
    }


}