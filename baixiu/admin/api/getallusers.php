<?php

//反回所有用户数据
require_once "./apifn.php";

$list=itcast_query("SELECT * FROM users");
//拿到一个二维数组
header("Content-Type:application/json;charset=utf-8");
echo json_encode(array(
  "success"=>true,
  "result"=>$list
));

?>