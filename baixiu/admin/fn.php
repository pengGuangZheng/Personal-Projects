<?php

require_once "./config.php";

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

?>