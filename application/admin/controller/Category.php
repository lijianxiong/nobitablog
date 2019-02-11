<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/21
 * Time: 17:57
 */

namespace app\admin\controller;
use think\Request;
use app\common\model\Category as CategoryModel;
use app\common\model\Article as ArticleModel;

class Category extends Base
{
    public function index(){
        $result = CategoryModel::where('user_id',$this->userId())
            ->where('del',0)
            ->select();
        $this->assign([
            'title' => '创作分类',
            'nav_cur' => 'category',
            'category' => $result
        ]);
        return $this->fetch('/category');
    }

    public function show($id){
        $page = input('get.page');
        $path = url('/admin/category/show/'.$id.'?page=');
        $articleData = ArticleModel::where('user_id',$this->userId())
            ->where('category_id',$id)
            ->where('del',NULL)
            ->order('create_time','desc')
            ->paginate(21,true, [
                'page'     => $page,
                'path'     => $path.'[PAGE]'
            ]);
        $page = $articleData->render();
        $userCategory = $this->userCategory();
        $userCategoryTree = $this->categoryTree($userCategory);
        $category = $this->getCategory($userCategoryTree);
        $this->assign([
            'title' => '创作中心',
            'nav_cur' => 'article',
            'article' => $articleData,
            'category' => $category['item'],
            'categoryList' => $category['list'],
            'page' => $page
        ]);
        return $this->fetch('/center');
    }

    public function edit(){
        $data = input('post.');
        $id = htmlspecialchars($data['id']);
        $links = CategoryModel::where('id',$id)
            ->where('user_id',$this->userId())
            ->find();
        return $links;
    }

    public function update(Request $request){
        $data   = input('post.');
        //print_r($data);exit;
        $id     = $data['id'];
        $result = $this->validate($data,'Category');
        if (true !== $result){
            $this->error('提交失败');
            return false;
        }
        if ($request->file('file') == NULL){
            $data = [
                'title' => $data['title'],
                'slug' => $data['slug'],
                'user_id' => $this->userId(),
                'thumb' => $data['thumb']
            ];
            if($id == 0){
                $result = CategoryModel::create($data);
            }else{
                $data['id'] = $id;
                $result = CategoryModel::update($data);
            }
            if(!$result){
                $this->error('提交失败');
                return false;
            }else{
                return $this->redirect('/admin/category');
            }
        }else{
            $file = \think\Image::open(request()->file('file'));
            $dirTime = iconv("UTF-8", "GBK", ROOT_PATH . 'public' . DS . 'upload/category/'.date('Ym',time()));
            if (file_exists($dirTime));
            else
                mkdir ($dirTime,0777,true);
            $fileUrl = $dirTime. DS .md5(time()).'.jpg';
            $info = $file->thumb(500, 500)->save($fileUrl);
            if ($info) {
                $categoryUrl = strstr($fileUrl,"/upload");
                $data = [
                    'title' => $data['title'],
                    'slug' => $data['slug'],
                    'user_id' => $this->userId(),
                    'thumb' => $categoryUrl
                ];
                if($id == 0){
                    $result = CategoryModel::create($data);
                }else{
                    $data['id'] = $id;
                    $result = CategoryModel::update($data);
                }
                if(!$result){
                    $this->error('提交失败');
                    return false;
                }
                return $this->redirect('/admin/category');
            } else {
                // 上传失败获取错误信息
                $this->error($file->getError());
            }
        }
    }

    public function del(){
        $data = input('post.');
        $id = htmlspecialchars($data['id']);
        $result = CategoryModel::where('user_id',$this->userId())->delete($id);
        if ($result){
            $msg = [
                'status' => 10001,
                'msg' => '分类删除成功!'
            ];
        }else{
            $msg = [
                'status' => 10002,
                'msg' => '分类删除失败!'
            ];
        }
        return $msg;
    }
}