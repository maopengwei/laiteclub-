<?php
namespace app\admin\Controller;
use app\common\model\Tgbz as Tgbzmodel;
use app\common\model\User;
use think\Controller;
use think\Db;

/**
 * 充值单控制器
 */
class Tgbz extends Base {
    protected $user;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->tgbz = new Tgbzmodel;
    }
    /**
     * 充值单列表
     * @return [type] [description]
     */
    public function index() {
        $request = request()->param();
        $where['delete'] = 0;
        $where['zt'] = 0;
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $where['uid'] = $this->user->where($map)->value('id');
        }
        if (input('get.pay_number') != "") {
            $where['pay_number'] = $request['pay_number'];
        }
        if (input('get.zt') != "") {
            $where['zt'] = $request['zt'];
        }
        if (input('get.first') != "") {
            $xx = strtotime($request['first']);
            $where['date'] = array('gt', $xx);
        }
        if (input('get.end') != "") {
            $oo = strtotime($request['end']);
            $where['date'] = array('lt', $oo);
        }
        if (input('get.first') != "" && input('get.end') != "") {
            $xx = strtotime($request['first']);
            $oo = strtotime($request['end']);
            $where['date'] = array('between', array($xx, $oo));
        }
        $list = $this->tgbz->where($where)->paginate(100);
        $num = $this->tgbz->where($where)->sum('jb');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    /**
     * 提现单手动匹配充值单
     * @return [type] [description]
     */
    public function sdpp() {
        $request = request()->param();
        $where['zt'] = 0;
        $where['delete'] = 0;
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $where['uid'] = $this->user->where($map)->value('id');
        }
        if (input('get.pay_number') != "") {
            $where['pay_number'] = $request['pay_number'];
        }
        $list = $this->tgbz->where($where)->paginate(100);
        $this->assign(array(
            'list' => $list,
            'jine' => $request['jine'],
        ));
        return $this->fetch();
    }
    /**
     * 充值单手动拆分
     */
    public function split() {
        $request = request()->param();
        $where['delete'] = 0;
        $where['zt'] = 0;
        if (input('get.user') != "") {
            $map['user'] = $request['user'];
            $where['uid'] = $this->user->where($map)->value('id');
        }
        if (input('get.pay_number') != "") {
            $where['pay_number'] = $request['pay_number'];
        }
        if (input('get.zt') != "") {
            $where['zt'] = $request['zt'];
        }
        if (input('get.first') != "") {
            $xx = strtotime($request['first']);
            $where['date'] = array('gt', $xx);
        }
        if (input('get.end') != "") {
            $oo = strtotime($request['end']);
            $where['date'] = array('lt', $oo);
        }
        if (input('get.first') != "" && input('get.end') != "") {
            $xx = strtotime($request['first']);
            $oo = strtotime($request['end']);
            $where['date'] = array('between', array($xx, $oo));
        }
        $list = $this->tgbz->where($where)->paginate(100);
        $num = $this->tgbz->where($where)->sum('jb');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    /**
     * 拆分提交
     * 生成新单号 金额为和
     * 删除原单号
     * @return [type] [description]
     */
    public function splitcl() {
        $request = request()->param();
        $info = DB::name('tgbz')->where(array('id' => $request['pid']))->find();
        if (!preg_match('/^[0-9,]{1,100}$/', $request['arrid'])) {
            $this->error('格式不对!');
        }
        $arr = explode(',', $request['arrid']);
        if (array_sum($arr) != $info['jb']) {
            $this->error('拆分金额不对!');
        }
        $pipeits = 0;
        foreach ($arr as $value) {
            if ($value != '') {
                $data = array(
                    'uid' => $info['uid'],
                    'jb' => $value,
                    'pay_number' => $info['pay_number'],
                    'date' => $info['date'],
                    'status' => 1,
                );
                Db('tgbz')->insert($data);
                $pipeits++;
            }
        }
        $this->tgbz->where(array('id' => $request['pid']))->setField('delete', 1);
        $this->success('拆分成' . $pipeits . '条订单成功!');
    }
    /**
     * 删除单号
     * @return [type] [description]
     */
    public function del() {
        $id = input('get.id');
        $rel = Db::name('tgbz')->where(array('id' => $id))->setField('delete', 1);
        if ($rel) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}