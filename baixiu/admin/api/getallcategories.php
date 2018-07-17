<?php
require_once "./apifn.php";
$list=itcast_query("SELECT * FROM categories");

header( "Content-Type: application/json; charset=utf-8" );

echo json_encode(array(
  "success"=>count($list)>0,
  "result"=>$list
));
?>