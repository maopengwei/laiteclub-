<?php
namespace app\common\validate;

use think\Validate;

/**
 * 添加管理员验证器
 */
class Verify extends Validate {
    protected $rule = [
        'admin' => 'min:4|max:16|alphaNum',
        'admin_pass' => 'alphaNum|min:6|max:16',
        'user' => 'alphaNum|min:4|max:16',
        'phone' => 'regex:/^[1][34578][0-9]{9}$/',
        'user_pass' => 'alphaNum|min:6|max:16',
        'second_pass' => 'alphaNum|min:6|max:16',
        'card_number' => 'min:16|max:19,number',
        'static_wallet' => 'number',
        'dynamic_wallet' => 'number',
        'num' => 'number|gt:0',
        'code' => 'captcha',
        'email' => 'email',
        'identity' => 'alphaNum|length:18'
    ];
    protected $field = [
        'admin' => '管理员',
        'admin_pass' => '管理员登录密码',
        'user' => '用户名',
        'theme' => '真实姓名',
        'phone' => '手机号',
        'user_pass' => '用户登录密码',
        'second_pass' => '用户二级密码',
        'phone' => '手机号',
        'card_number' => '银行卡号',
        'static_wallet' => '静态钱包金额',
        'dynamic_wallet' => '动态钱包金额',
        'num' => '数目',
        'code' => '验证码',
        'email' => '邮箱',
    ];
    protected $message = [
        'phone.regex' => '请填写正确的手机号',
    ];

}