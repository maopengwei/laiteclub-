<?php
namespace app\common\model;
use app\common\model\User;
use think\Model;

class Jsbz extends Model {
    public function getUidAttr($value) {
        return User::where(array('id' => $value))->value('user');
    }
    public function getTypeAttr($value) {
        $type = [0 => '转化', 1 => '添加'];
        return $type[$value];
    }
    public function getZtAttr($value) {
        $zt = [0 => '未匹配', 1 => '已匹配'];
        return $zt[$value];
    }
    public function getStatusAttr($value) {
        $status = [0 => '未拆分', 1 => '拆分'];
        return $status[$value];
    }
}