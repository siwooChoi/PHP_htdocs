<?php

  function connect() {
    $dbset = 'mysql:host=localhost; dbname=syu_db; charset=utf8';
    $dbuser = 'root';
    $dbpass = '0000';

    try{
      $db = new PDO($dbset, $dbuser, $dbpass);
    } catch(PDOException $e){
      exit("접속불가 {$e->getMessage()}");
    }

    return $db;
  }






 ?>
