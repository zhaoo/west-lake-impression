<?php

namespace app\index\model;
use think\Model;

class User extends Model
{
    // 表名
    protected $name = 'user';

    // 通过ID查询用户
    public function getUserById($id) {
      $user = $this->where('id',$id)->find();
      return $user;
    }
}
