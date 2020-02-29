<?php

namespace app\index\model;
use think\Model;

class Food extends Model
{
    // 表名
    protected $name = 'food';

    // 查询所有美食
    public function getAllFood() {
		  $food = $this->select();
    return $food;
    }
    
    // 通过美食ID查询美食
    public function getFoodById($id) {
      $food = $this->where('id',$id)->find();
      return $food;
    }
}
