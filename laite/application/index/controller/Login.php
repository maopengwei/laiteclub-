<?php
namespace app\index\Controller;
use app\common\model\Detail;
use app\common\model\User;
use think\Config;
use think\Controller;
use think\Db;
use think\Lang;
use think\Request;
use think\Session;

class Login extends Controller {
    protected $user;
    protected $detail;
    function _initialize() {
        parent::_initialize();
        Lang::setAllowLangList(['zh-cn', 'en-us', 'zh-tw']);
        $this->user = new User;
        $this->detail = new Detail;
        if (isset($_GET['lang'])) {
            $this->lang();
        }
    }
    /**
     * 登录页加载
     * 登录验证
     * @return [type] [description]
     */
    public function index() {
        $this->is_login();
        if (Request::instance()->isPost()) {
            $request = request()->post();
            //判断不为空
            if ($request['user'] == "") {$this->error(lang('humingweikong'));}
            if ($request['user_pass'] == "") {$this->error(lang('mimaweikong'));}
            //验证器
            // $validate = validate('Verify');
            // if (!$validate->check($request)) {
            //     $this->error($validate->getError());
            // }
            $info = User::where('user', $request['user'])->field('id,user,salt,status')->find();
            if ($info == '') {
                $this->error(lang('haowubucunzai'));
            }
            if ($info['status'] == 0) {
                $this->error(lang('haoweijihuo'));
            }
            if ($info['status'] == 2) {
                $this->error(lang('haobeifeng'));
            }
            $user_pass = md5(md5($request['user_pass'] . $info->salt));
            $infp = User::where(array('user' => $request['user'], 'user_pass' => $user_pass))->value('id');
            if ($infp == "") {
                $this->error(lang('mimawrong'));
            }
            Session::set('uname', $request['user']);
            Session::set('uid', $info['id']);
            Session::set('log_time', time());
            $this->success(lang('dengluchenggong'), '/index/index/index');
        }
        return $this->fetch();
    }
    /**
     * 退出登录
     * 清除session()
     */
    public function logout() {
        Session::delete('uname');
        Session::delete('uid');
        Session::delete('log_time');
        $this->redirect('/index/login/index');
    }
    public function forget() {
        if (Request::instance()->isPost()) {
            $request = request()->post();
            //手机验证码
            if ($request['note_code'] == "") {$this->error(lang('codekong'));}
            if ($request['note_code'] != session('note_code')) {
                $this->error(lang('codewrong'));
            }
            if ($request['user_pass'] == "") {
                $this->error(lang('mimakong'));
            }
            if ($request['pass1'] != $request['user_pass']) {
                $this->error(lang('mimabutong'));
            }
            $info = Db::name('user')->where('phone', $request['phone'])->find();
            if (!$info) {
                $this->error(lang('haobucunzai'));
            }
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $user_pass = md5(md5($request['user_pass'] . $info['salt']));
            if ($user_pass == $info['user_pass']) {
                $this->success(lang('chongzhichenggong'), 'index');
            }
            $rel = Db::name('user')->where('id', $info['id'])->setfield('user_pass', $user_pass);
            if ($rel) {
                $this->success(lang('chongzhichenggong'), 'index');
            } else {
                $this->error(lang('chongzhishibai'));
            }
        }
        return $this->fetch();
    }
    public function register() {
        $id = input('get.id');
        $info = DB::name('user')->where('id', $id)->field('id,user')->find();
        // halt($info);
        if (Request::instance()->isPost()) {
            $request = request()->post();
            //手机验证码
            if ($request['note_code'] != session('note_code')) {
                $this->error(lang('codewrong'));
            }
            //判断不为空
            if ($request['note_code'] == "") {$this->error(lang('codekong'));}
            if ($request['user'] == "") {$this->error(lang('humingweikong'));}
            if ($request['phone'] == "") {$this->error(lang('shoujikong'));}
            if ($request['identity'] == "") {$this->error(lang('zhengjianzhengkong'));}
            if ($request['theme'] == "") {$this->error(lang('xingmingkong'));}
            if ($request['email'] == "") {$this->error(lang('youxiangkong'));}
            if ($request['user_pass'] == "") {$this->error(lang('mimakong'));}
            if ($request['second_pass'] == "") {$this->error(lang('anquanmimakong'));}
            //重复密码
            if ($request['user_pass'] != $request['pass1']) {$this->error(lang('mimabutong'));}
            if ($request['second_pass'] != $request['pass2']) {$this->error(lang('anquanmimabutong'));}
            //验证器
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $info1 = $this->user->where('user', $request['user'])->find();
            if ($info1) {
                $this->error(lang('yonghuzhucel'));
            }
            $info2 = $this->user->where('phone', $request['phone'])->find();
            if ($info2) {
                $this->error(lang('shoujizhucel'));
            }
            $info3 = $this->user->where('identity', $request['identity'])->find();
            if ($info3) {
                $this->error(lang('zhengjianzhucel'));
            }
            $info4 = $this->user->where('email', $request['email'])->find();
            if ($info4) {
                $this->error(lang('youxiangzhucel'));
            }
            $path = $this->user->where(array('id' => $request['pid']))->value('path');
            if ($path != '') {
                $allpath = $path . ',' . $request['pid'];
            } else {
                $this->error(lang('tuijianno'));
            }
            $salt = GetRandStr(4);
            $this->user->data([
                'user' => $request['user'],
                'pid' => $request['pid'],
                'phone' => $request['phone'],
                'theme' => $request['theme'],
                'add_time' => time(),
                'salt' => $salt,
                'user_pass' => md5(md5($request['user_pass'] . $salt)),
                'second_pass' => md5(md5($request['second_pass'] . $salt)),
                'path' => $allpath,
            ]);
            $rel1 = $this->user->save();
            $id = $this->user->id;
            $rel2 = $this->detail->save(array('uid' => $id));
            if ($rel1 && $rel2) {
                $this->success(lang('zhucechenggong'), 'index');
            } else {
                $this->error(lang('zhuceshibai'));
            }
        }
        if (!$info) {
            $this->error(lang('feifacaozuo'));
        }
        $this->assign('info', $info);
        return $this->fetch();
    }

