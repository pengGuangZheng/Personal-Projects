<?php


require_once "./apifn.php";

// 该文件: 获得文章与用户与分类的数据, 最后返回一个 json 

/**
 * 获得用户传入的数据
 */
// 此时需要提供的参数有
// 分类的 id, 与状态的 字符串
// 我们使用数组来存储传入的参数信息

// isset, empty, array_key_exists
$where = array();
if ( !empty( $_GET[ "category" ] ) ) {
    // 有参数 
    $where[] = "t2.category_id=" . $_GET[ "category" ];
} 

if ( !empty( $_GET[ "status" ] ) ) {
    // 有参数
    $status = $_GET[ "status" ];
    $where[] = "t2.`status` = '$status'";
} 

// 获得用户传入的 pageindex 与 pagesize
// 实际开发 这个参数是要做校验的
// ( 例如 pageindex = -1, 本来数据只有 100 条, pageindex = 1000 )
if ( isset( $_GET[ "pageindex" ] ) ) {
    $pageindex = $_GET[ "pageindex" ];
} else {
    $pageindex = 1;
}

if ( isset( $_GET[ "pagesize" ] ) ) {
    $pagesize = $_GET[ "pagesize" ];
} else {
    $pagesize = 10; // 如果没有提供 每页的条数, 就使用默认 10 条
}



/**
 * 处理 sql 语句
 */
$sql = "SELECT 
t2.id
, t2.title
, t1.nickname
, t3.`name`
, t2.created
, t2.`status`
, t2.category_id
FROM 
users AS t1 
INNER JOIN 
posts AS t2 
    ON t1.id = t2.user_id 
INNER JOIN 
categories AS t3 
    ON t2.category_id = t3.id";


// 最终我们如果没有参数, 什么也不做, 直接使用上述 slq 语句
// 如果有参数, 应该执行一段代码
// $sql .= "WHERE ....";
if ( count( $where ) > 0 ) { // 有参数
    $sql .= "\nWHERE " . join( " AND ", $where );
}


// 添加排序
$sql .= " ORDER BY id "; 



// 处理分页的 部分
$tmp = ( $pageindex - 1 ) * $pagesize;
$sql .= "\nLIMIT $tmp, $pagesize";

// var_dump( $sql );
// exit;


/**
 * 执行 sql 语句
 */
$list = itcast_query( $sql );



/**
 * 返回 json
 */
header( "Content-Type: application/json; charset=utf-8" );
echo json_encode(array(
    "success" => count( $list ) > 0,
    "result" => $list
));

?>