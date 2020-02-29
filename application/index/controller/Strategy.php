<?php

namespace app\index\controller;
use app\common\controller\Frontend;
use think\Config;

class Strategy extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function index() {
        $id = input('id');
        $strategyModel = model('Strategy');
        $strategy = $strategyModel->getStrategyById($id);
        $userModel = model('User');
        $user = $userModel->getUserById($strategy['user_id']);
        $strategy['user'] = $user['nickname'];
        $messageModel = model('Message');
        $message = $messageModel->getMessageById($id, 'strategy');
        $strategy['message_count'] = count($message);
        $userModel = model('User');
        $site = Config::get("site");
        foreach($message as $key=>$vo){
            if ($message[$key]['user_id']) {
                $user = $userModel->getUserById($vo['user_id']);
                $message[$key]['name'] = $user['nickname'];
                $message[$key]['avatar'] = $user['avatar'];
            } else {
                $message[$key]['avatar'] = $site['avatar'];
            }
        }
        $this->view->assign('strategy', $strategy);
        $this->view->assign('title', $strategy['title']);
        $this->view->assign('scenicId', $id);
        $this->view->assign('message', $message);
        return $this->view->fetch();
    }

    public function list() {
        $id = input('id');
        $strategyModel = model('Strategy');
        if ($id == 'all') {
            $strategy = $strategyModel->getStrategyList();
        } else {
            $strategy = $strategyModel->getStrategyListById($id);
        }
        $userModel = model('User');
        for($i=0; $i<count($strategy); $i++) {
            $user = $userModel->getUserById($strategy[$i]['user_id']);
            $strategy[$i]['user'] = $user['nickname'];
        }
        $scenicModel = model('Scenic');
        $scenic = $scenicModel->getAllScenic();
        $this->view->assign('strategy', $strategy);
        $this->view->assign('scenic', $scenic);
        $this->view->assign('id', $id);
        $this->view->assign('title', '攻略');
        return $this->view->fetch();
    }

    // 根据ID删除攻略
    public function deleteStrategy() {
        $id = input('id');
        $strategyModel = model('strategy');
        $flag = $strategyModel->deleteStrategyById($id);
        return $flag;
    }

    // 上传攻略
    public function upload() {
        $param = $this->request->param();
        $param['posttime'] = date("Y-m-d");
        $strategyModel = model('Strategy');
        $strategyModel->addStrategy($param);
    }

}
