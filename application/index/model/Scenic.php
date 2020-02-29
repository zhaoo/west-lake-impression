<?php

namespace app\index\model;
use think\Model;

class Scenic extends Model
{
    // 表名
    protected $name = 'scenic';

    // 查询所有景点
    public function getAllScenic() {
		  $scenic = $this->select();
    return $scenic;
    }
    
    // 通过景区ID查询景点
    public function getScenicById($id) {
      $scenic = $this->where('id',$id)->find();
      return $scenic;
    }
}
