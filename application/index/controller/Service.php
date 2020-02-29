<?php

namespace app\index\controller;
use app\common\controller\Frontend;

class Service extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function phone() {
        $phoneModel = model('Phone');
        $phone = $phoneModel->getAllPhone();
        $this->view->assign('phone', $phone);
        $this->view->assign('title', '常用电话');
        return $this->view->fetch();
    }

    public function trafic() {
        $this->view->assign('title', '出行交通');
        return $this->view->fetch();
    }

    public function other() {
        $this->view->assign('title', '相关业务');
        return $this->view->fetch();
    }
}
