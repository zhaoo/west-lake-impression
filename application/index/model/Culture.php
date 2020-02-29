<?php

namespace app\index\model;
use think\Model;

class Culture extends Model
{
    // 表名
    protected $name = 'culture';

    // 查询所有文化
    public function getAllCulture() {
		  $culture = $this->select();
    return $culture;
    }
    
    // 通过美食ID查询文化
    public function getCultureById($id) {
      $culture = $this->where('id',$id)->find();
      return $culture;
    }
}
