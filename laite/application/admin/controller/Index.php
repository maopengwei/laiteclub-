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
            $rel = DB::name('system')->where('id', 1)->update($request);
            if ($rel) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        }
        $register_count = Db::name('user')->count();

        $system = DB::name('system')->where('id', 1)->find();
        $this->assign(array(
            'system' => $system,
            'register_count' => $register_count,
        ));
        return $this->fetch();
    }
}