<?php
//-----------HEAD-------------------------------------------//
ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="user";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren

include($dir."scr/header1_2.php"); // auf jeder Seite mit Ausgabe wird ein zweigeteilter Header benörift.
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
include($dir."scr/header2_2.php"); // hier kommt der zweite Teil des Headers, der die Navbar beinhaltet



$userName=$_POST["userName"];
$userOg=$_POST["cat"];
$userPassword=$_POST["password"];


$useId=$pdo->get("userId","tblUser","userName",$userName);

if (empty($useId))
  {
    $userPass=password_hash($userPassword,PASSWORD_DEFAULT);
    $userOgId=$pdo->get("ogId","tblOg","namOg",$userOg);
    $pdo->addUser($userName,$userOgId,$userPass);

    header("Location: ../index.php");
    die();
  }
else
  {
    header("Location: addUser.php?grund=NameVergeben");
    die();
  };
ob_end_flush();
