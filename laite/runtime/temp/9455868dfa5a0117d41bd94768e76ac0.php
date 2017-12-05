<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"D:\phpStudy\WWW\laite\public/../application/index\view\user\index.html";i:1512352104;s:77:"D:\phpStudy\WWW\laite\public/../application/index\view\layout\navigation.html";i:1512204930;s:73:"D:\phpStudy\WWW\laite\public/../application/index\view\layout\footer.html";i:1512184643;}*/ ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo \think\Lang::get('laitejulebu'); ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="__STATIC__/index/lib/css/bootstrap.min.css"/>
        <!-- Font 文件 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- jvectormap地图插件 -->
        <link rel="stylesheet" type="text/css" href="__STATIC__/index/lib/css/jquery-jvectormap-1.2.2.css"/>
        <!-- 本地样式文件-->
        <link rel="stylesheet" type="text/css" href="__STATIC__/index/sheetstyle/AdminLTE.css"/>
        <link rel="stylesheet" type="text/css" href="__STATIC__/index/lib/css/_all-skins.min.css"/>
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
                    <h1><?php echo \think\Lang::get('wodexinxi'); ?></h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard"></i><?php echo \think\Lang::get('shouye'); ?></a>
                        </li>
                        <li class="active"><?php echo \think\Lang::get('wodexinxi'); ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class="box-body">
                                        <div class="callout callout-warning">
                                            <p></p>
                                        </div>
                                    </div>
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label><?php echo \think\Lang::get('yonghuming'); ?></label>
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $info['user']; ?>" name="mymoney" id="mymoney" class="form-control" disabled/>
                                                    <input type="hidden" name="method" id="method" value="隐藏的input" />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label><?php echo \think\Lang::get('huiyuanxingming'); ?></label>
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $info['theme']; ?>" name="mymoney" id="mymoney" class="form-control" disabled/>
                                                    <input type="hidden" name="method" id="method" value="隐藏的input" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label><?php echo \think\Lang::get('shoujihao'); ?></label>
                                                <div class="form-group">
                                                    <input type="tel" value="<?php echo $info['phone']; ?>" name="username" id="username" class="form-control zzinput" placeholder="您的手机号" />
                                                    <label class="control-label  " id="prompt"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo \think\Lang::get('youxiang'); ?></label>
                                                <div>
                                                    <input type="text" value="<?php echo $info['email']; ?>" name="howmoney" id="howmoney"  class="form-control zzinput" placeholder="" />

                                                    <label class="control-label " id="prompt"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="lever-title"><?php echo \think\Lang::get('dengji'); ?></label>
                                                <br>
                                               <input type="radio" name="level" value="0" class='lever-input'> &nbsp;<span><?php echo \think\Lang::get('putonghuiyuan'); ?></span>
                                                <input type="radio" name="level" value="1" class='lever-input'>&nbsp;<span><?php echo \think\Lang::get('baodanzhongxin'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo \think\Lang::get('zhuceshijian'); ?></label>
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo date('Y-m-d H:i:s',$info['add_time']); ?>" name="howmoney" id="howmoney"  class="form-control zzinput" placeholder="" />
                                                    <label class="control-label  " id="prompt"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo \think\Lang::get('laitebiqianbao'); ?></label>
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $info['detail']['litecoin_wallet']; ?>" name="" id="howmoney"  class="form-control zzinput" placeholder="" />
                                                    <label class="control-label  " id="prompt"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo \think\Lang::get('fuxiaobiqianbao'); ?></label>
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $info['detail']['aftercoin_wallet']; ?>" name="howmoney" id="howmoney"  class="form-control zzinput" placeholder="" />
                                                    <label class="control-label  " id="prompt"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>ICO</label>
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $info['detail']['ico_wallet']; ?>" name="howmoney" id="howmoney"  class="form-control zzinput" placeholder="" />
                                                    <label class="control-label  " id="prompt"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo \think\Lang::get('gufen'); ?></label>
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $info['detail']['stock_wallet']; ?>" name="howmoney"  class="form-control zzinput" placeholder="" />
                                                    <label class="control-label"></label>
                                                </div>
                                            </div> 
                                            <form>  
                                            <div class="form-group">
                                                <label><?php echo \think\Lang::get('tixiandizhi'); ?></label>
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $info['detail']['withdraw_address']; ?>" name="withdraw_address" class="form-control zzinput" placeholder="" />
                                                    <label class="control-label"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo \think\Lang::get('anquanmima'); ?></label>
                                                <div class="form-group">
                                                    <input type="password" value="" name="second_pass" class="form-control zzinput" placeholder="" />
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <input type="submit" id="submit" onclick="return queren()"  value="<?php echo \think\Lang::get('queren'); ?>" class=' btn btn-primary pull-right'> </div>
                                            </div>
                                            </form>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b><?php echo \think\Lang::get('banbenhao'); ?></b> 1.1.0
    </div>
    <strong><?php echo \think\Lang::get('banquan'); ?> &copy; 2014-2017 <a href="#"><?php echo \think\Lang::get('laitejulebu'); ?></a>.</strong>
</footer>
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
        $(function(){
            $("input[name='level']").each(function(){
                if($(this).val()=='<?php echo $info['level']; ?>'){
                    $(this).prop("checked",true);
                }
            });
        })
        function queren(){
            console.log(12);
            $('#submit').attr('disabled',true);
            $.ajax({
                type:"post",
                url:"<?php echo url('index'); ?>",
                data:$('form').serialize(),
                success:function(data){
                    console.log(123),
                    layer.msg(data.msg);
                    if(data.code){
                        setTimeout(function(){
                            location.href=data.url;
                        },1000);
                    }else{
                        $('#submit').removeAttr('disabled');
                    }
                    return false;
                }
            })
            return false;
        }
       
    </script>

</html>