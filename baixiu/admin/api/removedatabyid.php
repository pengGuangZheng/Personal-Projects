<?php

require_once "./apifn.php";


//根据传入的id删除数据

$id=$_GET["id"];

$isTrue=itcast_nonquery("DELETE FROM users WHERE id IN ($id) ");

header("Content-Type:application/json;charset=utf-8");

echo json_encode(array(
  "success"=>$isTrue
));

?>