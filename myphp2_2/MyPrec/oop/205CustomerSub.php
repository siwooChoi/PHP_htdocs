<?php

  require_once "204Customer.php";

  class CustomerSub extends Customer {
    public function show($name, $country) {
        print "(오버라이딩된것임) 이름은 $name 이며 <br>";
        print "(오버라이딩된것임) 국적은 $country 이다. <br>";
    }
  }

?>
