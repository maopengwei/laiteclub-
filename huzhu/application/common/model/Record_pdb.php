<?php
namespace app\common\model;
use app\common\model\User;
use think\Model;

/**
 * 激活码记录表模型
 */
class Record_pdb extends Model {
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
        $type = [0 => '消耗', 1 => '转让', 2 => '系统赠送'];
        return $type[$value];
    }
}