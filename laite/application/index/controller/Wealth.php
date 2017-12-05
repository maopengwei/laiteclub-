<?php
namespace app\index\Controller;
use app\common\model\Detail;
use app\common\model\Litecoin_cash;
use app\common\model\Litecoin_profit;
use app\common\model\Litecoin_record;
use app\common\model\Litecoin_return;
use app\common\model\User;
use think\Controller;
use think\Db;
use think\Request;

/**
 * 赠送转让激活
 */
class Wealth extends Base {
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
    public function transfer() {
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            halt($request);
        }
        return $this->fetch();
    }
    /**
     * 赠送转让激活 记录
     * @return [type] [description]
     */
    public function index() {
        $request = request()->param();
        $where['uid|uid_two'] = session('uid');
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $id = $this->user->where($map)->value('id');
            $where['uid|uid_two'] = $id;
        }
        if (input('get.type') != "") {
            $where['type'] = $request['type'];
        }
        $list = $this->litecoin->where($where)->order('id desc')->paginate(20);
        $count = $this->litecoin->where($where)->count('num');
        $this->assign(array(
            'list' => $list,
            'count' => $count,
        ));
        return $this->fetch();
    }
    /**
     * 每日返现记录
     * @return [type] [description]
     */
    public function return_list() {
        $request = request()->param();
        $where['uid'] = session('uid');
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
    public function leader() {
        $request = request()->param();
        $where['uid'] = session("uid");
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $id = $this->user->where($map)->value('id');
            $where['uid'] = $id;
        }
        if (input('get.type') != "") {
            $where['type'] = $request['type'];
        }
        $list = $this->profit->where($where)->order('id desc')->paginate(15);
        $count = $this->profit->where($where)->count();
        $this->assign(array(
            'list' => $list,
            'count' => $count,
        ));
        return $this->fetch();
    }
    public function cash() {
        $system = Db::name('system')->where('id', 1)->field('gathering_address,service_charge')->find();
        $detail = Db::name('detail')->where('uid', session('uid'))->field('withdraw_address,litecoin_wallet')->find();
        $this->assign(array(
            'system' => $system,
            'detail' => $detail,
        ));
        return $this->fetch();
    }
    public function chongzhi() {
        $request = Request::instance()->post();
        if ($request['num'] == "") {$this->error(lang('chongzhikong'));}
        if ($request['user_info'] == "") {$this->error(lang('yonghuxinxikong'));}
        if ($request['second_pass'] == "") {$this->error(lang('anquankong'));}

        $info = User::where('id', session('uid'))->find();
        if (md5(md5($request['second_pass'] . $info['salt'])) != $info['second_pass']) {$this->error(lang('anquanwrong'));}

        $validate = validate('Verify');
        if (!$validate->check($request)) {
            $this->error($validate->getError());
        }
        $data = array(
            'uid' => session('uid'),
            'user_info' => $request['user_info'],
            'gathering_address' => $request['gathering_addresss'],
            'num' => $request['num'],
            'add_time' => time(),
            'type' => 1,
            'status' => 0,
        );
        $rel = $this->cash->save($data);
        if ($rel) {
            $this->success(lang('chongzhichenggong'));
        } else {
            $this->error(lang('chongzhishibai'));
        }
    }
    public function tixian() {
        $request = Request::instance()->post();
        // if(date('w')==6 || date('w')==7){
        //     $this->error('周末不能提现！');
        // }
        if ($request['num'] == "") {$this->error(lang('tixiankong'));}
        if ($request['withdraw_address'] == "") {$this->error(lang('tixiandizhikong'));}
        if ($request['second_pass'] == "") {$this->error(lang('anquankong')}
        $validate = validate('Verify');
        if (!$validate->check($request)) {
            $this->error($validate->getError());
        }
        $info = User::where('id', session('uid'))->find();
        if (md5(md5($request['second_pass'] . $info['salt'])) != $info['second_pass']) {$this->error(lang('anquanwrong'));}
        if ($request['num'] < 0.5) {$this->error(lang('zuidijine'));}
        if ($request['num'] > $request['litecoin_wallet']) {$this->error(lang('laitebuzu'));}

        $data = array(
            'uid' => session('uid'),
            'gathering_address' => $request['withdraw_address'],
            'num' => $request['num'],
            'add_time' => time(),
            'type' => 2,
            'status' => 0,
        );
        $rel1 = $this->cash->save($data);
        $rel2 = $this->detail->where('uid', session('uid'))->setDec('litecoin_wallet', $request['num']);
        if ($rel1 && $rel2) {
            $this->success(lang('tixianchenggong'));
        } else {
            $this->error(lang('tixianshibai'));
        }
    }
    /**
     * 提现充值记录 审核
     * @return [type] [description]
     */
    public function cash_list() {
        $request = request()->param();
        $where['uid'] = session('uid');
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $id = $this->user->where($map)->value('id');
            $where['uid'] = $id;
        }
        if (input('get.status') != "") {
            $where['status'] = $request['status'];
        }
        $list = $this->cash->where($where)->paginate(15);
        $count = $this->cash->where($where)->count();
        $this->assign(array(
            'list' => $list,
            'count' => $count,
        ));
        return $this->fetch();
    }
}