<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"D:\phpStudy\WWW\laite\public/../application/index\view\news\relation.html";i:1512203199;s:77:"D:\phpStudy\WWW\laite\public/../application/index\view\layout\navigation.html";i:1512204930;s:73:"D:\phpStudy\WWW\laite\public/../application/index\view\layout\footer.html";i:1512184643;}*/ ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo \think\Lang::get('laitejulebu'); ?></title>
         <!-- 手机样式标签 -->
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
    <style type="text/css">
        .mytextarea{
            width: 60%;
            border-radius: 10px;
            border: 1px solid #ddd;
            padding-bottom：10px;
            overflow: hidden;
        }
        .mytextarea input{
            padding-bottom:300px ;
            width: 100%;
            padding-top: 20px;
            text-indent: 20px;
            border: 0;
            line-height: 10px;
            border-radius: 10px;
            word-wrap:break-word;
            overflow:auto; 
            white-space: pre-wrap;
            word-break:break-all;
            color: #555;
            }
        .webuploader-element-invisible {
        background: #fff;
        position: fixed;
        left: 50%;
        border: 0;
        background: #fff;
    }

    .webuploader-element-invisible {
        opacity: 0;
    }

    #rt_rt_1bv6oe2g81kscmi51hnu1k3u1m471 lable {
        text-align: center!important;
    }
     .pic-box {
        text-align: center;
    }
    </style>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- Left side column. contains the logo and sidebar -->
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

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?php echo \think\Lang::get('woyaoliuyan'); ?></h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard"></i> <?php echo \think\Lang::get('shouye'); ?></a>
                        </li>
                        <li class="active"><?php echo \think\Lang::get('woyaoliuyan'); ?></li>
                    </ol>
                </section>

                <!-- Main content -->

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <form action="relation" enctype="multipart/form-data" method="post" >
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="content" style="font-weight: 900;margin-left: 10px"><?php echo \think\Lang::get('qingshurubiaoti'); ?></label>
                                                <input type="text" name="title" class="form-control mytitle" value="" placeholder="<?php echo \think\Lang::get('qingshurubiaoti'); ?>" style="border-radius:6px;font-weight:900;">
                                            </div>
                                            <div class="form-img">
                                                <h3 style="font-size: 14px;font-weight: 900"><?php echo \think\Lang::get('shangchuantupian'); ?></h3>
                                                <div class="fileinput"><input type="file" name="img" ></div>
                                            </div>
                                            <div class="form-content">
                                                <h3 style="font-size: 14px;font-weight: 900;margin-left: 10px"><?php echo \think\Lang::get('qingshuruneirong'); ?></h3>
                                                <div class="mytextarea">
                                                    <input type="textarea" name="content" placeholder="<?php echo \think\Lang::get('qingshuruneirong'); ?>">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" style="float: left;margin-top: 20px;"><?php echo \think\Lang::get('tijiao'); ?></button>
                                        </div>
                                    </form>
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

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">

                    </div>
                    <!-- /.tab-pane -->

                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">

                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->

            <script type="text/javascript" src="__STATIC__/mine/jQuery/jquery-2.2.4.min.js"></script>
            <script type="text/javascript" src="__STATIC__/mine/layer/layer.js"></script>
            <script src="__STATIC__/index/lib/js/bootstrap.min.js"></script>
            <script src="__STATIC__/index/lib/js/fastclick.js"></script>
            <script src="__STATIC__/index/lib/js/app.min.js"></script>
            <script src="__STATIC__/index/lib/js/jquery.sparkline.min.js"></script>
            <script src="__STATIC__/index/lib/js/jquery.slimscroll.min.js"></script>
            <script src="__STATIC__/index/lib/js/Chart.min.js"></script>
            <script src="__STATIC__/index/lib/js/demo.js"></script>
            <script type="text/javascript" src="/static/webuploader/0.1.5/webuploader.min.js"></script>
    </body>
    <script type="text/javascript">
        $(function(){
            if($(".cunzai").html()==""||$(".cunzai").html()==null){
                console.log("1");
                $(".tishi").show();
            }else{
                console.log("2")
                $(".tishi").hide();
            }
        });
        function relation(){
            $('.submit').attr('disabled',true);
            $.ajax({
                type:"post",
                url:"relation",
                data:$('').serialize(),
                function(data){
                    console.log(data);
                    layer.msg(data.msg);
                    // if(data.code){
                    //     setTimeout(function(){
                    //         location.href = data.url;
                    //     },1000)
                    // }else{
                    //     $('.submit').removeAttr('disabled');
                    // }
                }
            })
        }
        //上传图片
//上传图片
$(function(){
    
    $list = $("#fileList"),
    $btn = $("#btn-star"),
    state = "pending",
    uploader;

    var uploader = WebUploader.create({
        auto: false,
        // swf: '/static/admin/lib/webuploader/0.1.5/Uploader.swf',
        // 文件接收服务端。
        server: '/static/webuploader/0.1.5/server/fileupload.php',
    
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick:'#filePicker',
    
        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false,
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/jpg,image/jpeg,image/png'
        }
    });
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
            '<div id="' + file.id + '" class="item">' +
                '<div class="pic-box"><img></div>'+
                '<div class="info">' + file.name + '</div>' +
                '<p class="state">等待上传...</p>'+
            '</div>'
        ),
        $img = $li.find('img');
        $list.html( $li );
        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }
            $img.attr( 'src', src );
        }, 100, 100 );
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress-box .sr-only');
    
        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
        }
        $li.find(".state").text("上传中");
        $percent.css( 'width', percentage * 100 + '%' );
    });
    
    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file, response ) {
        console.log(file.name);
        console.log(response);
        var aa = getExt(file.name);
        $( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
        $('.pd_pic').val("/uploads/pingzheng/"+response+aa);
    });
    
    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
    });
    
    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress-box').fadeOut();
    });
    uploader.on('all', function (type) {
        if (type === 'startUpload') {
            state = 'uploading';
        } else if (type === 'stopUpload') {
            state = 'paused';
        } else if (type === 'uploadFinished') {
            state = 'done';
        }

        // if (state === 'uploading') {
        //     $btn.text('暂停上传');
        // } else {
        //     $btn.text('开始上传');
        // }
    });

    $btn.on('click', function () {
        if (state === 'uploading') {
            uploader.stop();
        } else {
            uploader.upload();
        }
    });

});
function getExt(uploadf){
    var index1 = uploadf.lastIndexOf(".");
    var index2 = uploadf.length;
    return uploadf.substring(index1,index2);
}
    </script>

</html>