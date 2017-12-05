<?php
namespace app\admin\Controller;
use think\Controller;

/**
 * 公共控制器
 */
class Base extends Controller {

    function _initialize() {
        parent::_initialize();
        $this->is_login();
    }
    protected function is_login() {
        if (!session('mid')) {
            $this->redirect('/admin/login/index');
        }
    }
}