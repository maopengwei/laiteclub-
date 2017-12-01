<?php
namespace app\index\controller;
use app\common\model\User as Usermodel;
use think\Controller;
use think\Request;

/**
 * 用户控制器
 * 注册新会员
 * 个人信息
 * 修改密码
 */
class User extends Base {
    protected $user;
    function _initialize() {

        parent::_initialize();
        $this->user = new Usermodel;
    }
    /**
     * 注册新会员
     * @return [type] [description]
     */
    public function register() {
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            //手机验证码
            if ($request['note_code'] != session('note_code')) {
                $this->error('短信验证码不正确');
            }
            //判断不为空
            if ($request['note_code'] == "") {$this->error('短信验证码不能为空');}
            if ($request['user'] == "") {$this->error('用户名为空');}
            if ($request['phone'] == "") {$this->error('手机号不能为空');}
            if ($request['user_pass'] == "") {$this->error('登录密码不能为空');}
            if ($request['second_pass'] == "") {$this->error('二级密码不能为空');}
            //重复密码
            if ($request['user_pass'] != $request['pass1']) {$this->error('两次输入登录密码不相同');}
            if ($request['second_pass'] != $request['pass2']) {$this->error('两次输入二级密码不相同');}
            //验证器
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $info1 = $this->user->where('user', $request['user'])->find();
            if ($info1) {
                $this->error('该用户已经注册过了');
            }
            $info2 = $this->user->where('phone', $request['phone'])->find();
            if ($info2) {
                $this->error('该手机号已经注册过了');
            }
            $info3 = $this->user->where('theme', $request['theme'])->find();
            if ($info3) {
                $this->error('该姓名已经注册过了');
            }
            $path = $this->user->where(array('id' => session('uid')))->value('path');
            if ($path != '') {
                $allpath = $path . ',' . session('uid');
            } else {
                $allpath = 0;
            }
            $salt = GetRandStr(4);
            $this->user->data([
                'user' => $request['user'],
                'pid' => session('uid'),
                'phone' => $request['phone'],
                'theme' => $request['theme'],
                'add_time' => time(),
                'salt' => $salt,
                'user_pass' => md5(md5($request['user_pass'] . $salt)),
                'second_pass' => md5(md5($request['second_pass'] . $salt)),
                'path' => $allpath,
            ]);
            $rel = $this->user->save();
            if ($rel) {
                $this->success('注册成功');
            } else {
                $this->error('注册失败，请联系管理员');
            }
        }
        $this->assign('uname', session('uname'));
        return $this->fetch();
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
            if ($second_pass != $info['second_pass']) {$this->error('二级密码不正确');}
            if ($request['alipay'] != $info['alipay'] && $info['alipay'] != "") {$this->error('不能修改您的支付宝号');}
            if ($request['bank_name'] != $info['bank_name'] && $info['bank_name'] != "") {$this->error('不能修改您的银行名称');}
            if ($request['card_number'] != $info['card_number'] && $info['card_number'] != "") {$this->error('不能修改您的银行卡号');}
            if ($request['wechat'] != $info['wechat'] && $info['wechat'] != "") {$this->error('不能修改您的微信号');}
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $data = array(
                'alipay' => $request['alipay'],
                'bank_name' => $request['bank_name'],
                'card_number' => $request['card_number'],
                'wechat' => $request['wechat'],
                'address' => $request['address'],
            );
            $rel = $this->user->save($data, ['id' => session("uid")]);
            if ($rel) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
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
            if ($old_user_pass != $info['user_pass']) {$this->error('原密码不正确');}
            if ($request['user_pass'] == "") {$this->error('新登录密码不能为空');}
            if ($request['user_pass'] != $request['pass1']) {$this->error('两次输入登录密码不相同');}
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $data = array(
                'user_pass' => $user_pass,
            );
            $rel = $this->user->save($data, ['id' => session("uid")]);
            if ($rel) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        } else {
            $this->error('非法操作');
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
            if ($old_second_pass != $info['second_pass']) {$this->error('原密码不正确');}
            if ($request['second_pass'] == "") {$this->error('新二级密码不能为空');}
            if ($request['second_pass'] != $request['pass2']) {$this->error('两次输入二级密码不相同');}
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $data = array(
                'second_pass' => $second_pass,
            );
            $rel = $this->user->save($data, ['id' => session("uid")]);
            if ($rel) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        } else {
            $this->error('非法操作');
        }
    }
}