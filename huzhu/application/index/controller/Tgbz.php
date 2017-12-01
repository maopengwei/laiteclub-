<?php
namespace app\index\controller;
use app\common\model\Ppdd;
use app\common\model\Record_pay;
use app\common\model\Record_pdb;
use app\common\model\Tgbz as Tgbzmodel;
use app\common\model\User;
use think\Controller;
use think\Request;

/**
 * 投资控制器
 * 投资排单
 * 打款
 */
class Tgbz extends Base {
    protected $user;
    protected $pdb;
    protected $pay;
    protected $tgbz;
    protected $ppdd;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->pdb = new Record_pdb;
        $this->pay = new Record_pay;
        $this->tgbz = new Tgbzmodel;
        $this->ppdd = new Ppdd;
    }
    /**
     * 投资排单
     * 扣除排单币  记录
     * 更新用户状态为排单
     * 金额为当前num
     *
     * @return [type] [description]
     */
    public function tgbz() {
        $info = $this->user->where('id', session('uid'))->find();
        $where['uid'] = session('uid');
        $where['type'] = 0;
        $count1 = $this->pay->where($where)->count();
        $direct = $this->user->where('pid', session('uid'))->find();
        $last_pay = $this->pay->where($where)->order('id desc')->field('redelivery,date')->find();
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            if (!$direct && $count1 > 6 && $info['six'] == 0) {
                $this->error('您的账号被进入休眠');
            }
            //账号
            if ($info['status'] == 1) {
                $this->error('账号未审核');
            }
            if ($request['num'] == "") {
                $this->error('排单金额不能为空');
            }
            //排单间隔
            $bb = strtotime("-1 week");
            if ($last_pay['date'] > $bb) {$this->error('每隔七天才能排下一单哦！');}
            //二级密码
            $second_pass = md5(md5($request['second_pass'] . $info['salt']));
            if ($second_pass != $info['second_pass']) {$this->error('二级密码不正确');}
            //复投判断
            if ($request['num'] < $last_pay['redelivery']) {$this->error('复投不能少于上次排单额度');} else {
                $redelivery = $request['num'];
            }
            //排单币
            $pdb_num = 1;
            if ($pdb_num > $info['pdb']) {$this->error('排单币不足');}
            //执行
            $data = array(
                'pdb' => $info['pdb'] - $pdb_num,
            );
            $rel1 = $this->user->save($data, ['id' => session('uid')]);
            $this->pdb->data([
                'uid' => session('uid'),
                'num' => $pdb_num,
                'add_time' => time(),
            ]);
            $rel2 = $this->pdb->save();
            $pay_number = GetRandStr(10);
            $this->tgbz->data([
                'uid' => session('uid'),
                'pay_number' => $pay_number,
                'jb' => $request['num'],
                'date' => time(),
            ]);
            $rel3 = $this->tgbz->save();
            $this->pay->data([
                'uid' => session('uid'),
                'pay_number' => $pay_number,
                'date' => time(),
                'jb' => $request['num'],
                'redelivery' => $redelivery,
            ]);
            $rel4 = $this->pay->save();
            if ($rel1 && $rel2 && $rel3 && $rel4) {
                $this->success('投资成功');
            } else {
                $this->error('投资失败');
            }
        }
    }
    /**
     * 打款
     *
     * @return [type] [description]
     */
    public function dakuan() {
        $file = request()->file('img');
        $request = request()->post();

        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $path = "/uploads/" . $info->getSaveName();
        } else {
            $this->error('必须上传打款截图');
        }
        $data = array(
            'message' => $request['message'],
            'pay_time' => time(),
            'pic' => $path,
            'zt' => 2,
        );
        $g_user = $this->ppdd->where('id', $request['id'])->value('g_user');
        $rel = $this->ppdd->save($data, ['id' => $request['id']]);
        if ($rel) {
            $content = '尊敬的会员' . $g_user . '你好,您的收益订单已付款成功,请及时关注后台收款';
            $phone = get_phone($g_user);
            note_remind($phone, $content);
            $this->success('打款成功');
        } else {
            $this->error('打款失败');
        }
    }
    /**
     * 提款
     *
     * @return [type] [description]
     */
    protected function tikuan() {
        $where = array(
            'zt' => 3,
        );
        $list = DB::name('ppdd')->where($where)->select();
        foreach ($list as $k => $v) {
            $jb = $v['jb'] / 2;
            $money = $jb + $jb / 5;
            $uid = DB::name('user')->where('user', $v['p_user'])->value('id');
            if (time() - $v['last_time'] > 0) {
                //给静态二次
                DB::name('user')->where('user', $v['p_user'])->setInc('static_wallet', $money);
                //记录
                $data = array(
                    'uid' => $uid,
                    'jb' => $money,
                    'add_time' => time(),
                    'type' => 2,
                );
                DB::name('userget')->insert($data);
                DB::name("ppdd")->where('id', $v['id'])->setfield('zt', 4);
            } elseif (time() - $v['end_time'] > 0 && $v['status'] == 0) {
                DB::name('user')->where('user', $v['p_user'])->setInc('static_wallet', $money);
                //记录
                $data = array(
                    'uid' => $uid,
                    'jb' => $money,
                    'add_time' => time(),
                    'type' => 1,
                );
                DB::name('userget')->insert($data);
                $result = dynamic_profit($uid, $jb);
                DB::name("ppdd")->where('id', $v['id'])->setfield('status', 1);
            }
        }
    }

}