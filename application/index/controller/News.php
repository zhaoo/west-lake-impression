<?php

namespace app\index\controller;
use app\common\controller\Frontend;
use think\Config;

class News extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function index() {
        $id = input('id');
        $newsModel = model('News');
        $new = $newsModel->getNewById($id);
        $adminModel = model('Admin');
        $admin = $adminModel->getAdminById($new['admin_id']);
        $new['admin'] = $admin['nickname'];
        $messageModel = model('Message');
        $message = $messageModel->getMessageById($id, 'news');
        $new['message_count'] = count($message);
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
        $this->view->assign('new', $new);
        $this->view->assign('title', $new['title']);
        $this->view->assign('scenicId', $id);
        $this->view->assign('message', $message);
        return $this->view->fetch();
    }

    public function list() {
        $id = input('id');
        $newsModel = model('News');
        if ($id == 'all') {
            $news = $newsModel->getNewsList();
        } else {
            $news = $newsModel->getNewsListById($id);
        }
        $adminModel = model('Admin');
        for($i=0; $i<count($news); $i++) {
            $admin = $adminModel->getAdminById($news[$i]['admin_id']);
            $news[$i]['admin'] = $admin['nickname'];
        }
        $this->view->assign('news', $news);
        $this->view->assign('id', $id);
        $this->view->assign('title', '新闻');
        return $this->view->fetch();
    }
}
