<?php

require_once "./apiconfig.php";

// 查询语句, 返回一个 二维数组
function itcast_query ( $sql ) {

    $conn = mysqli_connect( DB_IP, USERNAME, PASSWORD, DB_NAME );
    $reader = mysqli_query( $conn, $sql );
    // 注意释放的问题
    $list = array();
    
    while( $item = mysqli_fetch_assoc( $reader ) ) {
        $list[] = $item;
    }

    mysqli_free_result( $reader );
    mysqli_close( $conn );
    return $list;
}


// 执行 非查询语句, 返回 布尔值
function itcast_nonquery( $sql ) {
    $conn = mysqli_connect( DB_IP, USERNAME, PASSWORD, DB_NAME );
    $isTrue = mysqli_query( $conn, $sql );
    mysqli_close( $conn );
    return $isTrue;
}



//专用术语 queryScalar
function itcast_get_single_value($sql){
    //专门用于查询聚合函数
    $conn = mysqli_connect( DB_IP, USERNAME, PASSWORD, DB_NAME );
    $reader = mysqli_query( $conn, $sql );
    
    $res = mysqli_fetch_row($reader);
    //得到一行数据.是数组

    mysqli_free_result( $reader );
    mysqli_close( $conn );
    return $res[0];
}


//封装 检查当前用户是否登录,同时获得当前用户信息
function check_login(){
    //一开始需要进行登录验证
    session_start();
    if(empty($_SESSION["current_user_login_id"])){
        header("Location:./login.php");
        exit;

    }
 // 在 登录成功后, 我们的 SESSION 中存储了当前用户的 id, 

 $current_user_login_id=$_SESSION["current_user_login_id"];
 $user_info=itcast_query("SELECT * FROM users where id=$current_user_login_id")[0];
 return $user_info;

}




?>