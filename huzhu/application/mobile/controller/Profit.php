<?php
namespace app\mobile\controller;
use app\common\model\User;
use app\common\model\Userget;
use think\Controller;

/**
 * 用户控制器
 * 注册会员 个人信息修改 密码修改
 */
class Profit extends Base {
    protected $user;
    protected $userget;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->userget = new Userget;
    }
    public function static_profit() {
        $where = array(
            'uid' => session('uid'),
            'type' => array('in', '1,2'),
        );
        $list = $this->userget->where($where)->select();
        $i = 1;
        foreach ($list as $k => $v) {
            $list[$k]['i'] = $i;
            $i++;
        }
        $this->assign('list', $list);
        return $this->fetch();
    }
    public function dynamic_profit() {
        $where = array(
            'uid' => session('uid'),
            'type' => array('in', '3,4,5'),
        );
        $list = $this->userget->where($where)->select();
        $i = 1;
        foreach ($list as $k => $v) {
            $list[$k]['i'] = $i;
            $i++;
        }
        $this->assign('list', $list);
        return $this->fetch();
    }
    public function awart_profit() {
        $where = array(
            'uid' => session('uid'),
            'type' => 6,
        );
        $list = $this->userget->where($where)->select();
        $i = 1;
        foreach ($list as $k => $v) {
            $list[$k]['i'] = $i;
            $i++;
        }
        $this->assign('list', $list);
        return $this->fetch();
    }
    public function shop_profit() {
        $where = array(
            'uid' => session("uid"),
            'type' => array('in', '7,8,9'),
        );
        $list = $this->userget->where($where)->select();
        $i = 1;
        foreach ($list as $k => $v) {
            $list[$k]['i'] = $i;
            $i++;
        }
        $this->assign('list', $list);
        return $this->fetch();
    }
}