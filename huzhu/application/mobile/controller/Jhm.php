<?php
namespace app\mobile\controller;
use app\common\model\Record_jhm;
use app\common\model\User as Usermodel;
use think\Controller;
use think\Request;

/**
 * 激活码控制器
 * 激活码转让记录
 * 激活码转让
 * 激活码激活记录
 */
class Jhm extends Base {
    protected $user;
    function _initialize() {
        parent::_initialize();
        $this->user = new Usermodel;
        $this->jhm = new Record_jhm;
    }
    public function index() {
        $where['uid|uid_two'] = session('uid');
        $list = $this->jhm->where($where)->select();
        $this->assign('list', $list);
        return $this->fetch();
    }
    public function transfer() {
        $info = $this->user->where('id', session('uid'))->find();
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            if ($request['id'] == session('uid')) {$this->error('您不能转让给自己');}
            $second_pass = md5(md5($request['second_pass'] . $info['salt']));
            if ($second_pass != $info['second_pass']) {$this->error('二级密码不正确');}
            $aa = five_team(session('uid'), $request['id']);
            if (!$aa) {
                $this->error('该账号不在我的团队，或超出5代范围!');
            }
            if (!is_numeric($request['num']) || $request['num'] <= 0) {$this->error('请输入正确的数量格式');}
            if ($request['num'] > $info['jhm']) {$this->error('您的激活码数量不足');}
            $rel1 = $this->user->where('id', session("uid"))->setDec('jhm', $request['num']);
            $rel2 = $this->user->where('id', $request['id'])->setInc('jhm', $request['num']);
            $this->jhm->data([
                'uid' => session('uid'),
                'uid_two' => $request['id'],
                'num' => $request['num'],
                'add_time' => time(),
                'type' => 1,
            ]);
            $rel3 = $this->jhm->save();
            if ($rel1 && $rel2 && $rel3) {
                $this->success('转让成功');
            } else {
                $this->error('转让失败');
            }
        }
        return $this->fetch();
    }
    public function theme() {
        $data = Request::instance()->post()['user'];
        $info = $this->user->where('user', $data)->field('theme,id')->find();
        return $info;
    }
}