<?php
namespace app\admin\Controller;
use think\Controller;
use think\Db;

/**
 * 公共控制器
 */
class Base extends Controller {

    function _initialize() {
        parent::_initialize();
        $this->is_login();
        $this->jihua();
    }
    protected function is_login() {
        if (!session('mid')) {
            $this->redirect('/admin/login/index');
        }
    }
    protected function jihua() {
        $where1 = array(
            'zt' => 3,
            'status' => 0,
            'end_time' => array('lt', time()),
            'delete' => 0,
        );
        $list1 = Db::name('ppdd')->where($where1)->select();
        if ($list1) {
            foreach ($list1 as $k => $v) {
                $money = $v['jb'] / 2 + $v['jb'] / 10;
                $uid = DB::name('user')->where('user', $v['p_user'])->value('id');
                DB::name('user')->where('user', $v['p_user'])->setInc('static_wallet', $money);
                //记录
                $data = array(
                    'uid' => $uid,
                    'jb' => $money,
                    'add_time' => $v['end_time'],
                    'type' => 1,
                );
                DB::name('userget')->insert($data);
                DB::name("ppdd")->where('id', $v['id'])->setfield('status', 1);
            }
        }
        $where2 = array(
            'zt' => 3,
            'status' => 1,
            'last_time' => array('lt', time()),
            'delete' => 0,
        );
        $list2 = Db::name('ppdd')->where($where2)->select();
        if ($list2) {
            foreach ($list2 as $k => $v) {
                $money = $v['jb'] / 2 + $v['jb'] / 10;
                $uid = DB::name('user')->where('user', $v['p_user'])->value('id');
                DB::name('user')->where('user', $v['p_user'])->setInc('static_wallet', $money);
                //记录
                $data = array(
                    'uid' => $uid,
                    'jb' => $money,
                    'add_time' => $v['last_time'],
                    'type' => 2,
                );
                DB::name('userget')->insert($data);
                DB::name("ppdd")->where('id', $v['id'])->setfield('zt', 4);
            }
        }
        $where3 = array(
            'zt' => 1,
            'delete' => 0,
            'cold' => 0,
            'add_time' => array('lt', time() - 21600),
        );
        $list3 = Db::name('ppdd')->where($where3)->select();
        if ($list3) {
            foreach ($list3 as $k => $v) {
                $data = array(
                    'cold' => 1,
                    'cold_time' => time(),
                );
                Db::name('ppdd')->where('id', $v['id'])->update($data);
                $datb = array(
                    'status' => 3,
                    'cold_time' => time(),
                );
                Db::name('user')->where('user', $v['p_user'])->update($datb);
            }
        }
        $where4 = array(
            'zt' => 2,
            'delete' => 0,
            'pay_time' => array('lt', time() - 14400),
            'cold' => 0,
            'ts_zt' => 0,
        );
        $list4 = Db::name('ppdd')->where($where4)->select();
        if ($list4) {
            foreach ($list4 as $k => $v) {
                $data = array(
                    'cold' => 2,
                    'cold_time' => time(),
                );
                Db::name('ppdd')->where('id', $v['id'])->update($data);
                $datb = array(
                    'status' => 4,
                    'cold_time' => time(),
                );
                Db::name('user')->where('user', $v['g_user'])->update($datb);
            }
        }
    }
}