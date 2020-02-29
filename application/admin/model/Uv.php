<?php

namespace app\admin\model;

use think\Model;

class Uv extends Model
{
    // 表名
    protected $name = 'uv';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [

    ];
    
    // 获取UV总数
    public function getAllUVNum() {
        $num = $this->count();
        return $num;
    }

    // 获取今日UV
    public function getTodayUVNum() {
        $today = strtotime(date('Y-m-d',time()));
        $start = date('Y-m-d H:i:s', $today);
        $end = date('Y-m-d H:i:s', ($today + 24*60*60));
        $num = $this->where('viewtime', 'between', [$start, $end])->count();
        return $num;
    }

    // 获取前七天UV数量
    public function getLastUVNum() {
        for($i=0; $i<7; $i++) {
            $today = strtotime(date('Y-m-d',time()));
            $start = date('Y-m-d H:i:s', ($today - ($i+1)*24*60*60));
            $end = date('Y-m-d H:i:s', ($today - $i*24*60*60));
            $num[$i] = $this->where('viewtime', 'between', [$start, $end])->count();
        }
        return $num;
    }
}
