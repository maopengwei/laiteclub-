<?php
namespace app\common\model;
use think\Model;
use app\common\model\User;

class Message extends Model {
	public function getUidAttr($value) {
        return User::where('id', $value)->value('user');
    }
    public function getStatusattr($value) {
        $status = [0 => '未回复', 1 => '已回复'];
        return $status[$value];
    }
}