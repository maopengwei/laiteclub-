<?php
namespace app\mobile\controller;
use app\common\model\User;
use think\Controller;
use think\DB;
use think\Request;

/**
 * 我的团队
 */
class Team extends Base {
    protected $user;
    function __construct() {
        parent::__construct();
        $this->user = new User;
    }
    /**
     * 直推列表加激活操作
     * @return [type] [description]
     */
    public function active() {
        $list = User::where('pid', session('uid'))->select();
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $status = User::where('id', $request['id'])->field('status,id')->find();
            if ($status['status'] != 0) {
                $this->error('该用户状态不是未激活');
            }
            $info = User::where('id', session('uid'))->field('jhm,salt,second_pass')->find();
            if (md5(md5($request['second_pass'] . $info['salt'])) != $info['second_pass']) {$this->error('二级密码不正确');}
            if ($info['jhm'] < 1) {$this->error('您的激活码不足');}
            //激活操作
            $data['status'] = 1;
            $rel = $this->user->save($data, ['id' => $request['id']]);
            if ($rel) {
                $this->user->where('id', session('uid'))->setDec('jhm');
                $datc = array(
                    'uid' => session('uid'),
                    'uid_two' => $status['id'],
                    'num' => 1,
                    'add_time' => time(),
                );
                DB('record_jhm')->insert($datc);
                $this->success('激活成功');
            } else {
                $this->error('激活失败');
            }
        }
        $this->assign('list', $list);
        return $this->fetch();
    }
    /**
     * 我的直推列表
     * @return [type] [description]
     */
    public function direct() {
        $list = User::where('pid', session('uid'))->select();
        $this->assign('list', $list);
        return $this->fetch();
    }
    /**
     * 我的团队
     * @return [type] [description]
     */
    public function team() {
        return $this->fetch();
    }

    /**
     * 封装团队数据
     * @return [type] [description]
     */
    public function gettreeso() {
        $user = input('post.user');
        $info = User::where('user', $user)->field('id,path,pid,user,theme')->find();
        if ($info == "") {
            $this->error('该账户不存在');
        }
        $yeji = get_team_yeji($info['id']);
        $base = array(
            'id' => $info['id'],
            'pId' => $info['pid'],
            'name' => $info['user'] . "," . $info['theme'] . "," . $yeji,
        );
        $znote[] = $base;
        $path['path'] = array('like', $info['path'] . "," . $info['id'] . "%");
        $list = DB('user')->where($path)->field('id,pid,user,theme')->select();
        foreach ($list as $k => $v) {
            $yeji = get_team_yeji($v['id']);
            $base = array(
                'id' => $v['id'],
                'pId' => $v['pid'],
                'name' => $v['user'] . "," . $v['theme'] . "," . $yeji,
            );
            $znote[] = $base;
        }
        echo json_encode(array("status" => 0, "data" => $znote));
    }
}