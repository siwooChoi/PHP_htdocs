<?php
  class StaticCls1 {

    public static $pi = 3.14;

    public static function getCircleArea($radius){
      return pow($radius,2) * self::$pi;
    }
  }



 ?>