    /**
     *后台登录前台
     */
    public function admin() {
        $id = input('get.id');
        $info = User::where('id', $id)->field('id,user')->find();
        Session::set('uname', $info['user']);
        Session::set('uid', $info['id']);
        Session::set('log_time', time());
        $this->redirect('/index/index/index');
    }
    /**
     * 是否登录
     * 是 跳转到首页
     * @return boolean [description]
     */
    protected function is_login() {
        if (session('uid')) {
            $this->redirect('/index/index/index');
        }
    }
    /**
     * 发送手机验证码
     * @return [type] [description]
     */
    public function sendSMS() {
        $mobile = input('get.mobile');
        // $random = mt_rand(1000, 9999);
        $random = 1234;
        $content = "您的验证码为：" . $random;
        session('note_code', $random);
        session('code_time', time());
        // $data = $this->note_code($mobile, $content);
        $data = array(
            'status' => 'success',
            'msg' => lang('duanxinyifasong'),
        );
        return $data;
    }
    /**
     * 短信验证码
     * @param  [type] $mobile  [手机号]
     * @param  [type] $content [短信内容]
     * @return [type]          [description]
     */
    protected function note_code($mobile, $content) {
        header('Content-Type:text/html;charset=utf8');
        $userid = '';
        $account = Config::get('smsaccount');
        $password = Config::get('smspassword');
        $password = md5($password);
        $password = ucfirst($password);
        $content = '【laitejulebu】尊敬的会员你好,' . $content;
        $gateway = "http://114.113.154.5/sms.aspx?action=send&userid={$userid}&account={$account}&password={$password}&mobile={$mobile}&content={$content}&sendTime=";
        $result = file_get_contents($gateway);
        $xml = simplexml_load_string($result);
        if ($xml->returnstatus == 'Faild') {
            return array(
                'status' => 'failed',
                'msg' => lang('xitongcuowufasongshibai'),
            );
        }
        return array(
            'status' => 'success',
            'msg' => lang('duanxinyifasong'),
        );
    }
    /**
     * 语言包
     * @return [type] [description]
     */
    protected function lang() {
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
