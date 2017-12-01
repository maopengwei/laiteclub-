<?php
namespace app\admin\Controller;
use app\common\model\Admin;
use think\Config;
use think\Controller;
use think\Request;
use think\Session;

/**
 * 管理员登录控制器
 */
class Login extends Controller {

    protected $admin;

    public function __construct() {
        parent::__construct();
        $this->admin = new Admin;
    }
    /**
     * 登录页面加登录信息提交
     * @return [type] [description]
     */
    public function index() {
        if (Request::instance()->isPost()) {
            $request = request()->post();
            //判断不为空
            if ($request['admin'] == "") {$this->error('管理员名不能为空');}
            if ($request['admin_pass'] == "") {$this->error('登录密码不能为空');}
            //验证器
            $validate = validate('Verify');
            if (!$validate->check($request)) {
                $this->error($validate->getError());
            }
            $info = Admin::where('admin', $request['admin'])->field('id,admin,salt')->find();
            if ($info == '') {
                $this->error('用户账号有误，或不存在');
            }
            $admin_pass = md5(md5($request['admin_pass'] . $info->salt));
            $infp = Admin::where(array('admin' => $request['admin'], 'admin_pass' => $admin_pass))->value('id');
            if ($infp == "") {
                $this->error('密码错误');
            }
            Session::set('mname', $request['admin']);
            Session::set('mid', $info['id']);
            Session::set('login_time', time());
            $this->success('登录成功', '/admin/index/main');
        }
        return $this->fetch();
    }
    /**
     * 登出 清除缓存
     */
    public function logout() {
        Session::delete('mname');
        Session::delete('mid');
        Session::delete('login_time');
        $this->success('退出成功', '/admin/login/index');
    }
    /**
     * 发送短信验证码
     * @return [type] [description]
     */
    public function sendSMS() {
        $mobile = input('get.mobile');
        $random = mt_rand(1000, 9999);
        $content = "您的验证码为：" . $random;
        session('note_code', '1234');
        session('code_time', time());
        // $data = $this->note_code($mobile, $content);
        // return $data;
        return $data = array(
            'status' => 'success',
            'msg' => '短信已发送',
        );
    }
    protected function note_code($mobile, $content) {
        header('Content-Type:text/html;charset=utf8');
        $userid = '';
        $account = Config::get('smsaccount');
        $password = Config::get('smspassword');
        $password = md5($password);
        $password = ucfirst($password);
        $content = '【团圆联盟】尊敬的会员你好,' . $content;
        $gateway = "http://114.113.154.5/sms.aspx?action=send&userid={$userid}&account={$account}&password={$password}&mobile={$mobile}&content={$content}&sendTime=";
        $result = file_get_contents($gateway);
        $xml = simplexml_load_string($result);
        if ($xml->returnstatus == 'Faild') {
            return array(
                'status' => 'failed',
                'msg' => '系统错误,发送失败',
            );
        }
        return array(
            'status' => 'success',
            'msg' => '短信已发送',
        );
    }
}