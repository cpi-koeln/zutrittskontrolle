<?php
$dir="../";
$folder="benutzerVerwalten";
include($dir."scr/header1_2.php");
include($dir."init.php");
include($dir."scr/header2_2.php");


?>

<form action="loggedIn.php" method="post" id="form1">

  <div class="bg-white shadow-md rounded px-8 my-8 pt-6 pb-8 mb-4 flex flex-col">
    <div class="mb-4">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
        Benutzername
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="username" id="username" type="text" placeholder="Username">
    </div>
    <div class="mb-6">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
        Passwort
      </label>
      <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" name="password" id="password" type="password" placeholder="******************">
    </div>
    <div class="flex items-center justify-between">
      <a href="user/loggedIn.php">
      <button  class="items-center h-8 px-5 text-indigo-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-indigo-800">
            <span>  Einloggen</span>
      </button>
      </a>
    </div>
</div>
</form>
</main>
</html>
