<?php
use think\Config;
use think\DB;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 生成一段随机字符串
 * @param int $len 几位数
 */
function GetRandStr($len) {
    $chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9",
    );
    $charsLen = count($chars) - 1;
    shuffle($chars);
    $output = "";
    for ($i = 0; $i < $len; $i++) {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;
}

function first_dakuan($id) {
    DB::name('user')->where('id', $id)->setfield('vaild', 1);
    $pid = $this->user->where('id', $id)->value('pid');
    DB::name('user')->where('id', $pid)->setInc('vaild_count');
}

/**
 *
 * @param  [type] $mobile  [手机号]
 * @param  [type] $content [内容]
 * @return [type]          [description]
 */
function note_remind($mobile, $content) {
    $userid = '';
    $account = Config::get('smsaccount');
    $password = Config::get('smspassword');
    $password = md5($password);
    $password = ucfirst($password);
    $content = '【莱特俱乐部】尊敬的会员' . $content;
    $gateway = "http://114.113.154.5/sms.aspx?action=send&userid={$userid}&account={$account}&password={$password}&mobile={$mobile}&content={$content}&sendTime=";
    $result = file_get_contents($gateway);
    $xml = simplexml_load_string($result);
    return $xml;
}
/**
 * 获取手机号
 * @param  [type] $user [用户名]
 * @return [type]       [description]
 */
function get_phone($user) {
    $phone = DB::name('user')->where('user', $user)->value('phone');
    return $phone;
}
/**
 * 获取直推人数
 * @param  [type] $id [用户id]
 * @return [type]     [description]
 */
function get_direct_count($id) {
    $data = array(
        'pid' => $id,
        'status' => array('neq', 0),
    );
    return $count = DB::name('user')->where($data)->count();
}
/**
 * 获取团队人数
 * @param  [type]  $id [description]
 * @param  integer $n  [多少代内 默认0表示所有下级人数]
 * @return [type]      [下级人数]
 */
function get_team_count($id,$n=0) {
    $info = DB::name('user')->where('id', $id)->find();
    $array = explode(',',$info['path']);
    $length = count($array);
    $data = array(
        'path' => array('like', $info['path'] . "," . $info['id'] . "%"),
        'status' => array('neq', 0),
    );
    if($n==0){
        $i = DB::name('user')->where($data)->count();
    }else{
        $list = DB::name('user')->where($data)->select();
        $i = 0;
        foreach ($list as $k => $v) {
          $arr = explode(',',$v['path']);
          $count = count($arr);
          if($count<=$n+$length){
            $i++;
          }
        }
    }
    return $i;    
}
/**
 * 获取团队业绩
 * @param  [type] $id [用户id]
 * @return [type]     [description]
 */
function get_team_yeji($id) {
    $info = DB::name('user')->where('id', $id)->find();
    $data = array(
        'path' => array('like', $info['path'] . "," . $info['id'] . "%"),
    );
    $yeji = 0;
    $yeji += DB::name('user')->where('id', $id)->value('tgbz_performance');
    $yeji += DB::name('user')->where($data)->sum('tgbz_performance');
    return $yeji;
}
/**
 * *
 * 我的团队
 * @param  [type] $id1 [头id]
 * @param  [type] $id2 [子id ]
 * @return [type]      [description]
 */
function in_team($id1, $id2) {
    $path1 = DB::name('user')->where('id', $id1)->value('path');
    $path2 = DB::name('user')->where('id', $id2)->value('path');
    $rel = strpos($path2, $path1);
    if ($rel !== false) {
        return true;
    } else {
        return false;
    }
}
/**
 * 直推奖 15% 1.5莱特比
 * @param  [type] $id [新人id]
 * @return [type]      [description]
 */
function zhitui_profit($id) {
    $pid = Db::name('user')->where('id', $id)->value('pid');
    if($pid){
        Db::name('detail')->where('uid',$pid)->setInc('litecoin_wallet',1.5);
        $data = array(
            'uid' => $pid,
            'uid_two' => $id,
            'num' => 1.5,
            'add_time' => time(),
            'type' => 0,
        );
        Db::name('litecoin_profit')->insert($data);
    }
}
/**
 * 注册奖报单奖 10% 1莱特币
 * @param  [type] $id [新人id]
 * @return [type]     [description]
 */
function register_profit($id){
    $zid = Db::name('user')->where('id', $id)->value('zid');
    if($zid){
        Db::name('detail')->where('uid',$zid)->setInc('litecoin_wallet',1);
        $data = array(
            'uid' => $zid,
            'uid_two' => $id,
            'num' => 1.5,
            'add_time' => time(),
            'type' => 1,
        );
        Db::name('litecoin_profit')->insert($data);
    }
}