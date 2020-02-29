<?php

namespace app\index\model;
use think\Model;

class Contact extends Model
{
  // 表名
  protected $name = 'contact';

  // 增加留言
  public function addContent($param) {
    if(request()->isAjax()){
      $result = $this->insert($param);
      if ($result == false) {
        return 'error';
      } else {
        return 'success';
      }
    }
  }
}
