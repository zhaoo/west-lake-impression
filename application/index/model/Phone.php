<?php

namespace app\index\model;
use think\Model;

class Phone extends Model
{
    // 表名
    protected $name = 'phone';

    // 查询所有电话
    public function getAllPhone() {
		$phone = $this->select();
        return $phone;
    }
}
