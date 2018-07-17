<?php
require_once "./apifn.php";

/**
 * 获得用户传入的数据
 */
// isset, empty, array_key_exists
$where = array();
if ( !empty( $_GET[ "category" ] ) ) {
    $where[] = "t2.category_id=" . $_GET[ "category" ];
} 
if ( !empty( $_GET[ "status" ] ) ) {
    $status = $_GET[ "status" ];
    $where[] = "t2.`status` = '$status'";
} 

/**
 * 处理 sql 语句
 */
$sql = "SELECT 
    COUNT( * )
FROM 
users AS t1 
INNER JOIN 
posts AS t2 
    ON t1.id = t2.user_id 
INNER JOIN 
categories AS t3 
    ON t2.category_id = t3.id";

// $sql .= "WHERE ....";
if ( count( $where ) > 0 ) { // 有参数
    $sql .= "\nWHERE " . join( " AND ", $where );
}

/**
 * 执行 sql 语句
 */
$count = itcast_get_single_value( $sql );

/**
 * 返回 json
 */
header( "Content-Type: application/json; charset=utf-8" );
echo json_encode(array(
    "count" => $count
));

?>