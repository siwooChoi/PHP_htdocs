<?php

  abstract class Test2{
    public $value1 = 10;



    public function callValue1(){
      // echo "value1의 값은 : ".$value1." 이다.";
      echo "value1의 값은 : ".$this->value1." 이다.";
    }

    abstract function tt();




  }
?>
