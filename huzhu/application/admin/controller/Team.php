<?php
namespace app\admin\Controller;

use app\common\model\User;
use think\Controller;

/**
 * 团队类
 */
class Team extends Base {
    protected $user;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
    }
    public function index() {
        $user = input('get.user');
        $id = $this->user->where('user', $user)->value('id');
        $list = $this->user->where('pid', $id)->paginate(100);
        $this->assign('list', $list);
        return $this->fetch();
    }
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