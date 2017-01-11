<?php
  class Foo{
    static public function test($name){
      print '[['.$name.']]';
    }
  }
  spl_autoload_register('Foo::test');

?>
