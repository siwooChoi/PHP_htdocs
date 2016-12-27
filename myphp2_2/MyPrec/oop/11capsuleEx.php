<?php

  class CapsuleCls {
    const PI = 3.14;
    private $radius; //반지름
    private $height; //높이

    public function setRadius($r){
      $this->radius = $r;
    }

    public function setHeight($h){
      $this->height = $h;
    }

    public function getRadius(){
      return $this->radius;
    }

    public function getHeight(){
      return $this->height;
    }

    public function calcVolume(){
      $area = pow($this->radius,2)*self::PI;
      return $area * $this->height/3;   // (콘)원뿔 형의 부피구하는 공식
    }

  }


?>
