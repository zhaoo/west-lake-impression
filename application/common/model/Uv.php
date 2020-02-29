<?php

namespace app\common\model;
use think\Model;

class Uv extends Model
{
    // 表名
    protected $name = 'uv';

    // 查询有无当天UV
    public function ifAddUv($ip) {
        if ($this->where('ip', $ip)->whereTime('viewtime', 'd')->find()) {
            return 1;
        }
    }

    // 增加UV
    public function addUv($ip, $time) {
        $this->insert(['ip' => $ip, 'viewtime' => $time]);
    }
}
