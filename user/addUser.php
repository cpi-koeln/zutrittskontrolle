
<?php

//-----------HEAD-------------------------------------------//
ob_start(); //immer wenn später noch auf den header zugegriffen wird (weiterleitung oder cookie), braucht man den Befehl um die AUsgabe des Headers zu verzögern. endet mit ob_end_flush
$dir="../";  // zeigt ebene in der Ordnerstruktur an
$folder="schwimmbad";  //wird benötigt um in der Navbar/header das ausgewählte Menü zu markieren

include($dir."scr/header1_2.php"); // auf jeder Seite mit Ausgabe wird ein zweigeteilter Header benörift.
include($dir."init.php");   // hier wird die Datenbankverbindung hergestellt und weitere für jede Seite notwendige Einstellungen vorgenommen
include($dir."scr/header2_2.php"); // hier kommt der zweite Teil des Headers, der die Navbar beinhaltet
ob_end_flush();


if (!empty($_GET))
  {
    ?><div>
        <br>
        <h1 class="text-xl text-green-600">Benutzername ist schon vorhanden!</h1>
      </div>
    <?php
  };

?>

<form action="addedUser.php" method="post" id="form1">
  <br><br>

  <table class=" md:w-max table">
    <tbody>
      <tr>
        <th class="w-2/12">Name</th>
        <td>
          <input type="text" id="userName" name="userName" placeholder="" class=" border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600">
        </td>
      </tr>

          <tr><th class="invisible">x</th></tr>
      <tr>
        <th class="w-2/12">Ortsgruppe</th>
        <td>
          <input type="text" id="cat" name="cat" placeholder="" class=" border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600">
        </td>
      </tr>

          <tr><th class="invisible">x</th></tr>

        <tr>
          <th class="w-2/12">Passwort</th>
          <td>
            <input type="text" id="password" name="password" placeholder= "" class="border border-gray-400 appearance-none rounded w-full px-3 py-1  focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600">
          </td>
        </tr>

    </tbody>
  </table>
<br></br>
  <a href="user/addedUser.php">
  <button  class="items-center h-8 px-5 text-indigo-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-indigo-800">
        <span>  Neuen Benutzer einpflegen</span>
  </button>
  </a>
  </form>
<br>
<br>
