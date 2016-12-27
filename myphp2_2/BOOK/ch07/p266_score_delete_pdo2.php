<?php

  require_once = 'DBManager';

  try{
    $dbo = connect();
  }catch(PDOexception $e){
    exit ("실패 {$e -> getMessage()})";
  }


 ?>
