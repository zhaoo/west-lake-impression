<?php

namespace app\index\model;
use think\Model;

class Strategy extends Model
{
    // 表名
    protected $name = 'strategy';

    // 查询攻略列表
    public function getStrategyList() {
		  $strategy = $this->paginate(5);
    return $strategy;
    }

    // 通过ID查询攻略
    public function getStrategyListById($id) {
      $strategy = $this->where('scenic_id',$id)->paginate(5);
      return $strategy;
    }

    // 通过ID查询单个攻略
    public function getStrategyById($id) {
      $strategy = $this->where('id',$id)->find();
      return $strategy;
    }

    // 通过UID查询单个攻略
    public function getStrategyByUid($id) {
      $strategy = $this->where('user_id',$id)->paginate(5);
      return $strategy;
    }

  // 根据ID删除攻略
  public function deleteStrategyById($id) {
    $res = $this->where('id', $id)->delete();
    if ($res == false) {
      return 'error';
    } else {
      return 'success';
    }
  }

  // 上传攻略
  public function addStrategy($param) {
      $this->insert($param);
  }
}
