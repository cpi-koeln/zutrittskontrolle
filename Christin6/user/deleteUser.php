<?php
ob_start();
$dir="../";
include($dir."init.php");


$useId=$_GET["useId"];

$pdo->deleteEntry("tblUser","useId",$useId);


header("Location: ".$dir."/user/overviewUser.php");
die();
ob_end_flush();
