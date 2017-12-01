<?php
namespace app\mobile\controller;
use app\common\model\Message;
use app\common\model\News as Newsmodel;
use think\Controller;
use think\Db;
use think\Request;

/**
 * 用户控制器
 * 注册会员 个人信息修改 密码修改
 */
class News extends Base {
    protected $news;
    protected $message;
    function _initialize() {
        parent::_initialize();
        $this->news = new Newsmodel;
        $this->message = new Message;
    }
    public function index() {
        $list = $this->news->paginate(100);
        $this->assign('list', $list);
        return $this->fetch();
    }
    public function detail() {
        $id = input('get.id');
        $info = $this->news->where('id', $id)->find();
        $this->assign('info', $info);
        return $this->fetch();
    }
    public function relation() {
        $info = Db('user')->where('id', session('uid'))->field('user,phone')->find();
        // dump($info);die;
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            if ($request['content'] == "") {$this->error('留言内容不能为空');}
            $this->message->data([
                'add_time' => time(),
                'user' => $request['user'],
                'content' => $request['content'],
                'phone' => $request['phone'],
            ]);
            $rel = $this->message->save();
            if ($rel) {
                $this->success('留言成功');
            } else {
                $this->error('留言失败');
            }
        }
        $this->assign('info', $info);
        return $this->fetch();
    }
}