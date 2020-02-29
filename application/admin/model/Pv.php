<?php

namespace app\admin\model;

use think\Model;

class Pv extends Model
{
    // 表名
    protected $name = 'pv';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [

    ];
    
    // 获取PV总数
    public function getAllPVNum() {
        $num = array_sum($this->column('num'));
        return $num;
    }

    // 获取今日PV
    public function getTodaypvNum() {
        $num = $this->where('date', date('Y-m-d'))->value('num');
        return $num;
    }

    // 获取前七天PV数量
    public function getLastPVNum() {
        for($i=0; $i<7; $i++) {
            $today = strtotime(date('Y-m-d',time()));
            $num[$i] = $this->where('date', date('Y-m-d', ($today - ($i+1)*24*60*60)))->value('num');
        }
        return $num;
    }
}
