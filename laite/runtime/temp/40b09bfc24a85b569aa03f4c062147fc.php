<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\WWW\laite\public/../application/index\view\login\forget.html";i:1512355746;}*/ ?>
<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo \think\Lang::get('wangjimima'); ?></title>
	
	<link rel="stylesheet" type="text/css" href="__STATIC__/index/login/css/default.css">
	
	<!--必要样式-->
	<link rel="stylesheet" type="text/css" href="__STATIC__/index/login/css/styles.css">
	<!--[if IE]>
		<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
	<style>
		body .login{
			    padding: 30px 40px 40px 40px;
			    height: 350px;
		}
		.send-code{
				position: absolute;
				top: 10px;
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
	<div class="bgimg">
		<img src="__STATIC__/index/login/img/bgimg.png" />
	</div>
	<div class='login'>
	  <div class='login_title'>
	    <img src="__STATIC__/index/login/img/title.png" />
	  </div>
	  <div class='login_fields'>
	  	<form class="forget">
	    <div class='login_fields__user'>
	      <div class='icon'>
	        <img src='__STATIC__/index/login/img/phone.png' style="width: 17px;height: 20px;">
	      </div>
	      <input placeholder='<?php echo \think\Lang::get('shoujihao'); ?>' name="phone" type='text'>
	    </div>
	    <div class='login_fields__password'>
	      <div class='icon'>
	        <img src='__STATIC__/index/login/img/lock_icon_copy.png'>
	      </div>
	      <input placeholder='<?php echo \think\Lang::get('newpass'); ?>' name="user_pass" type='password'>
	      <div class='validation'>
	        <img src='__STATIC__/index/login/img/tick.png'>
	      </div>
	      
	    </div>
	    <div class='login_fields__password'>
	      <div class='icon'>
	        <img src='__STATIC__/index/login/img/lock_icon_copy.png'>
	      </div>
	      <input placeholder='<?php echo \think\Lang::get('newpass_again'); ?>' name="pass1" type='password'>
	      <div class='validation'>
	        <img src='__STATIC__/index/login/img/tick.png'>
	      </div>
	    </div>
	    <div class='login_fields__password' style="position: relative;">
	      <div class='icon'>
	        <img src='__STATIC__/index/login/img/code.png' style="width: 17px;height: 20px;">
	      </div>
	      <input placeholder='<?php echo \think\Lang::get('yanzhengma'); ?>' name="note_code" type='text'>
	      <div class='validation'>
	          <img src='__STATIC__/index/login/img/tick.png'>
	        </div>
	      </input>
	      <div class="send-code huoqu"   onclick="gain()"><?php echo \think\Lang::get('fasongyanzhengma'); ?></div>
	    </div>
	    
	    <div class='login_fields__submit'>
	      <input type='submit' id="chongzhi" onclick="return forget()" value='<?php echo \think\Lang::get('chongzhimima'); ?>'>
	     </div>
	     </form>
	  </div>
	  
	  <div class='disclaimer' style="margin-top: 20px;">
	    <p>
	    	 <b><?php echo \think\Lang::get('banbenhao'); ?></b> 1.1.0<strong>&copy; 2014-2017 <a href="#"><?php echo \think\Lang::get('laitejulebu'); ?></a>.</strong>
	    </p>
	  </div>
	</div>
	<div class='authent'>
	  <img src='__STATIC__/index/login/img/puff.svg'>
	  <p>认证中...</p>
	</div>
	
	<script type="text/javascript" src='__STATIC__/index/login/js/stopExecutionOnTimeout.js?t=1'></script>
	<script type="text/javascript" src="__STATIC__/index/login/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="__STATIC__/index/login/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="__STATIC__/mine/layer/layer.js"></script>
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
		//忘记密码提交
		function forget(){
			console.log(12);
			$('#chongzhi').removeAttr('onclick');
		    $.ajax({
		        type:"post",
		        url:"<?php echo url('forget'); ?>",
		        data:$('.forget').serialize(),
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