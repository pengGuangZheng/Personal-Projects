<?php

require_once "./fn.php";
// 验证登录, 获得用户信息
$user_info = check_login();
?>



<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
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
        <h1>所有文章</h1>
        <a href="post-add.php" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
       
       
        <form id="filter_form_id" class="form-inline">
           <!-- 分类 -->
          <select name="category" id="category" class="form-control input-sm">
            <!-- 坑 -->
          </select>

          <!-- //状态 -->
          <select name="status" id="status" class="form-control input-sm">
            <option value="-1">所有状态</option>
            <option value="drafted">草稿</option>
            <option value="published">已发布</option>
            <option value="trashed">回收站</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
       
       
        </form>
        <ul class="pagination pagination-sm pull-right">
          
        </ul>
      </div>
      <table id="post_table" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
         
        <!-- 文章列表数据 坑 -->

        </tbody>
      </table>
    </div>
  </div>


<!-- 文章列表数据的模板 -->
<script type="text/template" id="post_list_tpl">
{{each list}}
   <tr data-id="{{ $value.id }}">
            <td class="text-center"><input type="checkbox"></td>
            <td>{{$value.title}}</td>
            <td>{{$value.nickname}}</td>
            <td>{{$value.name}}</td>
            <td class="text-center">{{$value.created | formatdate }}</td>
            <td class="text-center">{{$value.status}}</td>
            <td class="text-center">
              <a href="./post-add.php?id={{$value.id}}" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
   </tr>
  {{ /each }}
        
</script>

<!-- 分类下拉列表模板 -->
<script type="text/template" id="category_select_tpl">

            <option value="">所有分类</option>
            {{ each list }}

            <option value="{{ $value.id }}">{{ $value.name }}</option>
            {{  /each }}
</script>


 
    <!-- 公共部分: 左侧当行菜单 -->
    <?php $page_name = "posts"; ?>
    <?php include_once "./inc/aside.html"; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/art-template/template-web.js"></script>
  <script src="../assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>
  <script>NProgress.done()</script>
  <script>

      // 定义处理事件的过滤器函数
    template.defaults.imports.formatdate = function ( created ) {
      var r = /(\d+)\-(\d+)\-(\d+)\s+\d+:\d+:\d+/;
      var m = r.exec( created );
      return m[ 1 ] + '/' + m[ 2 ] + '/' + m[ 3 ];
    };
  

    // 封装 load_category: 用于加载分类数据
    function load_category() {
      $.get( './api/getallcategories.php', function ( json ) {
        if ( json.success ) {
          $( '#category' ).html( template( 'category_select_tpl', {
            list: json.result
          } ) );
        }
      } );
    }

    
      //封装 load_data:用于加载表格

      function load_data( search ) {
      search = search || {};
      $.get( './api/getposts.php', search, function ( json ) {
        if ( json.success ) {
          var html = template( 'post_list_tpl', {
            list: json.result
          } );

          $( '#post_table tbody' ).html( html );
        } else {
          alert( '加载数据未成功, 请联系管理员' );
        }
      } );
    }

  // 封装 load_pagination: 用于加载处理分页的 标签
  function load_pagination() {
      // 发送请求, 获得对应的 总数
      // alert( $( '#filter_form_id' ).serialize() );
      $.get( './api/getpostcount.php', $( '#filter_form_id' ).serialize(), function ( json ) {
        // 首先计算总页数
        var totlepage = Math.ceil( json.count / 10 );
        var visualpage = totlepage > 5 ? 5 : totlepage;
        
        
        $('.pagination').twbsPagination({
          totalPages: totlepage,
          visiblePages: visualpage,
          first: '首页',
          last: '末页',
          prev: '上一页',
          next: '下一页',
          onPageClick: function (event, page) {
            // 点击以后, 再次刷新数据用的
            // alert( '准备跳转到第 ' + page + ' 页' );
            var formdata = $( '#filter_form_id' ).serialize();
            load_data( formdata + '&pageindex=' + page );

          }
        });


      } );


    }

    // 页面加载后立即执行
    $( function () {
      load_data();
      load_category();
      load_pagination();
    } );


    // 处理筛选表单的提交
    $( function () {
      $( '#filter_form_id' ).submit( function () {
        // 取出用户输入的数据
        var formdata = $( this ).serialize();
        
        load_data( formdata );

        load_pagination();


        return false;
      } );
    } )



  </script>
</body>
</html>
