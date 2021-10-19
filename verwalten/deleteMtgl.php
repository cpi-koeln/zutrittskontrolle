<?php
ob_start();
$dir="../"; // Festlegen des aktuellen Pfads um die richtige Adressen für die Navbar zu generieren

include($dir."init.php");


$id=$_GET["id"]; // geht auch mit Cookie-->mehrwert?
$pdo->deleteEntry("tblCheck","checkId",$id);
header("Location: ../verwalten/uebersicht.php");
die();
ob_end_flush();
?>
