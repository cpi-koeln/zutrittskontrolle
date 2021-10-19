<?php
ob_start();
$dir="../";
include($dir."init.php");





$oldPass=$_POST["oldPass"];
$newPass1=$_POST["NewPassword1"];
$newPass2=$_POST["NewPassword2"];

if ($newPass1<>$newPass2)
  {
    header("Location: changePassword.php?grund=keineUebereinstimmung");
    die();
  }
elseif(!password_verify($oldPass,$user->userPass))
  {
    header("Location: changePassword.php?grund=falschesPasswort");
    die();
  }
else
  {
    $newPassHash=password_hash($newPass1,PASSWORD_DEFAULT);
    $pdo->update("tblUser","userId",$user->userId,"userPass",$newPassHash);
    header("Location: ".$dir."/index.php");
    die();
  };

ob_end_flush();
?>
