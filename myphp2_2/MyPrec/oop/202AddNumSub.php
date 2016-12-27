<?php
  require_once "201AddNumber.php";

  class AddNumSub extends AddNumber{
    private $record;

    public function getRecord(){
      return $this->record;
    }

    public function record(){
      $this->record = $this->num;
    }



  }

?>
