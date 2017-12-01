<?php
namespace app\mobile\controller;
use app\common\model\Jsbz as jsbzmodel;
use app\common\model\Ppdd;
use app\common\model\Record_receive;
use app\common\model\User;
use app\common\model\Userget;
use think\Controller;
use think\Db;
use think\Request;

/**
 * 收益控制器
 * 收益
 * 提现
 */
class Jsbz extends Base {
    protected $user;
    protected $receive;
    protected $jsbz;
    protected $ppdd;
    protected $userget;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->userget = new Userget;
        $this->receive = new Record_receive;
        $this->jsbz = new jsbzmodel;
        $this->ppdd = new Ppdd;
    }
    /**
     * 收益排单
     * 每日一单 二级密码 钱包类别
     * user 扣除钱包
     * 增加提现
     * 增加提现记录
     *
     * @return [type] [description]
     */
    public function jsbz() {
        $info = $this->user->where('id', session('uid'))->find();
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $where['uid'] = session('uid');
            $where['date'] = array('between', array(strtotime(date("y-m-d")), strtotime(date("y-m-d")) + 86400));
            //每日一单
            $today_jsbz = $this->receive->where($where)->find();
            if ($today_jsbz) {
                $this->error('今日您已经提过现金了,请明日再来！');
            }
            //二级密码
            $second_pass = md5(md5($request['second_pass'] . $info['salt']));
            if ($second_pass != $info['second_pass']) {$this->error('二级密码不正确');}
            //钱包
            if ($request['wallet'] == 1) {
                if ($request['num'] < 100 || $request['num'] % 100 != 0) {$this->error('静态钱包提现金额为100整倍数!');}
                if ($info['static_wallet'] < $request['num']) {$this->error('您的静态钱包余额不足！');}
                $data = array(
                    'static_wallet' => $info['static_wallet'] - $request['num'],
                );
                $rel1 = $this->user->save($data, ['id' => session('uid')]);
            } elseif ($request['wallet'] == 2) {
                if ($request['num'] < 500 || $request['num'] % 500 != 0) {$this->error('奖励钱包提现金额为500整倍数!');}
                if ($info['awart_wallet'] < $request['num']) {$this->error('您的奖励钱包余额不足！');}
                $data = array(
                    'awart_wallet' => $info['awart_wallet'] - $request['num'],
                );
                $rel1 = $this->user->save($data, ['id' => session('uid')]);
            } elseif ($request['wallet'] == 3) {
                if ($request['num'] < 500 || $request['num'] % 500 != 0) {$this->error('动态钱包提现金额为500整倍数!');}
                if ($info['dynamic_wallet'] < $request['num']) {$this->error('您的动态钱包余额不足！');}
                $data = array(
                    'dynamic_wallet' => $info['dynamic_wallet'] - $request['num'],
                );
                $rel1 = $this->user->save($data, ['id' => session('uid')]);
            }
            $receive_number = GetRandStr(10);
            $this->jsbz->data([
                'uid' => session('uid'),
                'receive_number' => $receive_number,
                'jb' => $request['num'],
                'date' => time(),
            ]);
            $rel2 = $this->jsbz->save();
            $this->receive->data([
                'uid' => session('uid'),
                'receive_number' => $receive_number,
                'date' => time(),
                'jb' => $request['num'],
                'type' => $request['wallet'],
            ]);
            $rel3 = $this->receive->save();
            if ($rel1 && $rel2 && $rel3) {
                $this->success('收益成功');
            } else {
                $this->error('收益失败');
            }
        }
    }
    /**
     * 收款
     * 打款人
     * 更新总排单
     * 第一次 变有效会员 上家有效直推加1
     * 2小时内打款的话获得奖金150 并记录
     * 给上家动态收益
     * 记录给上家动态收益
     * 收款人
     * 更新总提现
     * 诚信值加一
     * 更新订单状态
     * @return [type] [description]
     */
    public function receive() {
        $request = request()->get();
        if ($request['id'] == "") {
            $this->error('非法操作');
        }
        $id = $request['id'];
        $info = $this->ppdd->where(array('id' => $id))->find();
        if (!$info || $info['zt'] != 2) {
            $this->error('非法操作');
        }
        $data = array(
            'receive_time' => time(),
            'end_time' => time() + 86400 * 4,
            'last_time' => time() + 86400 * 5,
            'zt' => 3,
        );
        $rel = $this->ppdd->save($data, ['id' => $request['id']]);
        if ($rel) {
            //打款会员
            $p_user_id = $this->user->where('user', $info['p_user'])->value('id');
            $zt['zt'] = array('between', '3,4');
            $zt['p_user'] = $info['p_user'];
            $count = DB::name('ppdd')->where($zt)->count();
            if ($count == 1) {
                User::where('id', $p_user_id)->setfield('vaild', 1);
                $pid = $this->user->where('id', $p_user_id)->value('pid');
                User::where('id', $pid)->setInc('vaild_count');
            }
            $this->user->where('user', $info['p_user'])->setInc('tgbz_performance', $info['jb']);

            //是否2小时内打款
            if ($info['pay_time'] - $info['add_time'] < 7200) {
                $time = time() - 86400 * 5;
                $map['add_time'] = array('gt', $time);
                $map['uid'] = $p_user_id;
                $map['type'] = 6;
                $gain = $this->userget->where($map)->find();
                if (!$gain) {
                    $this->user->where('user', $info['p_user'])->setInc('awart_wallet', 150);
                    $this->userget->data([
                        'uid' => $p_user_id,
                        'jb' => 150,
                        'add_time' => time(),
                        'type' => 6,
                    ]);
                    $this->userget->save();
                }
            }

            //收款会员
            $this->user->where('user', $info['g_user'])->setInc('jsbz_performance', $info['jb']);
            $this->user->where('user', $info['g_user'])->setInc('value');
            //上家动态奖
            $result = dynamic_profit($p_user_id, $info['jb']);
            $this->success('收款成功');
        } else {
            $this->error('收款失败');
        }
    }
    public function complain() {
        $request = request()->get();
        if ($request['id'] == "") {
            $this->error('非法操作');
        }
        $info = $this->ppdd->where('id', $request['id'])->find();
        if (!$info || $info['zt'] != 2) {
            $this->error('非法操作');
        }
        if ($info['ts_zt'] == 1) {
            $this->error('您已经投诉过了');
        }
        $rel = $this->ppdd->where('id', $request['id'])->setfield('ts_zt', 1);
        if ($rel) {
            $this->success('投诉成功');
        } else {
            $this->error('投诉失败');
        }
    }
}