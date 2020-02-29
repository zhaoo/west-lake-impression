<?php

namespace app\index\controller;
use app\common\controller\Frontend;
use think\Config;

class Food extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function index() {
        $id = input('id');
        $foodModel = model('Food');
        $food = $foodModel->getFoodById($id);
        $image = explode(',',$food['images']);
        $messageModel = model('Message');
        $message = $messageModel->getMessageByFid($id, 'food');
        $food['message_count'] = count($message);
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
        $this->view->assign('food', $food);
        $this->view->assign('image', $image);
        $this->view->assign('message', $message);
        $this->view->assign('foodId', $id);
        $this->view->assign('title', $food['name']);
        return $this->view->fetch();
    }

    public function list() {
        $foodModel = model('Food');
        $food = $foodModel->getAllFood();
        $this->view->assign('food', $food);
        $this->view->assign('title', '美食');
        return $this->view->fetch();
    }
}
