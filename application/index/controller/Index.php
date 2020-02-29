<?php

namespace app\index\controller;
use app\common\controller\Frontend;

class Index extends Frontend
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
        $this->view->assign('scenic', $scenic);
        $this->view->assign('title', __('首页'));
        return $this->view->fetch();
    }
}
