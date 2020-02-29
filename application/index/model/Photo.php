<?php

namespace app\index\model;
use think\Model;

class Photo extends Model
{
    // 表名
    protected $name = 'photo';

    // 查询所有照片
    public function getAllPhoto() {
		$photo = $this->paginate(9);
        return $photo;
    }

    // 上传图片
    public function addPhoto($param) {
        $this->insert($param);
    }

    // 通过Uid查询照片
    public function getPhotoByUid($uid) {
		$photo = $this->where('user_id', $uid)->paginate(9);
        return $photo;
    }

    // 根据ID删除照片
    public function deletePhotoById($id) {
        $res = $this->where('id', $id)->delete();
        if ($res == false) {
        return 'error';
        } else {
        return 'success';
        }
    }
}
