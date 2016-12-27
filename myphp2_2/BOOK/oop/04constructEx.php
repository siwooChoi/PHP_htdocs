<?php
  class Calculate{
    public $tax;

    public function __construct($tax) { //  class Calculate 의 생성자.
      $this->tax = $tax;    // $없는tax 는 위쪽의  public $tax.  $있는tax 는 매개변수 $tax
    }

    public function taxCalc($price){
      return $price * (1+$this->tax);
    }
  }
?>
