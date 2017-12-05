<?php
namespace app\index\controller;
use app\common\model\News;
use app\common\model\User;
use think\Controller;

class Index extends Base {
    protected $user;
    protected $news;
    function _initialize() {
        parent::_initialize();
        $this->user = new User;
        $this->news = new News;
    }
    //用户中心
    public function index() {
        $info = $this->user->where('id', session('uid'))->find();
        $list = $this->news->paginate(2);
        $count = $this->news->count();
        $this->assign(array(
            'info' => $info,
            'list' => $list,
            'count' => $count,
        ));
        return $this->fetch();
    }
}
