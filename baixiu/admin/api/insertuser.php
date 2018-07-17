<?php

require_once "./apifn.php";

// 获得用户传入的参数
//拼接sql语句,插入数据库

$email=$_POST["email"];
$nickname=$_POST["nickname"];
$password=$_POST["password"];
$slug=$_POST["slug"];

$istrue=itcast_nonquery("INSERT INTO users(email, nickname, `password`, slug, `status`) VALUES('$email', '$nickname', '$password', '$slug', 'activated' ); ");

//返回json

header("Content-Type:application/json;charset=utf-8");
echo json_encode(array(
  "success"=>$istrue
));

?>