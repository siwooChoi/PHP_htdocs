<?php
  class TestClass{
    public $value1 = 10;

    function __construct(){
      print $this->value1.' ....asdasdd..<br>';
    }

    function printnum(){
      echo "$this->value1 을 출력하고 싶다 ㅁㄴㅇㄹ<br>";
    }


  }

  $tc = new TestClass();
  $tc->printnum();


?>
