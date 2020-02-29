<?php

namespace app\index\controller;
use app\common\controller\Frontend;
use think\Config;

class Culture extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function index() {
        $id = input('id');
        $cultureModel = model('Culture');
        $culture = $cultureModel->getCultureById($id);
        $this->view->assign('culture', $culture);
        $this->view->assign('title', $culture['title']);
        return $this->view->fetch();
    }

    public function list() {
        $cultureModel = model('Culture');
        $culture = $cultureModel->getAllCulture();
        $this->view->assign('culture', $culture);
        $this->view->assign('title', '文化');
        return $this->view->fetch();
    }
}
