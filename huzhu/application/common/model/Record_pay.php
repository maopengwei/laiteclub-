<?php
namespace app\common\model;
use app\common\model\User;
use think\Model;

class Record_pay extends Model {
    public function getUidAttr($value) {
        return User::where(array('id' => $value))->value('user');
    }
    public function getTypeattr($value) {
        $type = [0 => '排单', 1 => '赠送'];
        return $type[$value];
    }
}