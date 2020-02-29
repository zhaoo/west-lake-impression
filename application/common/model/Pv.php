<?php

namespace app\common\model;
use think\Model;

class Pv extends Model
{
    // 表名
    protected $name = 'pv';

    // 根据日期更新PV
    public function updatePv($date) {
        if ($this->where('date', $date)->find()) {
            $this->where('date', $date)->setInc('num');
        } else {
            $this->save(['date' => $date, 'num' => 0]);
        }
    }
}
