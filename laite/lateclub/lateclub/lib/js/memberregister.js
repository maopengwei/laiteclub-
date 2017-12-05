function changeusername(){
    $.getJSON(get_url("act=changeusername"),function(res){
      $("#username").val(res.username);
      checkusername();
    }); 
}
function checkusername(){
 var username = $("#username").val();
 var testUser = /^[\u4E00-\u9FA5a-z0-9_]+$/i;
 if(username==''){
   addtip("username","请输入会员账号");
 }else if(username.length<4||username.length>20){
   addtip("username","用户名长度4-20个字符");
 }else if(isFirstNum(username)){
   addtip("username","用户名不能使用数字开头");
 }else if(!testUser.test(username)){
   addtip("username","仅可使用字母、数字、汉字和下划线");
 }else{ 
   $.getJSON(get_url("act=verifyusername&username="+encodeURIComponent(username)),function(res){
     if(res.error=='0'){
       addtip("username",'已注册过，请更换用户名');
     }else{
       removetip("username");
     }
   });        
 }	
}   
function checkuserphone(){
  var userphone = $("#userphone").val();
  if(userphone==''){															 
    addtip("userphone",'请输入手机号码');  
  }else if(!isPhone(userphone)){
    addtip("userphone",'请输入有效的手机号码');  
  }else{
    removetip("userphone");
  }
}
function checkemail(){
  var email = $("#email").val();
  if(email==''||isEmail(email)){															 
    removetip("email");
  }else{
    addtip("email",'请输入有效的邮箱地址');  
  }
}
function checkaddress(){
  var address = $("#address").val();
  if(address){															 
    removetip("address");
  }else{
    addtip("address",'请输入有效的邮箱地址');  
  }
}

function checkreferee(){
  var referee = $("#referee").val();
  if(referee==''){
    addtip("referee","请输入推荐会员");
  }else{
    $.getJSON(get_url("act=verifyusername&username="+encodeURIComponent(referee)),function(res){
      if(res.error=='0'){
        yestip("referee",res.truename);
      }else{
        addtip("referee",res.error);
      }
    }); 
  }
}

function check_referee(){
  var _referee = $("#_referee").val();
  if(_referee==''){
    addtip("_referee","请输入辅导人");
  }else{
    $.getJSON(get_url("act=verifyusername&j=1&username="+encodeURIComponent(_referee)),function(res){
      if(res.error=='0'){
        yestip("_referee",res.truename);
      }else{
        addtip("_referee",res.error);
      }
    }); 
  }
}
function checktruename(){
 if($("#truename").val()==''){
   addtip("truename","请填写会员姓名"); 
 }else{
   removetip("truename");
 }
}

function checkpassword(){
 if($("#password").val()==''){
   addtip("password","请输入登陆密码"); 
 }else if($("#password").val().length<6){
   addtip("password","登录密码至少六位");
 }else{
   removetip("password");
 }
}   
function checkrepass(){
  if($("#repass").val()==""){
    addtip("repass","请输入安全密码");
  }else if($("#repass").val().length<6){
    addtip("repass","安全密码至少六位");
  }else{
    removetip("repass");
  }
}
function checkservice(){
  var service = $("#service").val();
  if(service==''){															 
    removetip("service",'');
  }else{
    $.getJSON(get_url("act=verifyservice&username="+encodeURIComponent(service)),function(res){																 
      if(res.error=='0'){
	    yestip("service",res.truename);
      }else{
        addtip("service",res.error);
      }							  
    });   
  }
}

function checkgroupid(){
  var groupid = $("#groupid").val();
  if(groupid==''){
    addtip("groupid","请选择会员级别");
  }else{
    removetip("groupid");
  }
}

function checkidcard(){
 var idcard = $("#idcard").val();
 //if(idcard==''){
 //  addtip("idcard","请输入身份证号");
 //}else
 if(!checkid(idcard)){
   addtip("idcard","身份证格式不正确");
 }else{
   removetip("idcard");
 }
}

function checkform(){
  var post = true; 
  var testUser = /^[\u4E00-\u9FA5a-z0-9_]+$/i;    
  if($("#username").val()==''){
    addtip("username","请输入会员账号");
    post = false;
  }
  if($("#username").val().length<4||$("#username").val().length>20){
    post = false;
  }
  if(isFirstNum($("#username").val())&&post){
    post = false;
  }
  if(!testUser.test($("#username").val())&&post){
    post = false;
  }
  if($("#usernametip").html().indexOf('已注册过') != -1&&post){
    post = false;
  }   
//  if($("#groupid").val()==''){
//	addtip("groupid","请选择会员级别");
//    post = false;
//  }

if($("#service").val()==''){
    addtip("service","对不起，请输入报单中心");
    post = false;
}
  if($("#truename").val()==''){
    addtip("truename","请填写会员姓名"); 
	post = false;
  } 
  
 //if(!checkid($("#idcard").val())){
 //  addtip("idcard","身份证格式不正确");
 //  post = false;
 //}
 if($("#idcard").val()==''){
   addtip("idcard","请输入身份证号");
   post = false;
 }
  
  if(!isPhone($("#userphone").val())){
    addtip("userphone","请输入有效的手机号码"); 
	post = false;
  }  
  if($("#userphone").val()==''){
    addtip("userphone","请输入手机号码"); 
	post = false;
  } 
//  if($("#address").val()==''){
//    addtip("address","请输入收货地址"); 
//	post = false;
//  }
  
  if($("#referee").val()==''){
	addtip("referee","请输入推荐会员");
    post = false;
  }
//    if($("#_referee").val()==''){
//        addtip("_referee","请输入安置会员");
//        post = false;
//    }
    if($("#refereetip").html().indexOf('推荐会员不存在') != -1&&post){
        addtip("referee","请输入推荐会员");
    post = false;
  } 
//  if($("#_refereetip").html().indexOf('安置会员不存在') != -1&&post){
//      addtip("_referee","请输入安置会员");
//    post = false;
//  } 
//  if ($('input[name="position"]:checked').val() == undefined) {
//      addtip("position","请选择安置位置");
//    post = false;
//  }

  if($("#password").val().length<6){
    addtip("password","登陆密码至少六位");
    post = false;
  }  

  if($("#repass").val().length<6){
    addtip("repass","安全密码至少六位");
    post = false;
  }

  if(post) listTable.memberfrom("注册会员","ajaxformbox","");
  return false;
} 