<?php
namespace app\admin\controller;
use app\common\model\Jsbz;
use app\common\model\Ppdd;
use app\common\model\Tgbz;
use app\common\model\User;
use think\Controller;
use think\DB;

/**
 * 匹配控制器
 */
class Match extends Base {

    protected $user;
    protected $Tgbz;
    protected $Jsbz;
    protected $Ppdd;
    function _initialize() {
        parent::_initialize();
        $this->tgbz = new Tgbz;
        $this->jsbz = new Jsbz;
        $this->ppdd = new Ppdd;
        $this->user = new User;
    }

    public function index() {
        $where['zt'] = 0;
        $where['delete'] = 0;
        $list_tgbz = $this->tgbz->where($where)->select();
        foreach ($list_tgbz as $k => $v) {
            $theme1 = $this->user->where('user', $v['uid'])->field('theme')->find();
            $list_tgbz[$k]['theme'] = $theme1['theme'];
        }
        $list_jsbz = $this->jsbz->where($where)->select();
        foreach ($list_jsbz as $k => $v) {
            $theme2 = $this->user->where('user', $v['uid'])->field('theme')->find();
            $list_jsbz[$k]['theme'] = $theme2['theme'];
        }
        $system = $this->user->where(array('system' => 1))->field('user,id')->select();

        $this->assign(array(
            'list_tgbz' => $list_tgbz,
            'list_jsbz' => $list_jsbz,
            'system' => $system,
        ));
        return $this->fetch();
    }
    public function matchcl() {
        $data = input('post.');
        if (!isset($data['arr1'])) {
            $this->error('不能没有充值单子');
        }
        if (!isset($data['arr2'])) {
            $this->error('不能没有提现单子');
        }
        $arr1 = $data['arr1'];
        $arr2 = $data['arr2'];
        $length1 = count($arr1);
        $length2 = count($arr2);
        $i = 0;
        $j = 0;
        $z = 0;
        $a = 1;
        while ($i < $length1 && $j < $length2 && $z < 20) {
            #不能无休止的进行下去
            $z++;
            $id1 = $arr1[$i][0];
            $id2 = $arr2[$j][0];
            if ($a == 1) {$cha = $arr1[$i][1] - $arr2[$j][1];}
            if ($a == 2) {$cha = $cha - $arr2[$j][1];}
            if ($a == 3) {$cha = $arr1[$i][1] - $cha;}
            switch (true) {
            case $cha == 0:
                $this->match_equal($id1, $id2);
                $i++;
                $j++;
                $a = 1;
                break;
            case $cha > 0:
                $this->match_big($id1, $id2, $cha, $a);
                $j++;
                $a = 2;
                break;
            case $cha < 0:
                $cha = $cha - $cha - $cha;
                $this->match_small($id1, $id2, $cha, $a);
                $i++;
                $a = 3;
                break;
            default:
                break;
            }
        }
        $this->success('匹配成功');
    }
    /**
     * 系统账号匹配
     * @return [type] [description]
     */
    public function match_system() {
        $data = input('post.');
        if (!isset($data['arr1']) && !isset($data['arr2'])) {
            $this->error('您没有提交任何单子');
        }
        $z = 0;
        if (isset($data['arr1'])) {
            $arr1 = $data['arr1'];
            $length1 = count($arr1);
            $i = 0;
            while ($i < $length1 && $z < 10) {
                $z++;
                $id1 = $arr1[$i];
                $this->tgbz_system_match($id1, $data['id']);
                $i++;
            }
        }
        if (isset($data['arr2'])) {
            $arr2 = $data['arr2'];
            $length2 = count($arr2);
            $j = 0;
            while ($j < $length2 && $z < 10) {
                $z++;
                $id2 = $arr2[$j];
                $this->jsbz_system_match($id2, $data['id']);
                $j++;
            }
        }
        $this->success('匹配成功');
    }
//--------------------------------------------匹配逻辑--------------------------------------------------
    /**
     * 等额匹配
     * @param  int $p_id 提供id
     * @param  int $g_id 接受id
     * @return 执行匹配操作
     */
    function match_equal($p_id, $g_id) {
        $tg = $this->tgbz->find($p_id);
        $js = $this->jsbz->find($g_id);
        #相同
        if ($tg['uid'] == $js['uid']) {
            return true;
        }
        #匹配
        $num = GetRandStr(15);
        $data = array(
            'pid' => $tg['id'],
            'gid' => $js['id'],
            'p_id' => $tg['pay_number'],
            'g_id' => $js['receive_number'],
            'p_user' => $tg->uid,
            'g_user' => $js->uid,
            'jb' => $tg['jb'],
            'zt' => '1',
            'add_time' => time(),
            'number' => $num,
        );
        $this->ppdd->save($data);
        $this->tgbz->where(array('id' => $tg['id']))->setInc('zt');
        $this->jsbz->where(array('id' => $js['id']))->setInc('zt');
        //发送手机短信
        $content1 = $tg['uid'] . "你好,您的投资订单已匹配成功,请及时关注后台打款。";
        $phone1 = get_phone($tg['uid']);
        note_remind($phone1, $content1);
        $content2 = $js['uid'] . "你好,您的收益订单已匹配成功,请及时关注后台收款。";
        $phone2 = get_phone($js['uid']);
        note_remind($phone2, $content2);
    }
    /**
     * 大于匹配
     * @param  int $p_id 提供id
     * @param  int $g_id 接受id
     * @return 执行匹配操作
     */
    function match_big($p_id, $g_id, $cha, $a = 1) {
        $tg = $this->tgbz->find($p_id);
        $js = $this->jsbz->find($g_id);
        $uid = DB::name('tgbz')->where('id', $p_id)->value('uid');
        #相同
        if ($tg['uid'] == $js['uid']) {
            return true;
        }
        if ($a == 1 || $a == 2) {$money = $js['jb'];}
        if ($a == 3) {$money = $tg['jb'] - $cha;}
        $num = GetRandStr(15);
        #匹配
        $data = array(
            'pid' => $tg['id'],
            'gid' => $js['id'],
            'p_id' => $tg['pay_number'],
            'g_id' => $js['receive_number'],
            'p_user' => $tg->uid,
            'g_user' => $js->uid,
            'jb' => $money,
            'zt' => '1',
            'add_time' => time(),
            'number' => $num,
        );
        $pd_id = Db::name('ppdd')->insertGetId($data);
        #更新 jsbz tgbz
        $this->jsbz->where(array('id' => $js['id']))->setfield('zt', 1);
        $tgbz_update['jb'] = $tg['jb'] - $money;
        $tgbz_update['status'] = 1;
        $this->tgbz->save($tgbz_update, ['id' => $tg['id']]);
        #添加tgbz
        $datb = array(
            'uid' => $uid,
            'jb' => $money,
            'date' => time(),
            'zt' => 1,
            'pay_number' => $tg['pay_number'],
            'status' => 1,
        );
        $tg_id = Db::name('tgbz')->insertGetId($datb);
        $this->ppdd->where('id', $pd_id)->setfield('pid', $tg_id);
        //发送手机短信
        $content1 = $tg['uid'] . "你好,您的投资订单已匹配成功,请及时关注后台打款。";
        $phone1 = get_phone($tg['uid']);
        note_remind($phone1, $content1);
        $content2 = $js['uid'] . "你好,您的收益订单已匹配成功,请及时关注后台收款。";
        $phone2 = get_phone($js['uid']);
        note_remind($phone2, $content2);
    }
    /**
     * 小于匹配
     * @param  int $p_id 提供id
     * @param  int $g_id 接受id
     * @return 执行匹配操作
     */
    function match_small($p_id, $g_id, $cha, $a = 1) {
        $tg = $this->tgbz->find($p_id);
        $js = $this->jsbz->find($g_id);
        $uid = DB::name('jsbz')->where('id', $g_id)->value('uid');
        #相同
        if ($tg['uid'] == $js['uid']) {
            return true;
        }
        if ($a == 1 || $a == 2) {$money = $tg['jb'];}
        if ($a == 3) {$money = $js['jb'] - $cha;}
        $num = GetRandStr(15);
        #匹配
        $data = array(
            'pid' => $tg['id'],
            'gid' => $js['id'],
            'p_id' => $tg['pay_number'],
            'g_id' => $js['receive_number'],
            'p_user' => $tg->uid,
            'g_user' => $js->uid,
            'jb' => $money,
            'zt' => '1',
            'add_time' => time(),
            'number' => $num,
        );
        $pd_id = Db::name('ppdd')->insertGetId($data);
        #更新 jsbz tgbz
        $this->tgbz->where(array('id' => $tg['id']))->setfield('zt', 1);
        $jsbz_update['jb'] = $js['jb'] - $money;
        $jsbz_update['status'] = 1;
        $this->jsbz->save($jsbz_update, ['id' => $js['id']]);
        #添加jsbz
        $datb = array(
            'uid' => $uid,
            'jb' => $money,
            'date' => time(),
            'zt' => 1,
            'receive_number' => $js['receive_number'],
            'status' => 1,
        );
        $js_id = Db::name('jsbz')->insertGetId($datb);
        $this->ppdd->where('id', $pd_id)->setfield('gid', $js_id);
        //发送手机短信
        $content1 = $tg['uid'] . "你好,您的投资订单已匹配成功,请及时关注后台打款。";
        $phone1 = get_phone($tg['uid']);
        note_remind($phone1, $content1);
        $content2 = $js['uid'] . "你好,您的收益订单已匹配成功,请及时关注后台收款。";
        $phone2 = get_phone($js['uid']);
        note_remind($phone2, $content2);
    }
    /**
     * 提供与系统账户匹配
     * @param  int $id1     提供单号id
     * @param  int $id2     系统账号uid
     * @return 执行匹配操作
     */
    function tgbz_system_match($id1, $id2) {
        $tg = $this->tgbz->find($id1);
        $g_user = $this->user->where('id', $id2)->value('user');
        if ($tg['uid'] == $g_user) {
            return true;
        }
        #添加 jsbz
        $receive_number = GetRandStr(10);
        $data = array(
            'uid' => $id2,
            'jb' => $tg['jb'],
            'date' => time(),
            'receive_number' => $receive_number,
            'zt' => 1,
        );
        $js_id = $this->jsbz->save($data);
        //记录 record_receive
        $datb = array(
            'uid' => $id2,
            'jb' => $tg['jb'],
            'date' => time(),
            'receive_number' => $receive_number,
            'type' => 0,
        );
        DB::name('record_receive')->insert($datb);
        $num = GetRandStr(15);
        #匹配
        $datc = array(
            'pid' => $id1,
            'gid' => $js_id,
            'p_id' => $tg['pay_number'],
            'g_id' => $receive_number,
            'p_user' => $tg['uid'],
            'g_user' => $g_user,
            'jb' => $tg['jb'],
            'add_time' => time(),
            'zt' => 1,
            'number' => $num,
        );
        $this->ppdd->save($datc);
        #更新 tgbz
        $this->tgbz->where(array('id' => $id1))->setfield('zt', 1);
        //发送手机短信
        $content1 = $tg['uid'] . "你好,您的投资订单已匹配成功,请及时关注后台打款。";
        $phone1 = get_phone($tg['uid']);
        note_remind($phone1, $content1);
        return true;
    }
    /**
     * 提现单和系统账号uid
     * @param  [type] $id1 [提现单id]
     * @param  [type] $id2 [系统账号uid]
     * @return [type]      执行匹配操作
     */
    function jsbz_system_match($id1, $id2) {
        $js = $this->jsbz->find($id1);
        $p_user = $this->user->where('id', $id2)->value('user');
        if ($js['uid'] == $p_user) {
            return true;
        }
        #添加 tgbz
        $pay_number = GetRandStr(10);
        $data = array(
            'uid' => $id2,
            'jb' => $js['jb'],
            'date' => time(),
            'pay_number' => $pay_number,
            'zt' => 1,
        );
        $tg_id = $this->tgbz->save($data);
        //记录 record_pay
        $datb = array(
            'uid' => $id2,
            'jb' => $js['jb'],
            'date' => time(),
            'pay_number' => $pay_number,
            'type' => 1,
            'redelivery' => $js['jb'],
        );
        DB::name('record_pay')->insert($datb);
        $num = GetRandStr(15);
        #匹配
        $datc = array(
            'pid' => $tg_id,
            'gid' => $id1,
            'p_id' => $pay_number,
            'g_id' => $js['receive_number'],
            'p_user' => $p_user,
            'g_user' => $js['uid'],
            'jb' => $js['jb'],
            'add_time' => time(),
            'zt' => 1,
            'number' => $num,
        );
        $this->ppdd->save($datc);
        #更新 jsbz
        $this->jsbz->where(array('id' => $id1))->setfield('zt', 1);
        //发送手机短信
        $content2 = $js['uid'] . "你好,您的收益订单已匹配成功,请及时关注后台收款。";
        $phone2 = get_phone($js['uid']);
        note_remind($phone2, $content2);
        return true;
    }

}