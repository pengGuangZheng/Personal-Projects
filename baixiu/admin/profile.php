<?php
require_once "./fn.php";
// 验证登录, 获得用户信息
$user_info = check_login();

?>



<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">

    <!-- 公共部分,顶部导航条 -->
    <?php
    include_once "./inc/navigator.html";

    ?>

    <!-- <nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.html"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="login.html"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav> -->





    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display:none" id="alert">
        <strong>错误！</strong><span></span>
      </div>

      <div class="alert alert-info" style="display :none" id="info">
      <strong>消息!</strong><span></span>
      </div>

      <form id="profile_form" class="form-horizontal ">
       <!-- 放置个人中心的数据 -->
      </form>



    <!-- 个人中心的模板 -->
      <script type="text/template" id="profile_tpl">

      <input type="hidden" name="id" value="{{id}}">
      
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" type="file">

              <img id="img_avatar" src="{{ avatar }}">


              <!-- 隐藏域 接收路径 -->
              <input type="hidden" name="avatar" values="{{avatar}}">
             
             
             
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
          
          
            <input id="email"
             class="form-control"
              name="email" 
              type="type" 
              value="{{email}}"
               placeholder="邮箱"
                readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          
          
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
          <!-- 别名部分 -->

            <input id="slug"
             class="form-control"
              name="slug" type="type"
               value="{{slug}}"
                placeholder="slug">
            <p class="help-block">https://zce.me/author/<strong>zce</strong></p>
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname"
             class="form-control" 
             name="nickname" 
             type="type" 
             value="{{nickname}}"
              placeholder="昵称">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" 
            name="bio"
            class="form-control" placeholder="Bio" 
            cols="30"
             rows="6">{{bio}}</textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-primary">更新</button>
            <a class="btn btn-link" href="password-reset.html">修改密码</a>
          </div>
        </div>
      
      </script>



    </div>
  </div>


  <!-- 侧边栏公共部分 -->
  <!-- <div class="aside">
    <div class="profile">
      <img class="avatar" src="<?php echo $user_info["avatar"] ?>">
      <h3 class="name"><?php echo $user_info["name"] ?></h3>
    </div>
    <ul class="nav">
      <li>
        <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>
        <a href="#menu-posts" class="collapsed" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse">
          <li><a href="posts.php">所有文章</a></li>
          <li><a href="post-add.php">写文章</a></li>
          <li><a href="categories.php">分类目录</a></li>
        </ul>
      </li>
      <li>
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="nav-menus.php">导航菜单</a></li>
          <li><a href="slides.php">图片轮播</a></li>
          <li><a href="settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div> -->
  <?php $page_name = "profile"; ?>
  <?php include_once "./inc/aside.html"; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/art-template/template-web.js"></script>
  <script>NProgress.done()</script>
  <script src="../assets/js/common.js"></script>
  
  <script>
  
  //发送请求
  //渲染页面
  $(function(){
    var id=tools.paramToObj(location.search).id;

    $.get('./api/getuserbyid.php?id='+id,function(json){
      if(json.success){
        $('#profile_form').html(template('profile_tpl',json.result[0]));

      }
    });




//给别名文本框注册input事件,使用事件委托

  $('#profile_form').on('input',"#slug",function(){

     $(this).next().find('strong').text(this.value || 'slug');
    });



    //图片上传 选中图片就上传 注册change事件
    $('#profile_form').on('change','#avatar',function(){
      //上传文件
      var formdata=new FormData();
      formdata.append('file',this.files[0]);
      $.ajax({
        url:'./api/uploadfile.php',
        type:'POST',
        data:formdata,
        catch:false,
        contentType:false,
        processData:false,
 
        success:function(json){
          //图片加载到页面中
          if(json.success){
            $('#img_avatar').prop('src',json.result.image);//上传预览
           //属性选择器
           $('[name=avatar]').val(json.result.image);//设置给隐藏域,便于后面提交更新

          }

        }
      });
    });


    //表单要提交
    $('#profile_form').on('submit',function(){
      //检验数据
      var formdata=$(this).serialize();
      // console.log(formdata);

      if(/=&|=$/.test(formdata)){
        //警告
        $('#alert span').text('请填写完整信息')
        .closest('#alert')
        .fadeIn(200);

        setTimeout(function() {
          $('#alert').fadeOut(500);
          
        }, 2000);
        return false;

      }
      

      //提交更新的ajax请求

      $.post('./api/updateprofile.php',formdata,function(json){

        if(json.success){
          //提示消息
          $('#info span').text('更新成功').closest('#info').fadeIn(200);

          setTimeout(function() {
            $('#info').fadeOut(500);
            
          }, 2000);

        }

      });




      return false;//发送的是Ajax,不需要表单验证

    });






  });

  //页面加载,发送ajax请求,向服务器索要数据
  //把数据渲染到页面中
  //用户编辑完后,点击修改再发送ajax请求

  //页面加载,获得当前用户数据
  // $(function(){
  //   //获得当前id
  //   var obj=tools.paramToObj(location.search);

  //   var  id=obj.id;

  //   //发送ajax请求
  //   $.get('./api/getuserbyid.php',{id:id},function(response){
  //     if(response.success){
  //       //渲染页面
  //       $('#img_avatar').prop('src',response.result[0].avatar);
  //       $('#email').val(response.result[0].email);
  //       $('#slug').val(response.result[0].slug)
  //       .next().find('strong').text(response.result[0].slug);
  //       $('#nickname').val(response.result[0].nickname);
  //       $('#bio').val(response.result[0].bio);

  //     }else{
  //       //给出警告
  //       location.href='./index.php';
  //     }

  //   });


  // });

  
  
  </script>
</body>
</html>
