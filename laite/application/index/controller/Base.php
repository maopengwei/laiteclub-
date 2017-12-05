<?php
namespace app\index\Controller;
use think\Controller;
use think\Cookie;
use think\Db;

/**
 * 公共控制器
 *
 */
class Base extends Controller {

    function _initialize() {
        parent::_initialize();
        $this->is_kaiqi();
        $this->is_login();
        $this->info();
        if (isset($_GET['lang'])) {
            $this->lang();
        }
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
    protected function is_kaiqi() {
        $zt = DB::name('system')->where('id', 1)->value('zt');
        if ($zt == 2) {
            echo '系统正在维护中';exit;
        }
    }
    protected function info() {
        $add_time = Db::name('user')->where('id', session('uid'))->value('add_time');
        $tian_num = time() - $add_time;
        $tian_num = ceil($tian_num / 86400);
        $this->assign(array(
            'yonghu' => session('uname'),
            'tian_num' => $tian_num,
        ));
    }
    protected function lang() {
        Cookie::delete('think_var');
        switch ($_GET['lang']) {
        case 'zh-cn':
            cookie('think_var', 'zh-cn');
            break;
        case 'zh-tw':
            cookie('think_var', 'zh-tw');
            break;
        case 'en-us':
            cookie('think_var', 'en-us');
            break;
        }
    }
}