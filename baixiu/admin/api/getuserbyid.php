<?php

require_once "./apifn.php";

$id=$_GET["id"];

$list=itcast_query("SELECT * FROM users WHERE id=$id");

header("Content-Type:applcation/json;charset=utf-8");

echo json_encode(array(
  "success"=>count($list)>0,
  "result"=>$list
));

?>