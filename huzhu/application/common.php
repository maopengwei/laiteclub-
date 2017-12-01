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
 * 动态收益
 *第一代：奖励打款额的6%，需完成直推2个账户。
 *第二代：奖励打款额的1%，需完成直推5个账户。
 *第三代：奖励打款额的3％，需完成直推10个账户。
 * 烧伤
 * 分给商城积分动态收益 2:8
 * @param  [type] $id    [当前人的id]
 * @param  [type] $money [金额]
 * @return [type]        [description]
 */
function dynamic_profit($id, $money) {
    $pid1 = DB::name('user')->where('id', $id)->value('pid');
    if ($pid1) {
        $info1 = DB::name('user')->where('id', $pid1)->field('id,pid,vaild_count')->find();
        if ($info1 && $info1['vaild_count'] > 1) {
            //烧伤
            $redelivery1 = DB::name('record_pay')->where('uid', $info1['id'])->order('id desc')->value('redelivery') / 2;
            if ($money > $redelivery1) {
                $jb1 = $redelivery1 * 6 / 100;
            } else {
                $jb1 = $money * 6 / 100;
            }
            //奖励并记录
            if ($jb1 > 0) {
                $dynamic1 = $jb1 * 8 / 10;
                $data1 = array(
                    'uid' => $info1['id'],
                    'jb' => $dynamic1,
                    'add_time' => time(),
                    'type' => 3,
                );
                DB::name('userget')->insert($data1);
                DB::name('user')->where('id', $info1['id'])->setInc('dynamic_wallet', $dynamic1);
                $shop1 = $jb1 * 2 / 10;
                $data2 = array(
                    'uid' => $info1['id'],
                    'jb' => $shop1,
                    'add_time' => time(),
                    'type' => 7,
                );
                DB::name('userget')->insert($data2);
                DB::name('user')->where('id', $info1['id'])->setInc('shop_wallet', $shop1);
            }
        }
        if ($info1['pid']) {
            $info2 = DB::name('user')->where('id', $info1['pid'])->field('id,pid,vaild_count')->find();
            if ($info2 && $info2['vaild_count'] > 5) {
                //烧伤
                $redelivery2 = DB::name('record_pay')->where('uid', $info2['id'])->order('id desc')->value('redelivery') / 2;
                if ($money > $redelivery2) {
                    $jb2 = $redelivery2 * 6 / 100;
                } else {
                    $jb2 = $money * 6 / 100;
                }
                if ($jb2 > 0) {
                    $dynamic2 = $jb2 * 8 / 10;
                    $datb1 = array(
                        'uid' => $info2['id'],
                        'jb' => $dynamic2,
                        'add_time' => time(),
                        'type' => 4,
                    );
                    DB::name('userget')->insert($datb1);
                    DB::name('user')->where('id', $info1['id'])->setInc('dynamic_wallet', $dynamic2);
                    $shop2 = $jb * 2 / 10;
                    $datb2 = array(
                        'uid' => $info1['id'],
                        'jb' => $shop2,
                        'add_time' => time(),
                        'type' => 4,
                    );
                    DB::name('userget')->insert($datb2);
                    DB::name('user')->where('id', $info2['id'])->setInc('shop_wallet', $shop);
                }
            }
            if ($info2['pid']) {
                $info3 = DB::name('user')->where('id', $info2['pid'])->field('id,pid,vaild_count')->find();
                if ($info3 && $info3['vaild_count'] > 10) {
                    //烧伤
                    $redelivery3 = DB::name('record_pay')->where('uid', $info3['id'])->order('id desc')->value('redelivery') / 2;
                    if ($money > $redelivery3) {
                        $jb3 = $redelivery3 * 3 / 100;
                    } else {
                        $jb3 = $money * 3 / 100;
                    }
                    if ($jb3 > 0) {
                        $dynamic3 = $jb * 8 / 10;
                        $datc1 = array(
                            'uid' => $info3['id'],
                            'jb' => $dynamic3,
                            'add_time' => time(),
                            'type' => 3,
                        );
                        DB::name('userget')->insert($datc1);
                        DB::name('user')->where('id', $info3['id'])->setInc('dynamic_wallet', $dynamic3);
                        $shop3 = $jb3 * 2 / 10;
                        $datc2 = array(
                            'uid' => $info3['id'],
                            'jb' => $shop3,
                            'add_time' => time(),
                            'type' => 3,
                        );
                        DB::name('userget')->insert($datc2);
                        DB::name('user')->where('id', $info3['id'])->setInc('shop_wallet', $shop3);
                    }
                }
            }
            return true;
        }

    }
}

/**
 * 团圆联盟
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
    $content = '【团圆联盟】尊敬的会员' . $content;
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
 * @param  [type] $id [用户id]
 * @return [type]     [description]
 */
function get_team_count($id) {
    $info = DB::name('user')->where('id', $id)->find();
    $data = array(
        'path' => array('like', $info['path'] . "," . $info['id'] . "%"),
        'status' => array('neq', 0),
    );
    return $count = DB::name('user')->where($data)->count();
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
 * * 五代内
 * 转让激活码 和 排单币
 * @param  [type] $id1 [发起人id]
 * @param  [type] $id2 [接受人id ]
 * @return [type]      [description]
 */
function five_team($id1, $id2) {
    $path1 = DB::name('user')->where('id', $id1)->value('path');
    $path2 = DB::name('user')->where('id', $id2)->value('path');
    $rel = strpos($path2, $path1);
    if ($rel !== false) {
        $arr1 = explode(',', $path1);
        $arr2 = explode(',', $path2);
        $a = count($arr2) - count($arr1);
        if ($a <= 5) {
            return true;
        }
        return false;
    } else {
        return false;
    }
}
/**
 * 判断是否是手机登录
 * 是 返回true
 * 否 返回false
 * @return boolean [description]
 */
function is_mobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    //return true;
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }

    //此条摘自TPM智能切换模板引擎，适合TPM开发
    if (isset($_SERVER['HTTP_CLIENT']) && 'PhoneClient' == $_SERVER['HTTP_CLIENT']) {
        return true;
    }

    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset($_SERVER['HTTP_VIA']))
    //找不到为flase,否则为true
    {
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
    }

    //判断手机发送的客户端标志,兼容性有待提高
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile',
        );
        //从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}