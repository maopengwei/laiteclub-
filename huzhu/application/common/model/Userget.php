<?php
namespace app\common\model;
use app\common\model\User;
use think\Model;

class Userget extends Model {
    public function getTypeAttr($value) {
        $type = [
            1 => '静态一期',
            2 => '静态二期',
            3 => '动态一代',
            4 => '动态二代',
            5 => '动态三代',
            6 => '奖励钱包',
            7 => '商城一代',
            8 => '商城二代',
            9 => '商城三代',
        ];
        return $type[$value];
    }
    public function getUidAttr($value) {
        return User::where(array('id' => $value))->value('user');
    }

}