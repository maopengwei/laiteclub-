<?php
namespace app\admin\Controller;
use app\common\model\Record_pdb;
use app\common\model\User;
use think\Controller;
use think\Request;

/**
 * 激活码控制器
 */
class Pdb extends Base {
    protected $user;
    protected $pdb;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->pdb = new Record_pdb;
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
        $list = $this->pdb->where($where)->order('id desc')->paginate(100);
        $num = $this->pdb->where($where)->sum('num');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    public function add() {
        if (input('get.user') != "") {
            $map['user'] = input('get.user');
            $info = $this->user->where($map)->field('user,theme,pdb,id')->find();
            $this->assign('info', $info);
        }
        if (Request::instance()->isPost()) {
            $request = request()->post();
            //num 必须是大于0的整数数字
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            //增加pdb 并记录
            $rel1 = $this->user->where('id', $request['id'])->setInc('pdb', $request['num']);
            $this->pdb->data([
                'uid' => 0,
                'uid_two' => $request['id'],
                'type' => 2,
                'add_time' => time(),
                'num' => $request['num'],
            ]);
            $rel2 = $this->pdb->save();
            if ($rel1 && $rel2) {
                $this->success('赠送成功');
            } else {
                $this->error('转让失败');
            }
        }
        return $this->fetch();
    }
}