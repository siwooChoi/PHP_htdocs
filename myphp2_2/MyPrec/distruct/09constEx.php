<?php
  class ConstCls {
    const PI = 3.14;    // 관례적으로 대문자로 하는 것이 좋다.

    public static function getCircleArea($radius){
      return pow($radius, 2) * self::PI;
    }

  }



 ?>
