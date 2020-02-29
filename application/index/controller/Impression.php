<?php

namespace app\index\controller;
use app\common\controller\Frontend;

class Impression extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function vr() {
        $this->view->assign('title', '全景');
        return $this->view->fetch();
    }

    public function video() {
        $videoModel = model('Video');
        $video = $videoModel->getAllVideo();
        $this->view->assign('video', $video);
        $this->view->assign('title', '宣传视频');
        return $this->view->fetch();
    }
}
