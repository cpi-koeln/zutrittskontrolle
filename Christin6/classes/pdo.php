<?php

class pdo1
{
public $hostName;
public $database;
public $userName;
public $password;

public function __construct ($hostName,$database,$userName,$password)
      {
        $this->hostName=$hostName;
        $this->database=$database;
        $this->userName=$userName;
        $this->password=$password;
        $this->pdo=null;

    try
      {
        $this->pdo = new PDO("mysql:host=$hostName; dbname=$database;charset=utf8", $userName, $password);
      }
      catch (PDOException $e)
        {
          echo "Fehler!: " . $e->getMessage() . "<br/>";
          die();
        }
      }

function getAllActive($table)
      {
        $cmd=$this->pdo->prepare("SELECT *
          FROM $table
        ");
        $cmd->execute();
        $results=$cmd->fetchALL();

         return $results;

      }


function get($id,$tabelle,$name,$wert,$notUnique=false)
                { 
                   $cmd=$this->pdo->prepare("SELECT
                   $id
                   FROM
                   $tabelle
                   WHERE $name=?
                   ");

                   $cmd->execute([$wert]); // führt die Abfrage, die oben prepared wurde aus

                   $results=$cmd->fetchAll();  // gibt das Ergebnis der Abfrage als Array aus

                   if ($notUnique==false and !empty($results))
                    {

                      $results=$results[0][0];
                    };

                   return $results;
                }


function fetchUser($userName)
        {
          $cmd=$this->pdo->prepare("SELECT *
            FROM
            tblUser
            WHERE userName=?
            ");

            $cmd->execute([$userName]);

            $results=$cmd->fetchALL(PDO::FETCH_CLASS,"user");
             return $results[0];
           }



function update($table,$bedingungName,$bedingungWert,$name,$wert)
               {
                 $cmd1=$this->pdo->prepare("UPDATE
                   $table
                   SET $name = ?
                   WHERE $bedingungName = $bedingungWert
                   ");

                 $cmd1->execute([$wert]);
               }

 function addUser($userName,$userCatId,$userPass)
                   {
                     $cmd=$this->pdo->prepare('INSERT INTO
                     tblUser
                     (userName,userCat,userPass)
                     VALUES
                     (?,?,?)
                     ');
                     $cmd->execute([$userName,$userCatId,$userPass]);
                   }

































}
