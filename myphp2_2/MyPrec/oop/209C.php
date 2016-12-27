<?php

  require_once "208B.php";

  class C extends B{
    public function show() {
      print 'C클래스의 show()메소드 실행 <br>';
      parent::show();
    }

    
  }


 ?>
