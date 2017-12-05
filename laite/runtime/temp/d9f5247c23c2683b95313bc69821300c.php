<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\phpStudy\WWW\laite\public/../application/index\view\login\register.html";i:1512354784;}*/ ?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo \think\Lang::get('laitejulebu'); ?>|<?php echo \think\Lang::get('zhuce'); ?></title>
    
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/login/css/default.css">
    
    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/login/css/styles.css">
    <!--[if IE]>
        <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <![endif]-->
    <style>
        body .login{
            height: 600px;
            padding: 50px 40px 40px 40px;
        }
        .send-code{
                position: absolute;
                top: 5px;
                right: 30px;
                width: 80px;
                height: 26px;
                font-size: 11px;
                color: #DC6180;
                text-align: center;
                line-height: 26px;
                border-radius: 20px;
                font-family: "微软雅黑";
                border:2px solid #DC6180;
                cursor:pointer;
        }
        .send-code:hover{
            background: #DC6180;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="forget">
        
    </div>
    <div class="bgimg">
        <img src="__STATIC__/index/login/img/bgimg.png" />
    </div>
    <div class='login'>
      <div class='login_title'>
        <img src="__STATIC__/index/login/img/title.png" />
      </div>
      <div class='login_fields' >
        <div class='login_fields__user'>
        <form class="register">

          <div class='icon'>
            <img src='__STATIC__/index/login/img/user_icon_copy.png' style="margin-left: 3px;">
          </div>
          <input placeholder='<?php echo \think\Lang::get('yonghuming'); ?>' name="user" type='text'>
            <div class='validation'>
              <img src='__STATIC__/index/login/img/tick.png'>
            </div>
            <div class="user-title" style="position: absolute;z-index: 100;right: 40px;bottom: -28px;color: #ddd;font-size:12px;color:#ddd">
                <span style="color: #aaa"> -- <?php echo \think\Lang::get('tuijianren'); ?>ID</span> 
            </div>
          </input>
        </div>
         <div class='login_fields__password'>
          <div class='icon'>
            <img src='__STATIC__/index/login/img/gopeople.png' style="width: 16px;height: 18px;">
          </div>
          <input value="<?php echo $info['user']; ?>" type='text' disabled>
          <input name="pid" value="<?php echo $info['id']; ?>" type='hidden'>
          <div class='validation'>
            <img src='__STATIC__/index/login/img/tick.png'>
          </div>
          
        </div>
        <div class='login_fields__password'>
          <div class='icon'>
            <img src='__STATIC__/index/login/img/phone.png' style="width: 17px;height: 20px;">
          </div>
          <input placeholder='<?php echo \think\Lang::get('shoujihao'); ?>' name="phone" type='text'>
          <div class='validation'>
            <img src='__STATIC__/index/login/img/tick.png'>
          </div>
        </div>

        <div class='login_fields__password'>
          <div class='icon'>
            <img src='__STATIC__/index/login/img/emile.png' style="width: 16px;height: 18px;">
          </div>
          <input placeholder='<?php echo \think\Lang::get('huiyuanxingming'); ?>' name="theme" type='text'>
          <div class='validation'>
            <img src='__STATIC__/index/login/img/tick.png'>
          </div>
        </div>

        <div class='login_fields__password'>
          <div class='icon'>
            <img src='__STATIC__/index/login/img/emile.png' style="width: 16px;height: 18px;">
          </div>
          <input placeholder='<?php echo \think\Lang::get('shenfenzheng'); ?>/<?php echo \think\Lang::get('huzhao'); ?>' name="identity" type='text'>
          <div class='validation'>
            <img src='__STATIC__/index/login/img/tick.png'>
          </div>
        </div>
        <div class='login_fields__password'>
          <div class='icon'>
            <img src='__STATIC__/index/login/img/emile.png' style="width: 16px;height: 18px;">
          </div>
          <input placeholder='<?php echo \think\Lang::get('dianziyouxiang'); ?>' name="email" type='text'>
          <div class='validation'>
            <img src='__STATIC__/index/login/img/tick.png'>
          </div>
        </div>
       
        <div class='login_fields__password'>
          <div class='icon'>
            <img src='__STATIC__/index/login/img/lock_icon_copy.png' style="margin-left: 3px;">
          </div>
          <input placeholder='<?php echo \think\Lang::get('denglumima'); ?>' name="user_pass" type='password'>
          <div class='validation'>
            <img src='__STATIC__/index/login/img/tick.png'>
          </div>
        </div>
        <div class='login_fields__password'>
          <div class='icon'>
            <img src='__STATIC__/index/login/img/lock_icon_copy.png' style="margin-left: 3px;">
          </div>
          <input placeholder='<?php echo \think\Lang::get('queren'); ?><?php echo \think\Lang::get('denglumima'); ?>' name="pass1" type='password'>
          <div class='validation'>
            <img src='__STATIC__/index/login/img/tick.png'>
          </div>
        </div>
        <div class='login_fields__password'>
          <div class='icon'>
            <img src='__STATIC__/index/login/img/lock_icon_copy.png' style="margin-left: 3px;">
          </div>
          <input placeholder='<?php echo \think\Lang::get('anquanmima'); ?>' name="second_pass" type='password'>
          <div class='validation'>
            <img src='__STATIC__/index/login/img/tick.png'>
          </div>
        </div>
        <div class='login_fields__password'>
          <div class='icon'>
            <img src='__STATIC__/index/login/img/lock_icon_copy.png' style="margin-left: 3px;">
          </div>
          <input placeholder='<?php echo \think\Lang::get('queren'); ?><?php echo \think\Lang::get('anquanmima'); ?>' name="pass2" type='password'>
          <div class='validation'>
            <img src='__STATIC__/index/login/img/tick.png'>
          </div>
        </div>
        <div class='login_fields__password'>
          <div class='icon'>
            <img src='__STATIC__/index/login/img/code.png' style="width: 18px;height: 20px;">
          </div>
          <input placeholder='<?php echo \think\Lang::get('yanzhengma'); ?>' name="note_code" type='text'>
          <div class="send-code huoqu"   onclick="gain()"><?php echo \think\Lang::get('fasongyanzhengma'); ?></div>
          <div class='validation'>
            <img src='__STATIC__/index/login/img/tick.png'>
          </div>

        </div>
        <div class='login_fields__submit'>
          <input type='submit' onclick="return register()" value='<?php echo \think\Lang::get('zhuce'); ?>'>
        </div>
        </form>
      </div>
      <div class='disclaimer'>
        <p>
             <b><?php echo \think\Lang::get('banbenhao'); ?></b> 1.1.0<strong>&copy; 2014-2017 <a href="#"><?php echo \think\Lang::get('laitejulebu'); ?></a>.</strong>
        </p>
      </div>
    </div>
    <div class='authent'>
    </div>
    
    <script type="text/javascript" src='__STATIC__/index/login/js/stopExecutionOnTimeout.js?t=1'></script>
    <script type="text/javascript" src="__STATIC__/index/login/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="__STATIC__/mine/layer/layer.js"></script>
    <script type="text/javascript" src="__STATIC__/index/login/js/jquery-ui.min.js"></script>
    <script>
    //获取验证码
        function gain() {
            $('.huoqu').removeAttr('onclick');
            var data = $('input[name="phone"]').val();
            requestAuthcode($('.huoqu'), data);
        }
        //发送手机短信验证码
        function requestAuthcode(obj, aug) {
            $.get("/index/login/sendSMS/?mobile=" + aug, function(data) {
                layer.msg(data.msg);
                if (data['status'] == 'failed') {
                    $(".huoqu").attr('onclick', 'gain()');
                } else {
                    countDown(obj, 60, '<?php echo \think\Lang::get('fasongyanzhengma'); ?>', '<?php echo \think\Lang::get('miaohouhuoqu'); ?>');
                }
            },"json");
        }
        //验证码60秒递减
        function countDown(obj, sec, oritxt, info) {
            if (sec == 0) {
                obj.text(oritxt);
                obj.attr('onClick', 'gain()');
            } else {
                obj.text(sec + info);
                sec--;
                setTimeout(function() {
                    countDown(obj, sec, oritxt, info);
                }, 1000);
            }
        }
        //注册提交
        function register(){
            console.log(12);
            $('#chongzhi').removeAttr('onclick');
            $.ajax({
                type:"post",
                url:"<?php echo url('register'); ?>",
                data:$('.register').serialize(),
                success:function(data){
                    console.log(data);
                    layer.msg(data.msg);
                    if(data.code){
                        setTimeout(function(){
                            location.href =data.url;
                        },1000)
                    }else{
                        $("#chongzhi").attr('onclick', 'return forget()');
                    }
                }
            })
             return false;
        }
    </script>
</body>
</html>