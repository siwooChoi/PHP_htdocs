<?php
  class Loader{
    protected $_directories = array();

    public function regDirectory($dir) {
      // echo $dir." &nbsp&nbsp&nbsp&nbsp이것은 dir이다 <br>";

      //  "C:\xampp\htdocs\weblog.localhost_finish/mvc"
      //  "C:\xampp\htdocs\weblog.localhost_finish/model"    이라는 값이 매개변수로 넘어온다.
      $this->_directories[] = $dir;
    }

    public function register() {
      // var_dump($this)."<br>";
      spl_autoload_register(array($this, 'requireClsFile'));
      // spl_autoload_register(array($this, 'requireClsFile'));
      // spl_autoload_register()    // 지정한 함수를 autoload의 구현으로서 등록한다
      //  __autoload() 는 한번밖에 정의할 수 없다.
      //  spl_autoload_register() 여러번의 autoload함수가 필요할 때에 사용한다.
      // http://php.net/manual/kr/function.spl-autoload-register.php

    }

    public function requireClsFile($class) {
      // echo "<br>".$class."&nbsp&nbsp&nbsp&nbsp&nbsp <-- $class의 값<br>";
      foreach($this->_directories as $dir) {

        $file = $dir . '/' . $class . '.php';
      // $file =  "C:\xampp\htdocs\weblog.localhost_finish/mvc/test.php"
        if(is_readable($file)) {
          require $file;
          return;
        }
      }
    }
  }

 ?>
