
<?php
require_once "./fn.php";
// 验证登录, 获得用户信息
$user_info = check_login();

?>



<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
   
  <?php include_once "./inc/navigator.html"; ?>
  
  
  <!-- <nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.html"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="login.html"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav> -->
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div id="msg" class="alert alert-info" style="display:none;" >
        <strong>信息！</strong><span></span>
      </div>
      <div class="row">
        <div class="col-md-4">

          <form id="controlUserFormId">

            <h2>添加新用户</h2>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a id="multi_remove_btn" class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table id="user_list_table" class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>

            <tbody>
              <!-- 用户数据 -->

            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="aside">
    <div class="profile">
      <img class="avatar" src="../uploads/avatar.jpg">
      <h3 class="name">布头儿</h3>
    </div>
    <ul class="nav">
      <li>
        <a href="index.html"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>
        <a href="#menu-posts" class="collapsed" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse">
          <li><a href="posts.html">所有文章</a></li>
          <li><a href="post-add.html">写文章</a></li>
          <li><a href="categories.html">分类目录</a></li>
        </ul>
      </li>
      <li>
        <a href="comments.html"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li class="active">
        <a href="users.html"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="nav-menus.html">导航菜单</a></li>
          <li><a href="slides.html">图片轮播</a></li>
          <li><a href="settings.html">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div> -->
    <!-- 公共部分: 左侧当行菜单 -->
    <?php $page_name = "users"; ?>
    <?php include_once "./inc/aside.html"; ?> ?>

    
    <!-- 模板 用户表格 -->
    <script type="text/template" id="usersTpl"> 
             {{ each list }}
              <tr data-id="{{ $value.id }}">
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center">
                  <img class="avatar" src="{{ $value.avatar || '../assets/img/default.png' }}">
                </td>
                <td>{{$value.email}}</td>
                <td>{{$value.slug}}</td>
                <td>{{$value.nickname}}</td>
                <td>{{$value.status}}</td>
                <td class="text-center">
                  <a href="post-add.php" class="btn btn-default btn-xs edit">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs remove">删除</a>
                </td>
              </tr>
             {{ /each }}
    
    </script>







  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/art-template/template-web.js"></script>
  <script src="../assets/js/common.js?v=<?php echo rand(); ?>"></script>
  <script>NProgress.done()</script>
  <script>
    //加载数据的函数封装
    function load_data(){
      $.get('./api/getallusers.php',function(json){
        //渲染页面
        if(json.success){
          $('#user_list_table tbody').html(template('usersTpl',{
            list:json.result
          }));

        }

      });

    }

    //页面加载之初,加载数据
    $(function(){
     
    load_data();

    });

    //绑定删除事件(代理)
    $(function(){
      $('#user_list_table').on('click','.remove',function(){
        if(!confirm('请确定要删除吗?')){
          return;

        }

        var remove_id=$(this).closest('tr').attr('data-id');
        $.get('./api/removedatabyid.php?id='+remove_id,function(json){
          if(json.success){
            $('#msg').fadeIn(200).find('span').text('删除成功!');
            setTimeout(function(){
              $('#msg').fadeOut(500);
              
            }, 2000);

            load_data();

          }

        });

      });
    });

    //绑定复选框的change事件,然后实现多选,批量删除
    $(function(){
      //表头与表体
      /*
      :text 所有的文本框
      :button 所有的按钮
      :radio 所有的单选框
      :checkbox 所有的复选框

      */
      var remove_ids=[];//专门用于存放需要删除的id
      $('#user_list_table thead :checkbox').on('change',function(){
        //看是否选中,如果选中,则将全部的表体复选框选中
        //如果没选中,则将表体的复选框全部清除
        
        var $obj=$('#user_list_table tbody :checkbox').prop('checked',this.checked);

          //此时应该处理数据
          // 将所有的id都添加到数组中,以及将数组中的全部id移除
          var tmp=[];
          for(var i=0;i<$obj.length;i++){
            var tmp_id=$($obj[i]).closest('tr').attr('data-id');
            tmp.push(tmp_id);

          }
        if(this.checked){
          // 所有的id加上去
          remove_ids=tmp;

        }else{
          // 移除所有的id
          remove_ids.length=0;
        }
      //控制批量删除按钮
        if(remove_ids.length>0){
          $('#multi_remove_btn').fadeIn(200);

        }else{
          $('#multi_remove_btn').fadeOut(500);
        }


       

      });

      $('#user_list_table tbody').on('change',':checkbox',function(){
        //在代理事件中,this也是指向当前被代理的元素

        //判断是否全部被选中,如果全部被选中,则选中表头
        //选中,就将id存入数组,没有选中,要将id从数组中移除

        var curr_id=$(this).closest('tr').attr('data-id');

        //删除和添加都应该判断一下是否存在
        var index=remove_ids.indexOf(curr_id);
        if(this.checked){
          //选中了,需要删除,将id存入数组
          if(index===-1){

            remove_ids.push(curr_id);//不存在,才加入

          }


        }else{
          //未选中,应该将id从数组中移除
          if(index >-1){
            remove_ids.splice(index,1);//存在删除

          }

        }
        //数组中存储了删除的数据,也就表示存储了选中的数量
        var is_all_checked=$('#user_list_table tbody :checkbox').length===remove_ids.length;

        //设置表头
        $('#user_list_table thead :checkbox').prop('checked',is_all_checked);

        //控制批量删除按钮
        if(remove_ids.length > 0){
          $('#multi_remove_btn').fadeIn(200);

        }else{
          $('#multi_remove_btn').fadeOut(500);
        }

      });

      //注册批量删除按钮的事件
      $('#multi_remove_btn').on('click',function(){
        $(this).hide();

        $.get('./api/removedatabyid.php?id='+remove_ids.join(','),function(json){
          if(json.success){
            //给出提示

            $('#msg').fadeIn(200).find('span').text('删除成功');
            setTimeout(function(){
              $('#msg').fadeOut(500);
              
            }, 2000);

            load_data();


          }

        });


      });


    });



    //处理新增用户操作
    $(function(){
      //注册submit事件,检验参数,发送ajax,返回后加载数据
      //注册submit事件
      $('#controlUserFormId').submit(function(){
        //获取表单数据的字符串
        // alert( $( this ).serialize() );
        var formdata=$(this).serialize();
       
        

        if(!tools.checkUrlSearch(formdata)){
          //如果校验失败
          $('#msg').removeClass('alert-info').addClass('alert-danger')
          .fadeIn(200).find('span').text('请填写信息完整');

          setTimeout(function () {
            $('#msg').fadeOut(1000,function(){
              $(this).removeClass('alert-danger').addClass('alert-info');

            });
            
          }, 2000);

          return false;

        }

        //成功,则发送ajax
        $.post('./api/insertuser.php',formdata,function(json){
            if(json.success){
              $('#msg').fadeIn(200).find('span').text('新增用户成功');
              setTimeout(function() {
                $('#msg').fadeOut(400);
                
              }, 2000);

              load_data();

            }
        });

        return false;

      });
    });



  </script>
</body>
</html>
