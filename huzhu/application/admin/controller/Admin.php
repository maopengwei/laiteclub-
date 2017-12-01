<?php
namespace app\admin\Controller;

use app\common\model\Admin as Adminmodel;
use think\Controller;
use think\Request;

/**
 * 管理员
 */
class Admin extends Base {

    protected $admin;
    function _initialize() {
        parent::_initialize();
        $this->admin = new Adminmodel;
    }
    /**
     * 管理员
     * @return [type] [description]
     */
    public function index() {
        $request = request()->param();
        $where = '';
        if (input('get.admin')) {
            $where['admin'] = $request['admin'];
        }
        if (input('get.group')) {
            $where['group'] = $request['group'];
        }
        $list = $this->admin->where($where)->field('id,admin,group,add_time')->paginate(20);
        $this->assign('list', $list);
        return $this->fetch();
    }
    /**
     * 添加修改
     */
    public function add() {
        if (input('?get.id')) {
            $id = input('get.id');
            $info = $this->admin->field('id,admin,group')->find($id);
            $this->assign('info', $info);
        }
        return $this->fetch();
    }
    /**
     * 添加修改提交
     */
    public function addcl() {
        $request = request()->param();
        //判断不为空
        if ($request['admin'] == "") {$this->error('管理员名不能为空');}
        if ($request['group'] == "") {$this->error('管理员分组不能为空');}
        // 验证器
        $validate = validate('Verify');
        if (!$validate->check($request)) {
            $this->error($validate->getError());
        }
        $data = array(
            'group' => $request['group'],
            'admin' => $request['admin'],
        );

        if ($request['id'] != '') {
            $info = $this->admin->where('id', $request['id'])->find();
            if ($request['admin_pass'] != '') {
                $data['admin_pass'] = md5(md5($request['admin_pass'] . $info['salt']));
            }
            $info = '修改';
            $rel = $this->admin->save($data, ['id' => $request['id']]);
        } else {
            if ($request['admin_pass'] == "") {$this->error('登录密码不能为空');}
            $data['add_time'] = time();
            $salt = GetRandStr(4);
            $data['admin_pass'] = md5(md5($request['admin_pass'] . $salt));
            $data['salt'] = $salt;
            $info = '添加';
            $rel = $this->admin->save($data);
        }
        if ($rel) {
            $this->success($info . '成功');
        } else {
            $this->error($info . '失败');
        }
    }
    /**
     * 删除管理员
     * @return [type] [description]
     */
    public function del() {
        $request = request();
        if (!input('?get.id')) {
            $this->error('非法操作');
        }
        $id = input('get.id');
        $info = $this->admin->field('id,admin,group')->find($id);
        if (!isset($info)) {
            $this->error('非法操作');
        }
        $rel = $this->admin->destroy($id);
        if ($rel) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}