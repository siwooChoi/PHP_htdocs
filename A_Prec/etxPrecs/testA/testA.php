<?php
  require_once "../testB/testB.php";

  class A{

    function __construct(){
      print "A생성자 생성되었음<br>";
      $this->throwValue();
    }


    function throwValue(){

      $start = "start";
      print "<script> location.replace('./use.php?getValue=$start'); </script>";
    }


  }



 ?>
