<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\phpStudy\WWW\laite\public/../application/index\view\user\change.html";i:1512198714;s:77:"D:\phpStudy\WWW\laite\public/../application/index\view\layout\navigation.html";i:1512204930;s:73:"D:\phpStudy\WWW\laite\public/../application/index\view\layout\footer.html";i:1512184643;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo \think\Lang::get('laitejulebu'); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/lib/css/bootstrap.min.css" />
    <!-- Font 文件 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap地图插件 -->
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/lib/css/jquery-jvectormap-1.2.2.css" />
    <!-- 本地样式文件-->
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/sheetstyle/AdminLTE.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/lib/css/_all-skins.min.css" />
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
    <div class="user-panel" style="position:fixed;left:0;top:0;height: 65px">
            <div class="pull-left image">
                <img src="__STATIC__/index/lib/imgs/user3-128x128.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $yonghu; ?></p>
                <i class="fa fa-circle text-success"></i> <?php echo \think\Lang::get('zaixian'); ?>
            </div>
    </div>
    
    <nav class="navbar navbar-static-top">
        
        
                    <div class="logo" style="width: 32%;height: 50px;position: fixed;">
                        <img src="__STATIC__/index/lib/imgs/mlogo.png" style="width: 100%;height: 100%">
                    </div>
        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="__STATIC__/index/lib/imgs/user3-128x128.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $yonghu; ?></span>
                                </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="__STATIC__/index/lib/imgs/user3-128x128.jpg" class="img-circle" alt="User Image">
                            <p>
                                <?php echo $yonghu; ?>
                                <small>您已成为本站会员<?php echo $tian_num; ?>天</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="/index/login/logout.html" class="btn btn-default btn-flat">登出</a>
                            </div>
                        </li>
                    </ul>
                </li>
              <!--   <li>
                  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li> -->
            </ul>
        </div>
    </nav>
