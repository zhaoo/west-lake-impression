<?php

namespace app\index\controller;
use app\common\controller\Frontend;

class Photo extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function index() {
        $scenicModel = model('Scenic');
        $scenic = $scenicModel->getAllScenic();
        $photoModel = model('Photo');
        $photo = $photoModel->getAllPhoto();
        $userModel = model('User');
        for ($i=0; $i<count($photo); $i++) {
            $user = $userModel->getUserById($photo[$i]['user_id']);
            $photo[$i]['nickname'] = $user['nickname'];
        }
        $this->view->assign('scenic', $scenic);
        $this->view->assign('photo', $photo);
        $this->view->assign('title', __('影集'));
        return $this->view->fetch();
    }

    // 上传照片
    public function upload() {
        $param = $this->request->param();
        $param['uploadtime'] = date("Y-m-d");
        $photoModel = model('Photo');
        $photoModel->addPhoto($param);
    }

    // 根据ID删除照片
    public function deletePhoto() {
        $id = input('id');
        $photoModel = model('Photo');
        $flag = $photoModel->deletePhotoById($id);
        return $flag;
    }
}
