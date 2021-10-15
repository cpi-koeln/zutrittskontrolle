
<?php

$dir="../";
$folder="benutzerVerwalten";
include($dir."scr/header1_2.php");
include($dir."init.php");
include($dir."scr/header2_2.php");


if(!empty($_GET))
  {
    $grund=$_GET["grund"];
    if($grund=="keineUebereinstimmung")
      {
        echo "<h1>Die beiden neuen Passwörter stimmen nicht überein! </h1>";
      }
    elseif($grund=="falschesPasswort")
      {
        echo "<h1>Das alte Passwort ist falsch! </h1>";
      };

  };


// zum Prüfen auf Passwortvorgaben Affenformular einrichten
?>

<form action="changedPassword.php" method="post" id="form1">

  <div class="bg-white shadow-md rounded px-8 my-8 pt-6 pb-8 mb-4 flex flex-col">
    <div class="mb-4">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
        Altes Passwort
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="oldPass" type="password"   placeholder="altes Passwort">
    </div>
    <div class="mb-6">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
        Neues Passwort
      </label>
      <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" name="NewPassword1" type="password" placeholder="******************">
    </div>

    <div class="mb-6">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
        Neues Passwort wiederholen
      </label>
      <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" name="NewPassword2" type="password" placeholder="******************">
    </div>


    <div class="flex items-center justify-between">
      <a href="user/changedPassword.php">
      <button  class="items-center h-8 px-5 text-indigo-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-indigo-800">
            <span>  Passwort ändern </span>
      </button>
      </a>
    </div>
</div>
</form>
</main>
</html>
