<?php

namespace app\index\model;
use think\Model;

class News extends Model
{
    // 表名
    protected $name = 'news';

    // 查询新闻列表
    public function getNewsList() {
		  $news = $this->paginate(5);
    return $news;
    }

    // 通过ID查询景点
    public function getNewsListById($id) {
      $news = $this->where('scenic_id',$id)->paginate(5);
      return $news;
    }

    // 查询所有新闻
    public function getAllNews() {
		  $news = $this->select();
    return $news;
    }
    
    // 通过ID查询新闻
    public function getNewsById($id) {
      $news = $this->where('scenic_id',$id)->select();
      return $news;
    }

    // 通过ID查询景点限制数量
    public function getSomeNewsById($id, $num) {
      $news = $this->where('scenic_id',$id)->order('posttime desc')->limit($num)->select();
      return $news;
    }

    // 通过ID查询单个景点
    public function getNewById($id) {
      $new = $this->where('id',$id)->find();
      return $new;
    }
}
