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
        'theme' => 'chs',
        'phone' => 'number|length:11',
        'user_pass' => 'alphaNum|min:6|max:16',
        'second_pass' => 'alphaNum|min:6|max:16',
        'card_number' => 'min:16|max:19,number',
        'static_wallet' => 'number',
        'dynamic_wallet' => 'number',
        'pdb' => 'number',
        'jhm' => 'number',
        'num' => 'integer|gt:0',
        'code' => 'captcha',
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
        'pdb' => '排单币',
        'jhm' => '激活码',
        'num' => '数目',
        'code' => '验证码',
    ];

}