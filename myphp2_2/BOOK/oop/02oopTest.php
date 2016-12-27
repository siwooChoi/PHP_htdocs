<?php
  class Test {
    public $number;

    public function calc($argN1, $argN2){
      $this->number=$argN1 + $argN2;

      // $this : 현재 자신 객체
      // -> : 객체 참조 연산자. (자바에서 . 과 같은 의미)
      // 객체 참조시 프로퍼티 앞에 $를 적지 않음

    }

  }



?>
