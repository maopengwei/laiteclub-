<?php
namespace app\admin\Controller;

use app\common\model\Detail;
use app\common\model\User as Usermodel;
use think\Controller;
use think\Request;
use think\Db;

/**
 * 用户控制器
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
        $list = $this->user->where($where)->paginate(20);
        $this->assign('list', $list);
        return $this->fetch();
    }
    /**
     * 用户添加 提交
     */
    public function add() {
        if (Request::instance()->isPost()) {
            $request = request()->post();
            // dump($request);die;
            //判断不为空
            if ($request['user'] == "") {$this->error('用户名不能为空');}
            if ($request['phone'] == "") {$this->error('手机号不能为空');}
            if ($request['theme'] == "") {$this->error('真实姓名不能为空');}
            if ($request['email'] == "") {$this->error('邮箱号不能为空');}
            if ($request['user_pass'] == "") {$this->error('登录密码不能为空');}
            if ($request['second_pass'] == "") {$this->error('二级密码不能为空');}
            //验证器
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            // die;
            $zid = $this->user->where('user', $request['zname'])->value('id');
            //推荐人
            $parent = $this->user->where(array('user' => $request['pname']))->field('id,path')->find();
            if ($parent != '') {
                $pid = $parent['id'];
                $path = $parent['path'] . ',' . $parent['id'];
            } else {
                $pid = 0;
                $path = 0;
            }
            $salt = GetRandStr(4);
            $this->user->data([
                'zid' => $zid,
                'pid' => $pid,
                'user' => $request['user'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'theme' => $request['theme'],
                'add_time' => time(),
                'salt' => $salt,
                'user_pass' => md5(md5($request['user_pass'] . $salt)),
                'second_pass' => md5(md5($request['second_pass'] . $salt)),
                'path' => $path,
            ]);
            $rel = $this->user->save();
            $user_id = $this->user->id;
            $rel2 = $this->user->detail()->save(['uid' => $rel]);
            if ($rel && $rel2) {
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
                'email' => $request['email'],
                'theme' => $request['theme'],
                'status' => $request['status'],
                'level' => $request['level'],
            );
            $datb = array(
                'litecoin_wallet' => $request['litecoin_wallet'],
                'aftercoin_wallet' => $request['aftercoin_wallet'],
                'ico_wallet' => $request['ico_wallet'],
                'stock_wallet' => $request['stock_wallet'],
                'withdraw_address' => $request['withdraw_address'],
            );
            if ($request['user_pass'] != '') {
                $data['user_pass'] = md5(md5($request['user_pass'] . $info['salt']));
            }
            if ($request['second_pass'] != '') {
                $data['second_pass'] = md5(md5($request['second_pass'] . $info['salt']));
            }
            $rel1 = $this->user->save($data, ['id' => $id]);
            $rel2 = $this->detail->save($datb, ['uid' => $id]);
            if ($rel1 || $rel2) {
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
    public function active() {
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            if ($request['id'] == "") {$this->error('非法操作');}
            $info = $this->user->where('id', $request['id'])->find();
            if ($info['status'] != 0) {
                $this->error('该用户状态不是未激活');
            }
            if($info->detail->litecoin_wallet<10){
                $this->error('该账户莱特币不足10');
            }
            //激活操作
            $data = array(
                'uid' => 0,
                'uid_two' => $request['id'],
                'num' => 10,
                'type' => 2,
                'add_time' => time(),
            );
            $litecoin_wallet = $info->detail->litecoin_wallet-10;
            $rel1 = Db::name('user')->where('id',$request['id'])->setfield('status',1);
            $rel2 = Db::name('detail')->where('uid',$request['id'])->setfield('litecoin_wallet',$litecoin_wallet);
            $rel3 = Db::name('litecoin_record')->insert($data);
            if ($rel1 && $rel2 && $rel3) {
                zhitui_profit($request['id']);//推荐奖
                register_profit($request['id']); //报单奖
                $this->success('激活成功');
            } else {
                $this->error('激活失败');
            }
        }
    }
}