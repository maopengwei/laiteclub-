<?php
namespace app\common\model;
use app\common\model\User;
use think\Model;

/**
 * 直推注册领导
 */
class Litecoin_profit extends Model {
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
        if($value==0){
            return '空';
        }else{
           return User::where(array('id' => $value))->value('user'); 
        }
    }
    public function getTypeattr($value) {
        $type = [0 => '直推奖励', 1 => '注册奖励', 2 => '领导奖励'];
        return $type[$value];
    }
}