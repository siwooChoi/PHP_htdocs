<?php

  require_once "207A.php";

  class B extends A{

    // public function B(){
    //   print "생성자 B <br>";
    // }

    public function show() {
      print 'B클래스의 show()메소드 실행 <br>';
      parent::show();
    }
  }

?>
