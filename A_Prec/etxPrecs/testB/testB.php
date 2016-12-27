<?php

  print "testB";

class B{
  public $valueb;

  function __construct(){
    $this->valueb = 10;
  }

  function printBvalue(){
    print $this->valueb;
  }
}



?>
