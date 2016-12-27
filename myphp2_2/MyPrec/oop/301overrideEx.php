<?php
  class SamCls{
    private $values = array();
    public function disp(){
      print "<pre>";

       print_r($this->values);   // print_r  <--- 배열의 값을 출력해준다.

      print "</pre>";
    }

    public function __set($name, $value){   // 정의하지 않은 프로퍼티를 사용하고자 하면 설정된다.
      print "{$name}에 {$value}를 설정함. <br>";
      $this->values[$name]=$value;    // 연관배열이 됨
    }

    public function __get($name){
      print "{$name}의 값은 {$this->values[$name]} 이다.";
      return $this->values[$name];
    }




  }


?>
