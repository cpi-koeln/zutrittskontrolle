<?php

require __DIR__."/classes/pdo.php";

$host_name = 'localhost';
$database = 'zutrittskontrolle';
$user_name = 'root';
$password = 'test';
 $pdo = null;

/*
$host_name = 'db5003301641.hosting-data.io';
$database = 'dbs2668596';
$user_name = 'dbu2464623';
$password = 'rCUb2GXz982kJpW';
 $pdo = null;
*/
 try {
   $pdo = new pdo1($host_name,$database, $user_name, $password);
 } catch (PDOException $e) {
   echo "Fehler!: " . $e->getMessage() . "<br/>";
   die();
 }
if(!empty($_COOKIE["userName"]))
 {
   $userName=$_COOKIE["userName"];
   $user=$pdo->fetchUser($userName);
 };
?>
