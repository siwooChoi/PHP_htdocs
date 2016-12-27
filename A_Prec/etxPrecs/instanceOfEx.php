<?php

  class B{
    public function __construct(){
      echo "B생성됨<br>";
    }

    public function b_p(){
      echo "b에 있는 메서드<Br>";
    }
  }

  class A{
    public $a = "a";
    const A = 10;




    function __construct(){
      echo "A클래스 생성됨<br>";

      echo SELF::A."<br>";
    }

    function qqq(){
      echo "이렇게 쓰는건가보네<br>";
    }

    function c(){
      define("aaa", "bbb");
    }

    function p(){
      echo SELF::A."<br>";
    }

    public function __destruct(){
      echo "소멸인가?<br>";
    }
  }



?>
