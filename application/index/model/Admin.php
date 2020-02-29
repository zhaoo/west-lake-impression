<?php

namespace app\index\model;
use think\Model;

class Admin extends Model
{
    // 表名
    protected $name = 'admin';
  
    // 通过ID查询管理员
    public function getAdminById($id) {
      $admin = $this->where('id',$id)->find();
      return $admin;
    }
}
