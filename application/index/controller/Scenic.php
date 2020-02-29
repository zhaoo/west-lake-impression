<?php

namespace app\index\controller;
use app\common\controller\Frontend;

class Scenic extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = 'default';

    public function _initialize() {
        parent::_initialize();
    }

    public function index() {
        $id = input('id');
        $scenicModel = model('Scenic');
        $scenic = $scenicModel->getScenicById($id);
        $newsModel = model('News');
        $news = $newsModel->getSomeNewsById($id, 5);
        $albumModel = model('Album');
        $album = $albumModel->getAlbumById($id);
        $this->view->assign('scenic', $scenic);
        $this->view->assign('news', $news);
        $this->view->assign('album', $album);
        $this->view->assign('title', $scenic['name']);
        return $this->view->fetch();
    }

    public function list() {
        $scenicModel = model('Scenic');
        $scenic = $scenicModel->getAllScenic();
        $this->view->assign('scenic', $scenic);
        $this->view->assign('title', '景区');
        return $this->view->fetch();
    }
}
