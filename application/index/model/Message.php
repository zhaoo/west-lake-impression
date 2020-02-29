<?php

namespace app\index\model;
use think\Model;

class Message extends Model
{
  // 表名
  protected $name = 'message';

  // 增加评论
  public function addMessage($param) {
    if(request()->isAjax()){
      $res = $this->insert($param);
      if ($res == false) {
        return 'error';
      } else {
        return 'success';
      }
    }
  }

  // 根据景区ID获取评论
  public function getMessageById($id, $type) {
    $message = $this->where(['scenic_id'=>$id,'type'=>$type])->select();
    return $message;
  }

  // 根据美食ID获取评论
  public function getMessageByFid($id, $type) {
    $message = $this->where(['food_id'=>$id,'type'=>$type])->select();
    return $message;
  }

  // 根据用户ID获取评论
  public function getMessageByUid($id) {
    $message = $this->where('user_id', $id)->paginate(5);
    return $message;
  }

  // 根据ID删除评论
  public function deleteMessageById($id) {
    $res = $this->where('id', $id)->delete();
    if ($res == false) {
      return 'error';
    } else {
      return 'success';
    }
  }
}
