<?php

require_once "./apifn.php";
// 接收用户传入的数据, 拼接 update 的 sql 语句, 执行返回 json 成功与否
// 注意: 实际开发时会对参数校验

$id=$_POST["id"];
$email=$_POST["email"];
$nickname=$_POST["nickname"];
$password=$_POST["password"];
$slug=$_POST["slug"];

$isTrue=itcast_nonquery("UPDATE users SET email='$email', nickname='$nickname', `password`='$password', slug='$slug' WHERE id=$id");
header("Content-Type:application/json;charset=utf-8");

echo json_encode(array(
  "success"=>$isTrue
));

?>