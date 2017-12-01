<?php
namespace app\common\model;
use app\common\model\User;
use think\Model;

class Record_receive extends Model {
    public function getUidAttr($value) {
        return User::where(array('id' => $value))->value('user');
    }
    public function getTypeattr($value) {
        $type = [0 => '后台添加', 1 => '静态提现', 2 => '奖励提现', 3 => '动态提现'];
        return $type[$value];
    }
}