<?php

  class AddNumber { // base class  =  parent class  = super class
    protected $num;
    public function add($num){
      $this->num += $num;
    }

    public function getNum(){
      return $this->num;
    }
  }




 ?>
