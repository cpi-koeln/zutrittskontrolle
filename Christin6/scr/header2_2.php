<?php
include($dir."scr/js/allgemein.js");
$liClassPassiv="h-14 sm:border-b border-gray-900 flex-1 sm:w-full";
$liClassActive="bg-gray-600 h-14 sm:border-b border-gray-900 flex-1 sm:w-full";

if($folder=="index")
  {
    $liIndexClass=$liClassActive;
  }
else
  {
    $liIndexClass=$liClassPassiv;
  };

if($folder=="verwalten")
  {
    $liVerwaltungClass=$liClassActive;
  }
else
  {
    $liVerwaltungClass=$liClassPassiv;
  };

if($folder=="schwimmbad")
  {
    $liBahnenClass=$liClassActive;
  }
else
  {
    $liBahnenClass=$liClassPassiv;
  };




 ?>
</head>
<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
<section class="h-screen w-screen bg-gray-200 flex flex-col-reverse sm:flex-row min-h-0 min-w-0 overflow-hidden">
  <aside class="sm:h-full sm:w-32 w-full h-12 bg-gray-800 text-gray-200">
    <ul class="text-center flex flex-row sm:flex-col w-full">
      <li class='<?php echo $liIndexClass;?>'>
        <a id="" href=<?php echo $dir."index.php";?> class="h-20 block p-3 hover:bg-gray-500">
          <i class="my-3 fas fa-2x fa-search"></i>
        </a>
      </li>
      <?php
      if (!empty($user)){?>
      <li class='<?php echo $liBahnenClass;?>' title="Bahnen">
        <a id="" href=<?php echo $dir."schwimmbad/uebersicht.php";?>  class="h-20 w-full hover:bg-gray-500 block p-3">
            <i class="my-5 fas fa-2x  fa-swimming-pool"></i>
        </a>
      </li>

      <li class='<?php echo $liVerwaltungClass;?>' title="Mitgliederverwaltung">
        <a id="" href=<?php echo $dir."verwalten/uebersicht.php";?> class="h-20 w-full hover:bg-gray-500 block p-3">
            <i class="my-3 fa-2x fas fa-tasks"></i>
        </a>
      </li>
    <?php };?>

    </ul>
  </aside>
  <main class="sm:h-full flex-1 flex flex-col min-h-0 min-w-0 overflow-auto">
    <nav class="border-b bg-gray-200 px-6 py-12 flex items-center min-w-0 h-14">
      <div><a href='<?php echo $dir."index.php";?>'> <img class="object-contain h-24 w-full" src='<?php echo $dir."pic/logo.png";?>'></a></div>
      <span class="flex-1"></span>



      <button id="userMenu" class="ml-auto border rounded-full ml-2 w-20 h-20 text-center leading-none text-gray-200 bg-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
          <i class="fas fa-user fa-2x fill-current"></i>
        </button>

        <div id=dropDownUser x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="hidden absolute right-0 w-full mt-40 mr-6 origin-top-right rounded-md shadow-lg md:w-48">
          <div class="  px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">

            <?php if (empty($user)){?>
                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href='<?php echo $dir."user/logIn.php"?>'>Login</a>
              <?php }
              else {
                if($user->userCat=="1")
                {?>
                  <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href='<?php echo $dir."user/addUser.php"?>'>Neuen Benutzer hinzufügen</a>
                <?php };?>

                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href='<?php echo $dir."user/changePassword.php"?>'>Passwort ändern</a>
                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href='<?php echo $dir."user/logOut.php"?>'>Logout</a>
              <?php }; ?>
          </div>
        </div>
    </nav>
