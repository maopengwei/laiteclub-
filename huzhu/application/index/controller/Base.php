<?php
namespace app\index\Controller;
use think\Controller;

/**
 * 公共控制器
 *
 */
class Base extends Controller {

    function _initialize() {
        parent::_initialize();
        if (is_mobile()) {
            $this->redirect('/mobile/index/index');
        }
        $this->assign('yonghu', session("uname"));
        $this->is_login();
    }
    /**
     * 判断登录
     * 不是 跳转到登录页
     * @return boolean [description]
     */
    protected function is_login() {
        if (!session('uid')) {
            $this->redirect('/index/login/index');
        }
    }
}