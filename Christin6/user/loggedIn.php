<?php

ob_start();
$dir="../";
include($dir."init.php");

$useName=$_POST["username"];
$usePassword=$_POST["password"];
$validPassHash=$pdo->get("userPass","tblUser","userName",$useName);

if(password_verify($usePassword,$validPassHash))
  {
    setcookie("userName",$useName,time()+36000,"/");
    header("Location: ../index.php");
    die();

  }
else
  {
    header("Location: logIn.php");
    die();
  }
;
ob_end_flush();
