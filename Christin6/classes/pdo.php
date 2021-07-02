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
    }
