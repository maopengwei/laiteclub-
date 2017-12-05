<?php
namespace app\index\controller;
use app\common\model\Detail;
use app\common\model\User as Usermodel;
use think\Controller;
use think\Db;
use think\Request;

/**
 * 用户控制器
 * 注册新会员
 * 个人信息
 * 修改密码
 */
class User extends Base {
    protected $user;
    protected $detail;
    function _initialize() {

        parent::_initialize();
        $this->user = new Usermodel;
        $this->detail = new Detail;
    }
    /**
     * 注册新会员
     * @return [type] [description]
     */
    public function register() {
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $level = $this->user->where('id', session("uid"))->value('level');
            if (!$level) {
                $this->error(lang('nobaodanzhongxin'));
            }
            // halt($request);
            //手机验证码
            if ($request['note_code'] != session('note_code')) {
                $this->error(lang('codewrong'));
            }
            //判断不为空
            if ($request['note_code'] == "") {$this->error(lang('codekong'));}
            if ($request['user'] == "") {$this->error(lang('humingweikong')}
            if ($request['phone'] == "") {$this->error(lang('shoujikong'));}
            if ($request['identity'] == "") {$this->error(lang('zhengjianzhengkong'));}
            if ($request['theme'] == "") {$this->error(lang('xingmingkong'));}
            if ($request['email'] == "") {$this->error(lang('youxiangkong'));}
            if ($request['user_pass'] == "") {$this->error(lang('mimakong'));}
            if ($request['second_pass'] == "") {$this->error(lang('anquanmimakong'));}
            // //验证器
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
            $parent = $this->user->where(array('user' => $request['tname']))->field('id,path')->find();
            if ($parent != '') {
                $pid = $parent['id'];
                $path = $parent['path'] . ',' . $parent['id'];
            } else {
                 $this->error(lang('tuijianno'));
            }
            $salt = GetRandStr(4);
            $this->user->data([
                'user' => $request['user'],
                'theme' => $request['theme'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'identity' => $request['identity'],
                'zid' => session('uid'),
                'pid' => $pid,
                'path' => $path,
                'add_time' => time(),
                'salt' => $salt,
                'user_pass' => md5(md5($request['user_pass'] . $salt)),
                'second_pass' => md5(md5($request['second_pass'] . $salt)),
            ]);
            $rel = $this->user->save();
            $uid = $this->user->id;
            $datb = array(
                'uid' => $uid,
            );
            $rel2 = $this->detail->save($datb);
            if ($rel && $rel2) {
                $this->success(lang('zhucechenggong'));
            } else {
                $this->error(lang('zhuceshibai'));
            }
        }
        $url = "http://" . $_SERVER['HTTP_HOST'] . "/index/login/register?id=" . session('uid');
        $this->assign(array(
            'uname' => session('uname'),
            'url' => $url,
        ));
        return $this->fetch();
    }
    /**
     * 激活用户
     * @return [type] [description]
     */
    public function active() {
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $level = $this->user->where('id', session("uid"))->value('level');
            if (!$level) {
                $this->error(lang('nobaodanzhongxinjihuo'));
            }
            $info = $this->user->where('user', $request['user'])->find();
            if (!$info) {
                $this->error(lang('haobucunzai'));
            }
            $aa = in_team(session('uid'), $info['id']);
            if (!$aa) {
                $this->error(lang('haonoteam'));
            }
            if ($info['status'] != 0) {
                $this->error(lang('noweijihuo'));
            }

            $data = array(
                'uid' => session('uid'),
                'uid_two' => $info['id'],
                'num' => 10.5,
                'type' => 2,
                'add_time' => time(),
            );
            $rel1 = Db::name('user')->where('id', $info['id'])->setfield('status', 1);
            $rel2 = Db::name('detail')->where('uid', session("uid"))->setDec('litecoin_wallet', 10.5);
            $rel3 = Db::name('litecoin_record')->insert($data);
            if ($rel1 && $rel2 && $rel3) {
                zhitui_profit($info['id']); //推荐奖
                register_profit($info['id']); //报单奖
                $this->success(lang('jihuochenggong'));
            } else {
                $this->error(lang('jihuoshibai'));
            }

        }
        return $this->fetch();
    }
    /**
     * 查找用户
     */
    public function find() {
        $user = input('post.user');
        $level = $this->user->where('id', session("uid"))->value('level');
        if (!$level) {
            $this->error(lang('nobaodanzhongxinchaxun'));
        }
        $info = $this->user->where('user', $user)->find();
        $data['theme'] = $info['theme'];
        $litecoin = $this->detail->where('uid', $info['id'])->value('litecoin_wallet');
        $data['litecoin'] = $litecoin;
        return $data;
    }
    /**
     * 个人信息展示
     * 表单提交
     * @return [type] [description]
     */
    public function index() {
        $info = $this->user->where('id', session('uid'))->find();
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $second_pass = md5(md5($request['second_pass'] . $info['salt']));
            if ($second_pass != $info['second_pass']) {$this->error(lang('anquanrong'));}
            if ($request['withdraw_address'] == "") {$this->error(lang('shoukuandizhikong'));}
            $rel = $this->detail->where('uid', session('uid'))->setfield('withdraw_address', $request['withdraw_address']);
            if ($rel) {
                $this->success(lang('xiugaichenggong'));
            } else {
                $this->error(lang('xiugaishibai'));
            }
        }
        $this->assign('info', $info);
        return $this->fetch();
    }
    /**
     * 修改密码
     * @return [type] [description]
     */
    public function change() {
        return $this->fetch();
    }
    /**
     * 修改登录密码
     */
    public function user_pass() {
        $info = $this->user->where('id', session("uid"))->find();
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $old_user_pass = md5(md5($request['old_user_pass'] . $info['salt']));
            $user_pass = md5(md5($request['user_pass'] . $info['salt']));
            if ($old_user_pass != $info['user_pass']) {$this->error(lang('yuandengluwrong'));}
            if ($request['user_pass'] == "") {$this->error(lang('mimakong'));}
            if ($request['user_pass'] != $request['pass1']) {$this->error(lang('mimabutong'));}
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $data = array(
                'user_pass' => $user_pass,
            );
            $rel = $this->user->save($data, ['id' => session("uid")]);
            if ($rel) {
                $this->success(lang('xiugaichenggong'));
            } else {
                $this->error(lang('xiugaishibai'));
            }
        } else {
            $this->error(lang('feifacaozuo'));
        }
    }
    /**
     * 修改二级密码
     */
    public function second_pass() {
        $info = $this->user->where('id', session("uid"))->find();
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $old_second_pass = md5(md5($request['old_second_pass'] . $info['salt']));
            $second_pass = md5(md5($request['second_pass'] . $info['salt']));
            if ($old_second_pass != $info['second_pass']) {$this->error(lang('anquanrong'));}
            if ($request['second_pass'] == "") {$this->error(lang('xinanquankong'));}
            if ($request['second_pass'] != $request['pass2']) {$this->error(lang('anquanbutong'));}
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $data = array(
                'second_pass' => $second_pass,
            );
            $rel = $this->user->save($data, ['id' => session("uid")]);
            if ($rel) {
                $this->success(lang('xiugaichenggong'));
            } else {
                $this->error(lang('xiugaishibai'));
            }
        } else {
            $this->error(lang('feifacaozuo'));
        }
    }
}