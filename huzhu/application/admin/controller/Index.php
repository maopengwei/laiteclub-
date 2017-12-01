<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;

/**
 * 首页控制器
 * 主体 左边 顶部 首页
 * 继承基础控制器base
 */
class Index extends Base {

    public function main() {
        return $this->fetch();
    }
    public function left() {

        return $this->fetch();
    }
    public function top() {
        $this->assign('muser', session("mname"));
        return $this->fetch();
    }
    public function index() {
        if (Request::instance()->isPost()) {
            $request = request()->post();
            $rel = DB::name('system')->where('SYS_ID', 1)->setfield('zt', $request['zt']);
            if ($rel) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        }
        $register_count = Db::name('user')->count();
        //today
        $date['date'] = array('between', array(strtotime(date('Y-m-d')), strtotime(date('Y-m-d')) + 86400));
        $today_tgbz = DB::name('record_pay')->where($date)->sum('jb');
        $today_jsbz = DB::name('record_receive')->where($date)->sum('jb');
        $pipei['add_time'] = array('between', array(strtotime(date('Y-m-d')), strtotime(date('Y-m-d')) + 86400));
        $today_pp = DB::name('ppdd')->where($pipei)->sum('jb');
        $dongjie['receive_time'] = array('between', array(strtotime(date('Y-m-d')), strtotime(date('Y-m-d')) + 86400));
        $today_tikuan = DB::name('ppdd')->where($dongjie)->sum('jb');
        $all_tgbz = DB::name('record_pay')->sum('jb');
        $all_jsbz = DB::name('record_receive')->sum('jb');
        $ppdd['zt'] = array('between', '3,4');
        $ppdd = DB::name('ppdd')->where($ppdd)->sum('jb');
        $static['type'] = array('between', '1,2');
        $static = DB::name('userget')->where($static)->sum('jb');
        $dynamic['type'] = array('between', '3,4,5');
        $dynamic = DB::name('userget')->where($static)->sum('jb');
        $awart['type'] = 6;
        $awart = DB::name('userget')->where($awart)->sum('jb');
        $shop['type'] = array('between', '7,8,9');
        $shop = DB::name('userget')->where($shop)->sum('jb');
        $zt = DB::name('system')->where('SYS_ID', 1)->value('zt');
        $this->assign(array(
            'zt' => $zt,
            'today_tgbz' => $today_tgbz,
            'today_jsbz' => $today_jsbz,
            'today_pp' => $today_pp,
            'today_tikuan' => $today_tikuan,
            'shop' => $shop,
            'awart' => $awart,
            'dynamic' => $dynamic,
            'static' => $static,
            'ppdd' => $ppdd,
            'all_tgbz' => $all_tgbz,
            'all_jsbz' => $all_jsbz,
            'register_count' => $register_count,
        ));
        return $this->fetch();
    }
}