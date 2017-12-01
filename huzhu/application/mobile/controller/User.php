<?php
namespace app\mobile\controller;
use app\common\model\User as Usermodel;
use think\Controller;
use think\Request;

/**
 * 用户控制器
 * 注册会员 个人信息修改 密码修改
 */
class User extends Base {
    protected $user;
    function _initialize() {
        parent::_initialize();
        $this->user = new Usermodel;
    }
    /**
     * 注册新会员  推荐人是我 全路径尝试
     * 加密加盐
     * @return [type] [description]
     */
    public function register() {
        $user_name = session('uname');
        $user_id = session('uid');
        if (Request::instance()->isPost()) {
            $request = request()->post();
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
            $path = $this->user->where(array('id' => $request['pid']))->value('path');
            if ($path != '') {
                $allpath = $path . ',' . $request['pid'];
            } else {
                $allpath = 0;
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
            $rel = $this->user->save();
            if ($rel) {
                $this->success('注册成功');
            } else {
                $this->error('注册失败，请联系管理员');
            }

        }
        $this->assign(array(
            'user_name' => $user_name,
            'user_id' => $user_id,
        ));
        return $this->fetch();
    }
    /**
     * 个人资料
     * @return [type] [description]
     */
    public function index() {
        $info = $this->user->where('id', session('uid'))->find();
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $second_pass = md5(md5($request['second_pass'] . $info['salt']));
            if ($second_pass != $info['second_pass']) {$this->error('二级密码不正确');}
            if ($request['alipay'] != $info['alipay'] && $info['alipay'] != "") {$this->error('不能修改您的支付宝号');}
            if ($request['bank_address'] != $info['bank_name'] && $info['bank_address'] != "") {$this->error('不能修改您的银行名称');}
            if ($request['bank_name'] != $info['bank_name'] && $info['bank_name'] != "") {$this->error('不能修改您的银行名称');}
            if ($request['card_number'] != $info['card_number'] && $info['card_number'] != "") {$this->error('不能修改您的银行卡号');}
            if ($request['wechat'] != $info['wechat'] && $info['wechat'] != "") {$this->error('不能修改您的微信号');}
            $data = array(
                'alipay' => $request['alipay'],
                'bank_address' => $request['bank_address'],
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
    public function change() {
        return $this->fetch();
    }
    public function change_user_pass() {
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
    public function change_second_pass() {
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