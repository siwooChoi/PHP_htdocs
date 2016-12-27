<?php

  require_once "211A.php";

  class B extends A {

    public $lastName;

    public function __construct($firstName, $lastName){

      parent::__construct($firstName);
      $this->lastName = $lastName;

    }


  }

 ?>
