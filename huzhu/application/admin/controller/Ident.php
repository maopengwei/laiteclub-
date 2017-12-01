<?php
namespace app\admin\controller;
use app\common\model\Jsbz;
use app\common\model\Ppdd;
use app\common\model\Tgbz;
use app\common\model\User;
use think\Controller;
use think\Db;
use think\Request;

/**
 * 已匹配订单控制器
 */
class Ident extends Base {

    protected $user;
    protected $tgbz;
    protected $jsbz;
    protected $ppdd;
    public function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->tgbz = new Tgbz;
        $this->jsbz = new Jsbz;
        $this->ppdd = new Ppdd;
    }
    /**
     * 未打款列表
     * @return [type] [description]
     */
    public function list_weidakuan() {
        $where['delete'] = 0;
        $where['zt'] = 1;
        $where['cold'] = 0;
        #搜索查询条件
        if (input('get.p_id') != "") {
            $where['p_id'] = input('get.p_id');
        }
        if (input('get.p_user') != "") {
            $where['p_user'] = input('get.p_user');
        }
        if (input('get.g_id') != "") {
            $where['g_id'] = input('get.g_id');
        }
        if (input('get.g_user') != "") {
            $where['g_user'] = input('get.g_user');
        }

        if (input('get.first') != "") {
            $xx = strtotime(input('get.first'));
            $where['add_time'] = array('gt', $xx);
        }
        if (input('get.end') != "") {
            $oo = strtotime(input('get.end'));
            $where['add_time'] = array('lt', $oo);
        }
        if (input('get.first') != "" && input('get.end') != "") {
            $xx = strtotime(input('get.first'));
            $oo = strtotime(input('get.end'));
            $where['add_time'] = array('between', array($xx, $oo));
        }
        $list = $this->ppdd->where($where)->order('id desc')->paginate(100);
        $num = $this->ppdd->where($where)->order('id desc')->sum('jb');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    /**
     * 放弃单号
     * 订单删除
     * 充值单提现单状态变为未匹配
     *
     * @return [type] [description]
     */
    public function give_up() {
        $data = input('get.');
        // dump($data);die;
        if (!$data['id']) {
            $this->error('非法操作');
        }
        $pd = $this->ppdd->where(array('id' => $data['id']))->find();
        if (!$pd || $pd['zt'] != 1) {
            $this->error('非法操作');
        }
        $zt['zt'] = 0;
        $rel1 = $this->tgbz->save($zt, ['id' => $pd['pid']]);
        $rel2 = $this->jsbz->save($zt, ['id' => $pd['gid']]);
        $rel3 = $this->ppdd->where(array('id' => $data['id']))->setfield('delete', 1);
        if ($rel1 && $rel2 && $rel3) {
            $this->success('放弃成功，请重新匹配');
        } else {
            $this->error('放弃失败');
        }

    }
    /**
     * 删除单号 删除订单 充值单 提现单
     * @return [type] [description]
     */
    public function del() {
        $data = input('get.');
        if (!$data['id']) {
            $this->error('非法操作');
        }
        $pd = $this->ppdd->where(array('id' => $data['id']))->find();
        if (!$pd || $pd['zt'] != 1) {
            $this->error('非法操作');
        }
        $rel1 = $this->tgbz->where(array('id' => $pd['pid']))->setfield('delete', 1);
        $rel2 = $this->jsbz->where(array('id' => $pd['gid']))->setfield('delete', 1);
        $rel3 = $this->ppdd->where(array('id' => $pd['id']))->setfield('delete', 1);
        if ($rel1 && $rel2 && $rel3) {
            $this->success('删除成功');
        } else {
            $this->error('放弃失败');
        }
    }
    /**
     * 确定打款
     * 打款凭证 留言
     * @return [type] [description]
     */
    public function dakuan() {
        $id = input('get.id');
        if (Request::instance()->isPost()) {
            $request = request()->post();
            $file = request()->file('img');
            if ($file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                $path = "/uploads/" . $info->getSaveName();
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
                $content = $g_user . '你好,您的收益订单已付款成功,请及时关注后台收款';
                $phone = get_phone($g_user);
                note_remind($phone, $content);
                $this->success('打款成功');
            } else {
                $this->error('打款失败');
            }
        }
        $this->assign('id', $id);
        return $this->fetch();
    }
    /**
     * 未收款列表
     * @return [type] [description]
     */
    public function list_weishoukuan() {
        $where['delete'] = 0;
        $where['ts_zt'] = 0;
        $where['cold'] = 0;
        $where['zt'] = 2;
        #封装搜索条件
        if (input('get.p_id') != "") {
            $where['p_id'] = input('get.p_id');
        }
        if (input('get.p_user') != "") {
            $where['p_user'] = input('get.p_user');
        }
        if (input('get.g_id') != "") {
            $where['g_id'] = input('get.g_id');
        }
        if (input('get.g_user') != "") {
            $where['g_user'] = input('get.g_user');
        }
        if (input('get.first') != "") {
            $xx = strtotime(input('get.first'));
            $where['pay_time'] = array('gt', $xx);
        }
        if (input('get.end') != "") {
            $oo = strtotime(input('get.end'));
            $where['pay_time'] = array('lt', $oo);
        }
        if (input('get.first') != "" && input('get.end') != "") {
            $xx = strtotime(input('get.first'));
            $oo = strtotime(input('get.end'));
            $where['pay_time'] = array('between', array($xx, $oo));
        }
        $list = $this->ppdd->where($where)->order('id desc')->paginate(100);
        // dump($list);die;
        $num = $this->ppdd->where($where)->order('id desc')->sum('jb');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    /**
     *确定收款
     * @return [type] [description]
     */
    public function shoukuan() {
        $request = request()->get();
        if ($request['id'] == "") {
            $this->error('非法操作');
        }
        $id = $request['id'];
        $info = $this->ppdd->where(array('id' => $id))->find();
        if (!$info && $info['zt'] != 2) {
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
                $this->user->where('user', $info['p_user'])->setInc('awart_wallet', 150);
                $this->userget->data([
                    'uid' => $p_user_id,
                    'jb' => 150,
                    'add_time' => time(),
                    'type' => 6,
                ]);
                $this->userget->save();
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
    /**
     * 交易完成
     * @return [type] [description]
     */
    public function list_yiwancheng() {
        $where['delete'] = 0;
        $where['zt'] = array('in', ('3,4'));
        #封装搜索条件
        if (input('get.p_id') != "") {
            $where['p_id'] = input('get.p_id');
        }
        if (input('get.p_user') != "") {
            $where['p_user'] = input('get.p_user');
        }
        if (input('get.g_id') != "") {
            $where['g_id'] = input('get.g_id');
        }
        if (input('get.g_user') != "") {
            $where['g_user'] = input('get.g_user');
        }
        if (input('get.first') != "") {
            $xx = strtotime(input('get.first'));
            $where['receive_time'] = array('gt', $xx);
        }
        if (input('get.end') != "") {
            $oo = strtotime(input('get.end'));
            $where['receive_time'] = array('lt', $oo);
        }
        if (input('get.first') != "" && input('get.end') != "") {
            $xx = strtotime(input('get.first'));
            $oo = strtotime(input('get.end'));
            $where['receive_time'] = array('between', array($xx, $oo));
        }
        if (input('get.zt') != "") {
            $where['zt'] = input('get.zt');
        }
        $list = $this->ppdd->where($where)->order('id desc')->paginate(100);
        $num = $this->ppdd->where($where)->order('id desc')->sum('jb');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    /**
     * 投诉
     * @return [type] [description]
     */
    public function list_complain() {
        $where['delete'] = 0;
        $where['ts_zt'] = 1;
        $where['zt'] = 2;
        #封装搜索条件
        if (input('get.p_id') != "") {
            $where['p_id'] = input('get.p_id');
        }
        if (input('get.p_user') != "") {
            $where['p_user'] = input('get.p_user');
        }
        if (input('get.g_id') != "") {
            $where['g_id'] = input('get.g_id');
        }
        if (input('get.g_user') != "") {
            $where['g_user'] = input('get.g_user');
        }
        if (input('get.first') != "") {
            $xx = strtotime(input('get.first'));
            $where['pay_time'] = array('gt', $xx);
        }
        if (input('get.end') != "") {
            $oo = strtotime(input('get.end'));
            $where['pay_time'] = array('lt', $oo);
        }
        if (input('get.first') != "" && input('get.end') != "") {
            $xx = strtotime(input('get.first'));
            $oo = strtotime(input('get.end'));
            $where['pay_time'] = array('between', array($xx, $oo));
        }
        $list = $this->ppdd->where($where)->order('id desc')->paginate(100);
        $num = $this->ppdd->where($where)->order('id desc')->sum('jb');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    /**
     * 超时不打款
     * @return [type] [description]
     */
    public function over_dakuan() {
        $where = array(
            'delete' => 0,
            'zt' => 1,
            'cold' => 1,
        );
        #封装搜索条件
        if (input('get.p_id') != "") {
            $where['p_id'] = input('get.p_id');
        }
        if (input('get.p_user') != "") {
            $where['p_user'] = input('get.p_user');
        }
        if (input('get.g_id') != "") {
            $where['g_id'] = input('get.g_id');
        }
        if (input('get.g_user') != "") {
            $where['g_user'] = input('get.g_user');
        }
        if (input('get.first') != "") {
            $xx = strtotime(input('get.first'));
            $where['pay_time'] = array('gt', $xx);
        }
        if (input('get.end') != "") {
            $oo = strtotime(input('get.end'));
            $where['pay_time'] = array('lt', $oo);
        }
        if (input('get.first') != "" && input('get.end') != "") {
            $xx = strtotime(input('get.first'));
            $oo = strtotime(input('get.end'));
            $where['pay_time'] = array('between', array($xx, $oo));
        }
        $list = $this->ppdd->where($where)->order('id desc')->paginate(100);
        $num = $this->ppdd->where($where)->order('id desc')->sum('jb');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
    /**
     * 超时不打款处理
     * 提现单删除
     * 充值单回归未匹配状态
     * 订单删除
     * @return [type] [description]
     */
    public function over_dakuancl() {
        $data = input('get.');
        if (!$data['id']) {
            $this->error('非法操作');
        }
        $pd = $this->ppdd->where(array('id' => $data['id']))->find();
        if (!$pd || $pd['zt'] != 1) {
            $this->error('非法操作');
        }
        $rel1 = $this->tgbz->where(array('id' => $pd['pid']))->setfield('delete', 1);
        $rel3 = $this->ppdd->where(array('id' => $pd['id']))->setfield('delete', 1);
        $rel2 = $this->jsbz->where(array('id' => $pd['gid']))->setfield('zt', 0);
        if ($rel1 && $rel2 && $rel3) {
            $this->success('处理成功');
        } else {
            $this->error('处理失败');
        }
    }
    /**
     * 超时不收款
     * @return [type] [description]
     */
    public function over_shoukuan() {
        $where['delete'] = 0;
        $where['cold'] = 2;
        $where = array(
            'delete' => 0,
            'cold' => 2,
            'zt' => 2,
        );
        #封装搜索条件
        if (input('get.p_id') != "") {
            $where['p_id'] = input('get.p_id');
        }
        if (input('get.p_user') != "") {
            $where['p_user'] = input('get.p_user');
        }
        if (input('get.g_id') != "") {
            $where['g_id'] = input('get.g_id');
        }
        if (input('get.g_user') != "") {
            $where['g_user'] = input('get.g_user');
        }
        if (input('get.first') != "") {
            $xx = strtotime(input('get.first'));
            $where['pay_time'] = array('gt', $xx);
        }
        if (input('get.end') != "") {
            $oo = strtotime(input('get.end'));
            $where['pay_time'] = array('lt', $oo);
        }
        if (input('get.first') != "" && input('get.end') != "") {
            $xx = strtotime(input('get.first'));
            $oo = strtotime(input('get.end'));
            $where['pay_time'] = array('between', array($xx, $oo));
        }
        $list = $this->ppdd->where($where)->order('id desc')->paginate(100);
        $num = $this->ppdd->where($where)->order('id desc')->sum('jb');
        $this->assign(array(
            'list' => $list,
            'num' => $num,
        ));
        return $this->fetch();
    }
}