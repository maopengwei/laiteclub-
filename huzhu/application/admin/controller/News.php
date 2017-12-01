<?php
namespace app\admin\Controller;
use app\common\model\Message;
use app\common\model\News as Newsmodel;
use think\Controller;
use think\Request;

/**
 * 新闻控制器
 */
Class News extends Base {
    protected $news;
    protected $message;
    function __construct() {
        parent::__construct();
        $this->news = new Newsmodel;
        $this->message = new Message;

    }
    /**
     * 新闻列表
     * @return [type] [description]
     */
    public function index() {
        $data = input('get.user');
        $where = [];
        if ($data != "") {
            $where['title'] = $data;
        }
        $list = $this->news->where($where)->paginate(100);
        $this->assign('list', $list);
        return $this->fetch();
    }
    /**
     * 新闻添加
     */
    public function add() {
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $data = array(
                'title' => $request['title'],
                'content' => $request['content'][0],
                'add_time' => time(),
            );
            $rel = $this->news->save($data);
            if ($rel) {
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        }
        return $this->fetch();
    }
    /**
     * 新闻修改
     * @return [type] [description]
     */
    public function edit() {
        $id = input('get.id');
        $info = $this->news->where('id', $id)->find();
        if (Request::instance()->isPost()) {
            $request = Request::instance()->post();
            $data = array(
                'title' => $request['title'],
                'content' => $request['content'][0],
            );
            $rel = $this->news->save($data, ['id' => $id]);
            if ($rel) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        }
        $this->assign('info', $info);
        return $this->fetch();
    }
    /**
     * 删除新闻
     */
    public function del_news() {
        $id = input('get.id');
        $rel = $this->news->destroy($id);
        if ($rel) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
    /**
     * 留言列表
     */
    public function relation() {
        $data = input('get.user');
        $where = [];
        if ($data != "") {
            $where['user'] = $data;
        }
        $list = $this->message->where($where)->paginate(100);
        $this->assign('list', $list);
        return $this->fetch();
    }
    /**
     * 删除留言
     */
    public function del() {
        $id = input('get.id');
        $rel = $this->message->destroy($id);
        if ($rel) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

}