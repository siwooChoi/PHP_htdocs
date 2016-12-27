<?php
  require_once "./testpro.php";

  class test{
    //control 역할



  static $teststatic = Array();
  static $iCount = 0;


    function __construct(){
      //배열 0번의 값은  0
      SELF::$teststatic[SELF::$iCount] = SELF::$iCount;

      echo "iCount의 숫자는 : ".SELF::$iCount." <br>";
      SELF::$iCount++;
    }

    function insertArr(){




    }

  }

?>
