<?php
ob_start();
$dir="../"; // Festlegen des aktuellen Pfads um die richtige Adressen für die Navbar zu generieren

include($dir."init.php");

$idString=$_POST["checks"];
$ids=explode(",",$idString);
foreach ($ids as $id)
  {
    $pdo->deleteEntry("tblCheck","checkId",$id);

  };
header("Location: ../verwalten/uebersicht.php");
die();
ob_end_flush();
?>
