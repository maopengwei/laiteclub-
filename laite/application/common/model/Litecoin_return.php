<?php
namespace app\common\model;
use app\common\model\User;
use think\Model;

/**
 * 日返
 */
class Litecoin_return extends Model {
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
        $type = [0 => '莱特币', 1 => '复消币', 2 => 'ICO',3 =>'股份'];
        return $type[$value];
    }
}