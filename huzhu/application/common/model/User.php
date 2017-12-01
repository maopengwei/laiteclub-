<?php
namespace app\common\model;
use think\Model;

class User extends Model {
    public function getPidAttr($value) {
        return self::where('id', $value)->value('user');
    }
}