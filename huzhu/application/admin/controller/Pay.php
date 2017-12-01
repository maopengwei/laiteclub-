<?php
namespace app\admin\Controller;
use app\common\model\Record_pay;
use app\common\model\Tgbz;
use app\common\model\User;
use think\Controller;
use think\Request;

/**
 * 激活码控制器
 */
class Pay extends Base {
    protected $user;
    protected $pay;
    protected $tgbz;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->pay = new Record_pay;
        $this->tgbz = new Tgbz;
    }
    public function index() {
        $request = request()->param();
        $where = '';
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $where['uid'] = $this->user->where($map)->value('id');
        }
        if (input('get.type') != "") {
            $where['type'] = $request['type'];
        }
        if (input('get.pay_number') != "") {
            $where['pay_number'] = $request['pay_number'];
        }
        $list = $this->pay->where($where)->order('id desc')->paginate(100);
        $num = $this->pay->where($where)->sum('jb');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    public function add() {
        if (input('get.user') != "") {
            $map['user'] = input('get.user');
            $info = $this->user->where($map)->field('user,theme,id')->find();
            $this->assign('info', $info);
        }
        if (Request::instance()->isPost()) {
            $request = request()->post();
            //num 必须是大于0的整数数字
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $pay_number = GetRandStr(10);
            $this->tgbz->data([
                'uid' => $request['id'],
                'pay_number' => $pay_number,
                'jb' => $request['num'],
                'date' => time(),
            ]);
            $rel1 = $this->tgbz->save();
            $this->pay->data([
                'uid' => $request['id'],
                'pay_number' => $pay_number,
                'type' => 1,
                'date' => time(),
                'jb' => $request['num'],
            ]);
            $rel2 = $this->pay->save();
            if ($rel1 && $rel2) {
                $this->success('赠送成功');
            } else {
                $this->error('赠送失败');
            }
        }
        return $this->fetch();
    }
}