<?php

namespace app\index\controller;
use app\common\controller\Frontend;

class Message extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    // 增加评论
    public function getMessage() {
        $param = $this->request->param();
        $param['posttime'] = date('Y-m-d H:i:s');
        $messageModel = model('Message');
        $flag = $messageModel->addMessage($param);
        return $flag;
    }

    // 根据ID删除评论
    public function deleteMessage() {
        $id = input('id');
        $messageModel = model('Message');
        $flag = $messageModel->deleteMessageById($id);
        return $flag;
    }
}
