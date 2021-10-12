
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href='<?php echo $dir."scr/tailwindCSS/tailwind.min.css";?>' rel="stylesheet">
<script defer src='<?php echo $dir."scr/fa.15.3-web/js/all.js";?>'></script>
<script src='<?php echo $dir."scr/jquery/jquery-3.6.0.min.js";?>' type="text/javascript"></script>

<?php
ob_start();
// Datei wird von jeder Seite geladen und eröglicht das Autolaóading der Klassen
//Quelle : PHP-FIG-->PSR-4 Autoloader

require __DIR__."/autoload.php";
require __DIR__."/classes/pdo.php";
require __DIR__."/classes/user.php";

//require __DIR__."/scr/css/style.css";
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



//$user=$_SERVER['REDIRECT_REMOTE_USER']; online
//S$user=$_SERVER['PHP_AUTH_USER'];      localhost


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


//$pdo=new pdo1('localhost','dbs1059161','root','');   // generiert Datenbankzugriff?
ob_end_flush();
