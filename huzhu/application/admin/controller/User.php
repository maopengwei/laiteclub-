<?php
namespace app\admin\Controller;

use app\common\model\User as Usermodel;
use think\Controller;
use think\Request;

/**
 * 用户控制器
 */
class User extends Base {

    protected $user;
    function _initialize() {
        parent::_initialize();
        $this->user = new Usermodel;
    }
    /**
     * 用户列表
     * @return [type] [description]
     */
    public function index() {
        $request = request()->param();
        $where = '';
        if (input('get.user') != "") {
            $where['user'] = $request['user'];
        }
        if (input('get.status') != "") {
            $where['status'] = $request['status'];
        }
        $list = $this->user->where($where)->field('id,pid,phone,theme,user,add_time,status')->paginate(20);
        $this->assign('list', $list);
        return $this->fetch();
    }
    /**
     * 用户添加 提交
     */
    public function add() {
        if (Request::instance()->isPost()) {
            $request = request()->post();
            //判断不为空
            if ($request['user'] == "") {$this->error('用户名不能为空');}
            if ($request['phone'] == "") {$this->error('手机号不能为空');}
            if ($request['user_pass'] == "") {$this->error('登录密码不能为空');}
            if ($request['second_pass'] == "") {$this->error('二级密码不能为空');}
            //验证器
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            //推荐人
            $parent = $this->user->where(array('user' => $request['tname']))->field('id,path')->find();
            if ($parent != '') {
                $path = $parent['path'] . ',' . $parent['id'];
            } else {
                $path = 0;
            }
            $salt = GetRandStr(4);
            $this->user->data([
                'user' => $request['user'],
                'pid' => $parent['id'],
                'phone' => $request['phone'],
                'theme' => $request['theme'],
                'add_time' => time(),
                'salt' => $salt,
                'user_pass' => md5(md5($request['user_pass'] . $salt)),
                'second_pass' => md5(md5($request['second_pass'] . $salt)),
                'path' => $path,
            ]);
            $rel = $this->user->save();
            if ($rel) {
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        }
        return $this->fetch();
    }
    /**
     * 用户信息 修改提交
     * @param
     */
    public function edit() {
        if (input('get.id') != "") {
            $id = input('get.id');
        } else {
            $this->error('非法操作');
        }
        $info = $this->user->where('id', $id)->find();
        if (Request::instance()->isPost()) {
            $request = request()->post();
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $data = array(
                'user' => $request['user'],
                'phone' => $request['phone'],
                'theme' => $request['theme'],
                'wechat' => $request['wechat'],
                'bank_address' => $request['bank_address'],
                'bank_name' => $request['bank_name'],
                'card_number' => $request['card_number'],
                'alipay' => $request['alipay'],
                'status' => $request['status'],
                'static_wallet' => $request['static_wallet'],
                'dynamic_wallet' => $request['dynamic_wallet'],
                'pdb' => $request['pdb'],
                'jhm' => $request['jhm'],
                'system' => $request['system'],
                'vaild' => $request['vaild'],
                'six' => $request['six'],
            );
            if ($request['user_pass'] != '') {
                $data['user_pass'] = md5(md5($request['user_pass'] . $info['salt']));
            }
            if ($request['second_pass'] != '') {
                $data['second_pass'] = md5(md5($request['second_pass'] . $info['salt']));
            }
            //发送短信
            if ($info['status'] == 1 && $request['status'] == 2) {
                $content = $info['user'] . "你好,您的账号审核通过。";
                note_remind($info['phone'], $content);
            }
            $rel = $this->user->save($data, ['id' => $id]);
            if ($rel) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        }
        $this->assign('info', $info);
        return $this->fetch();
    }
    public function del() {
        $request = request();
        if (!input('?get.id')) {
            $this->error('非法操作');
        }
        $id = input('get.id');
        $info = $this->user->field('id,user,phone')->find($id);
        if (!isset($info)) {
            $this->error('非法操作');
        }
        $rel = $this->user->destroy($id);
        if ($rel) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}