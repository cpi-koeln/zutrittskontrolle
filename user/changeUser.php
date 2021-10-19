<?php
//-----------------------HEAD---------------------//
$dir="../";

$folder="benutzerVerwalten";
include($dir."scr/header1_2.php");
include($dir."init.php");
include("scr/js/addUser.js");
include($dir."scr/header2_2.php");

//---------------------BODY----------------------//
$useName=$_GET["useName"];
$user=$pdo->fetchUser($useName);

$admin="";
$lager="";
$check="";
if($user->useAdmin==1)
  {
    $admin="checked";
  };

if($user->useLager==1)
  {
    $lager="checked";
  };

if($user->useCheck==1)
  {
    $check="checked";
  };
?>

<form action="changedUser.php" method="post" id="form1">
  <input   type="hidden" name="useId" value='<?php echo $user->useId;?>'>
  <table class=" text-left mt-10 md:w-max table">
    <tbody>
      <tr class="h-12">
        <th class="">Benutzername</th>
        <td>
          <input value='<?php echo $user->useName;?>' type="text" id="userName" name="userName" placeholder="" class=" border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600">
        </td>
      </tr>

      <tr class="h-12">
        <th class="">Vorname</th>
        <td>
          <input value='<?php echo $user->useVoN;?>'  type="text" id="userVorname" name="userVorname" placeholder= "" class="  border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600">
        </td>
      </tr>

      <tr class="h-12">
        <th class="">Nachname</th>
        <td>
          <input value='<?php echo $user->useNaN;?>'type="text" id="userNachname" name="userNachname" placeholder= "" class="border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600">
        </td>
      </tr>

      <tr class="h-12">
          <th>Admin (alle Rechte)</th>
          <td>
            <input type="checkbox" class="form-checkbox h-5 w-5"  <?php echo $admin;?> id="admin" name="admin">
          </td>
      </tr>

      <tr class="h-12">
          <th>Lagerverwaltung</th>
          <td>
            <input type="checkbox" class="form-checkbox h-5 w-5"  <?php echo $lager;?>  id="lagerverwaltung" name="lagerverwaltung">
          </td>
      </tr>

      <tr class="h-12">
          <th>Checken & Nachfüllen</th>
          <td>
            <input type="checkbox"  class="form-checkbox h-5 w-5 " <?php echo $check;?>  id="checken" name="checken">
          </td>
      </tr>

      <tr class="h-12">
        <th class="">Initialpasswort</th>
        <td>
          <input type="text" id="password" name="password" placeholder= "" class="border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600">
        </td>
      </tr>
    </tbody>
  </table>
  <a href="user/changedUser.php">
    <button  class="items-center h-8 px-5 text-indigo-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-indigo-800">
          <span>  Benutzerdaten aktualisieren</span>
    </button>
  </a>
</form>
