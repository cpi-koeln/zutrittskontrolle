<?php
ob_start();
$dir="../";
include($dir."init.php");

var_dump("h");
setcookie("userName","",time()-3600,"/");
header("Location: ../index.php");
die();


ob_end_flush();
?>
