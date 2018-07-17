<?php
require_once "./fn.php";

$user_info=check_login();
//登陆验证
    // session_start();
    // if(empty($_SESSION["current_user_login_id"])){
    //   header("location: ./login.php");
    //   exit;
    // }
    // session_start();
    // if(empty($_SESSION["current_user_login_id"])){
    //   header("location:./login.php");
    //   exit;

    // }

    // //查询用户的信息

    // $current_user_login_id=$_SESSION["current_user_login_id"];
    // $user_info=itcast_query("SELECT * FROM users WHERE id=$current_user_login_id")[0];


    //获得站点统计信息
    //文章总数,草稿总数
    $post_total=itcast_get_single_value("SELECT COUNT(*) FROM posts");

    $post_drafted_total=itcast_get_single_value("SELECT COUNT(*) FROM posts WHERE `status`='drafted'");

    //分类总数

    $category_total=itcast_get_single_value("SELECT COUNT(*) FROM categories");
    //评论总数,待审核总数
    $comment_total=itcast_get_single_value("SELECT COUNT(*) FROM comments");
    $comment_held_total=itcast_get_single_value("SELECT COUNT(*) FROM comments WHERE `status`='held'");


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

    <!-- 公共部分,导航 -->
    <?php include_once "./inc/navigator.html"?>
   



    <div class="container-fluid">
      <div class="jumbotron text-center">
        <h1>One Belt, One Road</h1>
        <p>Thoughts, stories and ideas.</p>
        <p><a class="btn btn-primary btn-lg" href="post-add.html" role="button">写文章</a></p>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">站点内容统计：</h3>
            </div>
            <ul class="list-group">

            <!-- 站点内容统计 -->
            
              <li class="list-group-item">
              <strong><?php echo $post_total; ?></strong>篇文章（
              <strong><?php echo $post_drafted_total; ?></strong>篇草稿）</li>
              <li class="list-group-item">
              <strong><?php echo $category_total; ?></strong>个分类</li>
              <li class="list-group-item">
              <strong><?php echo $comment_total; ?></strong>条评论（
              <strong><?php echo $comment_held_total; ?></strong>条待审核）</li>
            </ul>


          </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>

  <!-- <div class="aside">



    <div class="profile">
      <img class="avatar" src="<?php echo $user_info["avatar"]; ?>">
      <h3 class="name"><?php echo $user_info["nickname"]; ?></h3>
    </div>


    <ul class="nav">
      <li class="active">
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
      <li>
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
    <?php $page_name = "index"; ?>
    <?php include_once "./inc/aside.html"; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
