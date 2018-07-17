<?php
require_once "./apifn.php";

//接受用户传入的参数,拼接update SQL语句
//执行修改操作,返回执行结果
$email=$_POST["email"];
$slug=$_POST["slug"];
$nickname=$_POST["nickname"];
$avatar=$_POST["avatar"];
$bio=$_POST["bio"];

$isTrue=itcast_nonquery("UPDATE users SET avatar='$avatar',slug='$slug',nickname='$nickname',bio='$bio' WHERE email='$email' ");

// var_dump($isTrue);

header("Content-Type:application/json;charset=utf-8");
echo json_encode(array(
  "success"=>$isTrue
));



?>