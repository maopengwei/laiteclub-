<?php
namespace app\index\controller;
use app\common\model\Message;
use app\common\model\News as Newsmodel;
use think\Controller;
use think\Request;

/**
 * 新闻留言控制器
 * 公告列表 个人信息修改 密码修改
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
        $list = $this->news->paginate(2);
        $count = $this->news->count();
        $this->assign(array(
            'list' => $list,
            'count' => $count,
        ));
        return $this->fetch();
    }
    public function detail() {
        $id = input('get.id');
        $info = $this->news->where('id', $id)->find();
        $this->assign('info', $info);
        return $this->fetch();
    }
    public function relation() {

        if (Request::instance()->isPost()) {
            $file = request()->file('img');
            $request = request()->post();
            $path = '';
            if ($file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                $path = "/uploads/" . $info->getSaveName();
            }
            if ($request['content'] == "") {$this->error(lang('liuyankong'));}
            $this->message->data([
                'add_time' => time(),
                'uid' => session('uid'),
                'content' => $request['content'],
                'title' => $request['title'],
                'img' => $path,
            ]);
            $rel = $this->message->save();
            if ($rel) {
                $this->success(lang('liuyanchenggong'));
            } else {
                $this->error(lang('liuyanshibai'));
            }
        }
        return $this->fetch();
    }
    public function relation_list() {
        $list = $this->message->where('uid', session('uid'))->paginate(10);
        $count = $this->message->where('uid', session('uid'))->count();
        $this->assign(array(
            'list' => $list,
            'count' => $count,
        ));
        return $this->fetch();
    }
}