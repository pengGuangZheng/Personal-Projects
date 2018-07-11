<?php
require_once "./fn.php";

function process() {
  // 参数校验, 进行 登录的判断

  // 1. 输入完整 的校验
  if ( empty( $_POST[ "email" ] ) || empty( $_POST[ "password" ] ) ) {
    $GLOBALS[ "err_msg" ] = "请输入完整信息";
    return;
  }

  // 2. 用户密码的验证
  $email=$_POST["email"];
  $password=$_POST["password"];

  $list=itcast_query("SELECT * FROM users WHERE email='$email' ");

  if(count($list)==0){
    $GLOBALS["err_msg"]="用户名或密码错误(用户名不存在)";
    return;
  }
  //走到这里验证密码是否一致
  if($list[0]["password"]!=$password){
    $GLOBALS["err_msg"]="用户名或密码错误(密码错误)";
    return;

  }
  session_start();
  $_SESSION["current_user_login_id"]=$list[0]["id"];

  header("location:./index.php");
  exit;


}

if ( $_SERVER[ "REQUEST_METHOD" ] === "POST" ) {
  process();
}


 


?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap" method="POST">
      <img class="avatar" src="../assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <?php if ( isset( $err_msg ) ) { ?>
      <div class="alert alert-danger">
        <strong>错误！</strong> <?php echo $err_msg; ?>
      </div>
      <?php } ?>
      
      <div id="jqalert" class="alert alert-danger" style="display:none;">
      <strong>错误!</strong>请填写数据完整!
      </div>

      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email"
               type="email"
               class="form-control" 
               placeholder="邮箱"
               name="email" 
               autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <!-- <input id="password" 
                type="password" 
                class="form-control" 
                name="password"
                placeholder="密码"> -->
                <input id="password" 
                type="text" 
                class="form-control" 
                name="password"
                placeholder="密码">
      </div>
      <!-- <a class="btn btn-primary btn-block" href="index.html">登 录</a> -->
      <input class="btn btn-primary btn-block" type="submit" value="登录">
    </form>
  </div>
  <script src="../assets/vendors/jquery/jquery.js">
  
  </script>
  <script>
  //对表单数据进行校验
  //注册submit事件
  $( " form" ).submit(function(){
    //对参数经行校验
    var formdata=$(this).serialize();//将表单中所有的数据取出来

    //可以用正则和字符串的分割
    var params={};//定义一个对象,接受分割数组生成的键值对
    var tmp_arr=formdata.split('&');//是一个数组
    //遍历数组,生成键值对
    for(var i=0;i<tmp_arr.length;i++){
      var kv=tmp_arr[i].split('=');
      params[kv[0]]=kv[1];

    }

    //遍历params这个对象,看对象的值是否有没有数据
    for(var k in params){
      if(params[k].length===0){

        $('#jqalert').fadeIn(200);
        setTimeout(function()  {
          $('#jqalert').fadeOut(500);      
        }, 2000);

        return false;
      }

    }



  });

  
  </script>
</body>
</html>
