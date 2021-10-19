<?php
ob_start();
$dir="../";
include($dir."init.php");


$useId=$_POST["useId"];

$useName=$_POST["userName"];
$useVoN=$_POST["userVorname"];
$useNaN=$_POST["userNachname"];

if(empty($_POST["admin"]))
  {
    $useAdmin=0;
  }
else
  {
    $useAdmin=1;
  };

if(empty($_POST["lagerverwaltung"]))
  {
    $useLager=0;
  }
else
  {
    $useLager=1;
  };

if(empty($_POST["checken"]))
  {
    $useCheck=0;
  }
else
  {
    $useCheck=1;
  };


$userPassword=$_POST["password"];


$useId2=$pdo->get("useId","tblUser","useName",$useName);



$usePass=password_hash($userPassword,PASSWORD_DEFAULT);


$pdo->update("tblUser","useId",$useId,"useName",$useName);

$pdo->update("tblUser","useId",$useId,"usePass",$usePass);
$pdo->update("tblUser","useId",$useId,"useVoN",$useVoN);
$pdo->update("tblUser","useId",$useId,"useNaN",$useNaN);
$pdo->update("tblUser","useId",$useId,"useAdmin",$useAdmin);
$pdo->update("tblUser","useId",$useId,"useLager",$useLager);
$pdo->update("tblUser","useId",$useId,"useCheck",$useCheck);


header("Location: ../index.php");
die();




ob_end_flush();
