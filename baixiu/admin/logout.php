<?php

//删除session.跳转到login.php
// session_start();
// session_destroy();

// header("location:./login.php");
session_start();
session_destroy();
header("location:./login.php");


?>