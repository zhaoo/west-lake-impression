<?php

namespace app\index\model;
use think\Model;

class Album extends Model
{
    // 表名
    protected $name = 'album';
    
    // 通过景区ID查询所有相片
    public function getAlbumById($id) {
      $album = $this->where('scenic_id',$id)->select();
      return $album;
    }
}
