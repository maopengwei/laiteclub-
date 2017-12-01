<?php
namespace app\index\controller;
use app\common\model\Jsbz;
use app\common\model\Tgbz;
use think\Controller;
use think\Db;

class Index extends Base {
    protected $tgbz;
    protected $jsbz;
    function _initialize() {
        parent::_initialize();
        $this->tgbz = new Tgbz;
        $this->jsbz = new Jsbz;
    }
    public function index() {
        $info = Db('user')->where('id', session('uid'))->find();
        $direct_count = get_direct_count(session('uid'));
        $team_count = get_team_count(session('uid'));
        $url = "http://" . $_SERVER['HTTP_HOST'] . "/index/login/register?id=" . session('uid');
        $url1 = "http://" . $_SERVER['HTTP_HOST'] . "/mobile/login/register?id=" . session('uid');
        $where1 = array(
            'zt' => 0,
            'uid' => session('uid'),
            'delete' => 0,
        );
        $where2 = array(
            'p_user' => session('uname'),
            'zt' => array('in', '1,2,3'),
            'delete' => 0,
        );
        $where3 = array(
            'g_user' => session('uname'),
            'zt' => array('in', '1,2'),
            'delete' => 0,
        );
        $list_tgbz = $this->tgbz->where($where1)->select();
        $list_jsbz = $this->jsbz->where($where1)->select();
        $list_pay = Db('ppdd')->where($where2)->order('zt')->select();
        $list_receive = DB('ppdd')->where($where3)->order('zt')->select();

        $this->assign(array(
            'info' => $info,
            'direct_count' => $direct_count,
            'team_count' => $team_count,
            'url' => $url,
            'url1' => $url1,
            'list_tgbz' => $list_tgbz,
            'list_jsbz' => $list_jsbz,
            'list_pay' => $list_pay,
            'list_receive' => $list_receive,
        ));
        return $this->fetch();
    }
}
