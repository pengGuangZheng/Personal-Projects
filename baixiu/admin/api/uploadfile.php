<?php

//接收上传的文件,将其放到网站根目录下的uploads文件下
//它需要返回一个值(文件在服务器上的地址$path)
//约定上传的名字叫file
$file_info=$_FILES["file"];

//指纹计算文件名

$md5filename=md5_file($file_info["tmp_name"]);

//获得后缀名
$tem_arr=explode(".",$file_info["name"]);//获得数组文件名 后缀名
$ext=array_pop($tem_arr);

//生成最终在服务器上的路径
$path="../../uploads/".$md5filename.".".$ext;


//移动文件
move_uploaded_file($file_info["tmp_name"],$path);



//返回json数据
header("Content-Type:application/json;charset=utf-8");
echo json_encode(array(
  "success"=>true,
  "result"=>array(
    "image"=>"/uploads/".$md5filename.".".$ext
  )
));
?>