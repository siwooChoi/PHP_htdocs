<?php

  require_once "212B.php";

  class C extends B{
    public $age;
    public function __construct($firstName, $lastName, $age){
        parent::__construct($firstName, $lastName);
        $this->age = $age;
    }

    public function show(){
      print "firstName = {$this->firstName} <br>";
      print "lastName = {$this->lastName} <br>";
      print "age = {$this->age} <br>";
    }


  }


?>
