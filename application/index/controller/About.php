<?php

namespace app\index\controller;
use app\common\controller\Frontend;

class About extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function contact() {
        $this->view->assign('title', '联系我们');
        return $this->view->fetch();
    }

    public function copyright() {
        $this->view->assign('title', '版权说明');
        return $this->view->fetch();
    }

    // 增加留言
    public function getContent() {
        $param = $this->request->param();
        if (empty($param['name']) || empty($param['email']) || empty($param['content'])) {
            return 'error';
        } 
        $param['uploadtime'] = date('Y-m-d H:i:s');
        $contactModel = model('Contact');
        $flag = $contactModel->addContent($param);
        return $flag;
    }
}
