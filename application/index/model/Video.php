<?php

namespace app\index\model;
use think\Model;

class Video extends Model
{
    // 表名
    protected $name = 'video';

    // 查询所有视频
    public function getAllVideo() {
		$video = $this->select();
        return $video;
    }
}
