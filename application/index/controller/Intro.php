<?php

namespace app\index\controller;
use app\common\controller\Frontend;

class Intro extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function intro() {
        $this->view->assign('title', '概述');
        return $this->view->fetch();
    }

    public function history() {
        $this->view->assign('title', '历史渊源');
        return $this->view->fetch();
    }
}
