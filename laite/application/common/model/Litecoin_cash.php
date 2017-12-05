<?php
namespace app\common\model;
use app\common\model\User;
use think\Model;

/**
 * 直推注册领导
 */
class Litecoin_cash extends Model {
    function _initialize() {
        parent::_initialize();
    }
    public function getUidAttr($value) {
        if ($value == 0) {
            return '系统';
        } else {
            return User::where('id', $value)->value('user');
        }
    }
    public function getUidTwoAttr($value) {
        return User::where(array('id' => $value))->value('user');
    }
    public function getStatusAttr($value) {
        $type = [0 => '未审核', 1 => '审核通过'];
        return $type[$value];
    }
}