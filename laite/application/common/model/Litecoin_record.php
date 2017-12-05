<?php
namespace app\common\model;
use app\common\model\User;
use think\Model;

/**
 * 系统赠送激活转让
 */
class Litecoin_record extends Model {
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
    public function getTypeattr($value) {
        $type = [0 => '系统赠送', 1 => '报单中心赠送', 2 => '激活'];
        return $type[$value];
    }
}