<?php
namespace app\mobile\controller;
use app\common\model\Ppdd;
use app\common\model\User;
use think\Controller;

/**
 * 订单控制器
 * 投资完成
 * 收益完成
 */
class Ident extends Base {
    protected $user;
    protected $ppdd;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->ppdd = new Ppdd;
    }
    /**
     * 投资订单
     * @return [type] [description]
     */
    public function tgbz() {
        $where = array(
            'p_user' => session('uname'),
            'delete' => 0,
        );
        $list = $this->ppdd->where($where)->order('zt')->select();
        $this->assign(array(
            'list' => $list,
        ));
        return $this->fetch();
    }
    /**
     * 收益订单
     */
    public function jsbz() {
        $where = array(
            'g_user' => session('uname'),
            'delete' => 0,
        );
        $list = $this->ppdd->where($where)->order('zt')->select();
        // dump($list);die;
        $this->assign('list', $list);
        return $this->fetch();
    }
    /**
     * 提供单详情
     * @return [type] [description]
     */
    public function tgbz_detail() {
        $id = input('get.id');
        if ($id == "") {
            $this->error('非法操作');
        }
        $order_info = $this->ppdd->where('id', $id)->find();
        $user_info = $this->user->where('user', $order_info['g_user'])->find();
        $this->assign(array(
            'order_info' => $order_info,
            'user_info' => $user_info,
        ));
        return $this->fetch();
    }
    /**
     * 接收单详情
     * @return [type] [description]
     */
    public function jsbz_detail() {
        $id = input('get.id');
        if ($id == "") {
            $this->error('非法操作');
        }
        $order_info = $this->ppdd->where('id', $id)->find();
        $user_info = $this->user->where('user', $order_info['p_user'])->find();
        // dump($order_info);die;
        $this->assign(array(
            'order_info' => $order_info,
            'user_info' => $user_info,
        ));
        return $this->fetch();
    }
}