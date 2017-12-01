<?php
namespace app\admin\Controller;
use app\common\model\Jsbz;
use app\common\model\Record_receive;
use app\common\model\User;
use think\Controller;
use think\Request;

/**
 * 激活码控制器
 */
class Receive extends Base {
    protected $user;
    protected $receive;
    protected $jsbz;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->receive = new Record_receive;
        $this->jsbz = new Jsbz;
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
        if (input('get.receive_number') != "") {
            $where['receive_number'] = $request['receive_number'];
        }
        $list = $this->receive->where($where)->order('id desc')->paginate(100);
        $num = $this->receive->where($where)->sum('jb');
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
            $receive_number = GetRandStr(10);
            $this->jsbz->data([
                'uid' => $request['id'],
                'receive_number' => $receive_number,
                'jb' => $request['num'],
                'date' => time(),
            ]);
            $rel1 = $this->jsbz->save();
            $this->receive->data([
                'uid' => $request['id'],
                'receive_number' => $receive_number,
                'type' => 0,
                'date' => time(),
                'jb' => $request['num'],
            ]);
            $rel2 = $this->receive->save();
            if ($rel1 && $rel2) {
                $this->success('赠送成功');
            } else {
                $this->error('赠送失败');
            }
        }
        return $this->fetch();
    }
}