</header>
<aside class="main-sidebar" style="margin-top: 14px">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <ul class="sidebar-menu">
            <li class="header"><?php echo \think\Lang::get('zhucaidan'); ?></li>
            <!-- 系统首页 -->
            <li class="treeview">
                <a href="/index/index/index.html">
                    <i class="fa fa-dashboard"></i> <span><?php echo \think\Lang::get('xitongshouye'); ?></span>
                </a>
            </li>
            <!-- 个人资料 -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span><?php echo \think\Lang::get('gerenziliao'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/index/user/index.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('gerenxinxi'); ?></a></li>
                    <li><a href="/index/user/change.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('xiugaimima'); ?></a></li>
                </ul>
            </li>
            <!-- 财务管理 -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span><?php echo \think\Lang::get('caiwuguanli'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/index/wealth/index.html"><i class="fa fa-circle-o"></i> <?php echo \think\Lang::get('jihuomingxi'); ?></a></li>
                    <li><a href="/index/wealth/return_list.html"><i class="fa fa-circle-o"></i> <?php echo \think\Lang::get('meirifenhong'); ?></a></li>
                    <li><a href="/index/wealth/leader.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('jianglimingxi'); ?></a></li>
                    <li><a href="/index/wealth/cash.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('chongzhitixian'); ?></a></li>
                    <li><a href=" /index/wealth/cash_list.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('xianjinjilu'); ?></a></li>
                </ul>
            </li>
            <!-- 业务管理 -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span><?php echo \think\Lang::get('yewuguanli'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/index/user/register.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('zhucehuiyuan'); ?></a></li>
                    <li>
                        <a href="/index/team/register.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('zhuceliebiao'); ?></a>
                    </li>
                    <li><a href="/index/user/active.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('jihuohuiyuan'); ?></a></li>
                    <li>
                        <a href="/index/team/team.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('wodetuandui'); ?></a>
                    </li>
                    
                </ul>
            </li>
            <!-- <li class="treeview">
                <a href="">
                    <i class="fa fa-pie-chart"></i>
                    <span><?php echo \think\Lang::get('tuanduiguanli'); ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/index/team/direct.html"><i class="fa fa-circle-o"></i> 推荐列表</a>
                        
                    </li>
                    
                    
                </ul>
            </li> -->
            <!-- 联系我们 -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i> <span><?php echo \think\Lang::get('lianxiwomen'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/index/news/relation.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('woyaoliuyan'); ?></a></li>
                    <li><a href="/index/news/relation_list.html"><i class="fa fa-circle-o"></i><?php echo \think\Lang::get('liuyanliebiao'); ?></a></li>
                </ul>
            </li>
            
            <!-- 语言切换 -->
            <li class="treeview">
                <a href="">
                    <i class="fa fa-pie-chart"></i>
                    <span><?php echo \think\Lang::get('yuyanqiehuan'); ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="?lang=zh-cn"><i class="fa fa-circle-o"></i>中文简体</a></li>
                    <li><a href="?lang=zh-tw"><i class="fa fa-circle-o"></i>中文繁體</a></li>
                    <li><a href="?lang=en-us"><i class="fa fa-circle-o"></i>Englist</a></li>
                </ul>
            </li>
            <!-- 安全退出 -->
            
           
            
            <li class="treeview">
                <a href="/index/login/logout.html">
                    <i class="fa fa-table"></i> <span><?php echo \think\Lang::get('anquantuichu'); ?></span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
        </ul>
    </section>
</aside>
        <div class="content-wrapper">
            <section class="content-header">
                <h1><?php echo \think\Lang::get('xiugaimima'); ?></h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html"><i class="fa fa-dashboard"></i> <?php echo \think\Lang::get('shouye'); ?></a>
                    </li>
                    <li class="active"><?php echo \think\Lang::get('xiugaimima'); ?></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1" data-toggle="tab"><?php echo \think\Lang::get('xiugaidenglumima'); ?></a>
                                </li>
                                <li>
                                    <a href="#tab_2" data-toggle="tab"><?php echo \think\Lang::get('xiugaianquanmima'); ?> </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="nav-tabs-custom">
                                                <div class="tab-content">
                                                    <div class="box-body">
                                                        <div class="callout callout-danger">
                                                            <p><?php echo \think\Lang::get('xxxxx'); ?></p>
                                                        </div>
                                                    </div>
                                                    <form id="user_pass">
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label><?php echo \think\Lang::get('yuanshidenglumima'); ?></label>
                                                                <div class="form-group">
                                                                    <input type="password" value="" name="old_user_pass" id="pwd" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo \think\Lang::get('xindenglumima'); ?></label>
                                                                <div class="form-group">
                                                                    <input type="password" value="" name="user_pass" id="newpwd1" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo \think\Lang::get('zaicishuruxindenglumima'); ?></label>
                                                                <div class="form-group">
                                                                    <input type="password" value="" name="pass1" id="newpwd2" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <input type="submit" name="submit" onclick="return userpass()" id="change1" value="<?php echo \think\Lang::get('querengenggai'); ?>" class=' btn btn-primary pull-right txsubmit'> </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="nav-tabs-custom">
                                                <div class="tab-content">
                                                    <div class="box-body">
                                                        <div class="callout callout-danger">
                                                            <p><?php echo \think\Lang::get('ooooo'); ?></p>
                                                        </div>
                                                    </div>
                                                    <form id="second_pass" name="" method="post" onsubmit="">
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label><?php echo \think\Lang::get('yuanshianquanmima'); ?></label>
                                                                <div class="form-group">
                                                                    <input type="password" value="" name="old_second_pass" id="" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo \think\Lang::get('xinanquanmima'); ?></label>
                                                                <div class="form-group">
                                                                    <input type="password" value="" name="second_pass" id="" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo \think\Lang::get('zaicishuruxinanquanmima'); ?></label>
                                                                <div class="form-group">
                                                                    <input type="password" value="" name="pass2" id="" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <input type="submit" name="submit" onclick="return secondpass()" id="change2" value="<?php echo \think\Lang::get('querengenggai'); ?>" class=' btn btn-primary pull-right txsubmit'> </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b><?php echo \think\Lang::get('banbenhao'); ?></b> 1.1.0
    </div>
    <strong><?php echo \think\Lang::get('banquan'); ?> &copy; 2014-2017 <a href="#"><?php echo \think\Lang::get('laitejulebu'); ?></a>.</strong>
</footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <div class="tab-content">
                <div class="tab-pane" id="control-sidebar-home-tab">
                </div>
                <div class="tab-pane" id="control-sidebar-settings-tab">
                </div>
            </div>
        </aside>
        <div class="control-sidebar-bg"></div>
    </div>
    <script src="__STATIC__/index/lib/js/jquery-2.2.3.min.js"></script>
    <script src="__STATIC__/mine/layer/layer.js"></script>
    <script src="__STATIC__/index/lib/js/bootstrap.min.js"></script>
    <script src="__STATIC__/index/lib/js/fastclick.js"></script>
    <script src="__STATIC__/index/lib/js/app.min.js"></script>
    <script src="__STATIC__/index/lib/js/jquery.sparkline.min.js"></script>
    <script src="__STATIC__/index/lib/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="__STATIC__/index/lib/js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="__STATIC__/index/lib/js/jquery.slimscroll.min.js"></script>
    <script src="__STATIC__/index/lib/js/Chart.min.js"></script>
    <script src="__STATIC__/index/lib/js/demo.js"></script>
</body>
<script type="text/javascript">
    function userpass(){
        console.log(123);
        $("#change1").attr('disabled',true);
        
        $.ajax({
            type:"post",
            url:"<?php echo url('user_pass'); ?>",
            data:$('#user_pass').serialize(),
            success:function(data){
                console.log(data);
                layer.msg(data.msg);
                if(data.code){
                    setTimeout(function(){
                        location.href=data.url;
                    },1000)
                }else{
                    $('#change1').removeAttr('disabled');
                }
            }
        })
        return false;
    }
    function secondpass(){
       console.log(123);
        $("#change2").attr('disabled',true);
        $.ajax({
            type:"post",
            url:"<?php echo url('second_pass'); ?>",
            data:$('#second_pass').serialize(),
            success:function(data){
                console.log(data);
                layer.msg(data.msg);
                if(data.code){
                    setTimeout(function(){
                        location.href=data.url;
                    },1000)
                }else{
                    $('#change2').removeAttr('disabled');
                }
            }
        })
        return false;
    }
</script>

</html>