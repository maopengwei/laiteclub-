<?php
namespace app\index\controller;
use app\common\model\Detail;
use app\common\model\User;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

/**
 * 我的团队控制器
 */
class Team extends Base {
    protected $user;
    protected $detail;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->detail = new Detail;
    }
    public function direct() {
        $list = User::where('pid', session('uid'))->select();
        $count = User::where('pid', session('uid'))->count();
        $this->assign(array(
            'list' => $list,
            'count' => $count,
        ));
        return $this->fetch();
    }
    public function register() {
        $list = User::where('zid', session('uid'))->select();
        $count = User::where('zid', session('uid'))->count();
        $this->assign(array(
            'list' => $list,
            'count' => $count,
        ));
        return $this->fetch();
    }

    public function team() {
        $count = get_team_count(session('uid'));
        $this->assign('count', $count);
        return $this->fetch();
    }
    /**
     * 封装团队数据
     * @return [type] [description]
     */
    public function gettreeso() {
        $info = User::where('id', session('uid'))->field('id,path,pid,user,theme')->find();
        $base = array(
            'id' => $info['id'],
            'pId' => $info['pid'],
            'name' => $info['user'] . "," . $info['theme'],
        );
        $znote[] = $base;
        $path['path'] = array('like', $info['path'] . "," . $info['id'] . "%");
        $list = DB('user')->where($path)->field('id,pid,user,theme')->select();
        foreach ($list as $k => $v) {
            $base = array(
                'id' => $v['id'],
                'pId' => $v['pid'],
                'name' => $v['user'] . "," . $v['theme'],
            );
            $znote[] = $base;
        }
        echo json_encode(array("status" => 0, "data" => $znote));
    }
    public function theme() {
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $info = Db::name('user')->where('user', $request['user'])->field('id,theme')->find();
            return $info;
        }
    }
}