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
        $results=$cmd->fetchALL(PDO::FETCH_CLASS,"mtgl");

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

 function addUser($userName,$refOgId,$userPass)
                   {
                     $cmd=$this->pdo->prepare('INSERT INTO
                     tblUser
                     (userName,refOgId,userPass)
                     VALUES
                     (?,?,?)
                     ');
                     $cmd->execute([$userName,$refOgId,$userPass]);
                   }


 function fetchMtglById($checkId) //mediorg
                 {
                   $cmd=$this->pdo->prepare("SELECT *
                   FROM
                   tblCheck

                   WHERE checkId=?
                   ");
                   $cmd->execute([$checkId]);             // führt die Abfrage, die oben prepared wurde aus
                   //$results=$cmd->fetchALL();
                   $results=$cmd->fetchALL(PDO::FETCH_CLASS,"mtgl");
                    return $results;
                 }


 function change($table,$name,$idName,$id,$wert)
                         {
                           $cmd=$this->pdo->prepare("UPDATE
                           $table
                            SET
                            $name=?
                             WHERE
                             $idName=$id
                           ");

                           $cmd->execute([$wert]); // führt die Abfrage, die oben prepared wurde aus


                         }


 function deleteEntry($tabelle,$name,$wert)
                 {
                   $cmd=$this->pdo->prepare("DELETE FROM
                       $tabelle
                     WHERE $name=?
                   ");
                   $cmd->execute([$wert]);
                 }

function addMtgl($vorname,$nachname,$nummer,$bezahlt,$og)//$ArtID,$MatID,$KatID,$BezID,$HbeID,$FarID,$VerID,$HekID,$VpeID)
               {
                 $typeBezahlt=gettype($bezahlt);
                 if ($typeBezahlt=="string")
                  {
                    $cmd=$this->pdo->prepare('INSERT INTO
                        tblCheck
                        (mitCNr,bezahltBis,bezahlt,checkVoN,checkNaN,checkOg)
                        VALUES
                        (?,?,?,?,?,?)
                        ');

                      $wert=array($nummer,$bezahlt,0,$vorname,$nachname,$og); //Null zu AnmId ändern
                      $cmd->execute($wert); // führt die Abfrage, die oben prepared wurde aus
                  }
                elseif($typeBezahlt=="integer")
                  {
                    $cmd=$this->pdo->prepare('INSERT INTO
                        tblCheck
                        (mitCNr,bezahltBis,bezahlt,checkVoN,checkNaN,checkOg)
                        VALUES
                        (?,?,?,?,?,?)
                        ');

                      $wert=array($nummer,"",$bezahlt,$vorname,$nachname,$og); //Null zu AnmId ändern
                      $cmd->execute($wert); // führt die Abfrage, die oben prepared wurde aus

                  }

                 $cmd2=$this->pdo->prepare("SELECT LAST_INSERT_ID()");
                 $cmd2->execute(); // führt die Abfrage, die oben prepared wurde aus
                 $results=$cmd2->fetchAll();  // gibt das Ergebnis der Abfrage als Array aus

                 return $results[0][0];


               }





















}
