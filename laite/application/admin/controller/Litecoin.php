<?php
namespace app\admin\Controller;
use app\common\model\Detail;
use app\common\model\Litecoin_record;
use app\common\model\Litecoin_return;
use app\common\model\Litecoin_profit;
use app\common\model\Litecoin_cash;
use app\common\model\User;
use think\Controller;
use think\Request;

/**
 * 赠送转让激活
 */
class Litecoin extends Base {
    protected $user;
    protected $litecoin;
    protected $detail;
    protected $getback;
    protected $profit;
    /**
     * 初始化
     * @return [type] [description]
     */
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->detail = new Detail;
        $this->litecoin = new Litecoin_record;
        $this->getback = new Litecoin_return;
        $this->profit = new Litecoin_profit;
        $this->cash = new Litecoin_cash;
    }
    /**
     * 赠送转让激活 记录
     * @return [type] [description]
     */
    public function index() {
        $request = request()->param();
        $where = '';
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $id = $this->user->where($map)->value('id');
            $where['uid|uid_two'] = $id;
        }
        if (input('get.type') != "") {
            $where['type'] = $request['type'];
        }
        $list = $this->litecoin->where($where)->paginate(10);
        $num = $this->litecoin->where($where)->sum('num');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    /**
     * 系统赠送莱特币
     */
    public function add() {
        if (input('get.user') != "") {
            $map['user'] = input('get.user');
            $info = $this->user->where($map)->field('user,theme,id')->find();
            $this->assign('info', $info);
        }
        if (Request::instance()->isPost()) {
            $request = request()->post();

            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $rel1 = $this->user->detail()->where('uid', $request['id'])->setInc('litecoin_wallet', $request['num']);
            $this->litecoin->data([
                'uid' => 0,
                'uid_two' => $request['id'],
                'type' => 0,
                'add_time' => time(),
                'num' => $request['num'],
            ]);
            $rel2 = $this->litecoin->save();
            if ($rel1 && $rel2) {
                $this->success('赠送成功');
            } else {
                $this->error('转让失败');
            }
        }
        return $this->fetch();
    }
    /**
     * 每日返现记录
     * @return [type] [description]
     */
    public function return_list(){
        $request = request()->param();
        $where = '';
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $id = $this->user->where($map)->value('id');
            $where['uid|uid_two'] = $id;
        }
        if (input('get.type') != "") {
            $where['type'] = $request['type'];
        }
        $list = $this->getback->where($where)->paginate(10);
        $count = $this->getback->where($where)->count();
        $this->assign(array(
            'list' => $list,
            'count' => $count,
        ));
        return $this->fetch();
    }
    /**
     * 领导奖励记录
     * 直推
     * 注册
     * 下级9代
     * @return [type] [description]
     */
    public function leader(){
         $request = request()->param();
        $where = '';
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $id = $this->user->where($map)->value('id');
            $where['uid|uid_two'] = $id;
        }
        if (input('get.type') != "") {
            $where['type'] = $request['type'];
        }
        $list = $this->profit->where($where)->paginate(10);
        $num = $this->profit->where($where)->sum('num');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    /**
     * 提现充值记录 审核
     * @return [type] [description]
     */
    public function cash(){
        $request = request()->param();
        $where = '';
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $id = $this->user->where($map)->value('id');
            $where['uid'] = $id;
        }
        if (input('get.status') != "") {
            $where['status'] = $request['status'];
        }
        $list = $this->cash->where($where)->paginate(10);
        $num = $this->cash->where($where)->sum('num');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
}