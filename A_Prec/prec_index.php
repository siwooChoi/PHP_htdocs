<?php

    // control
  $model = new model();

  $poductArray = array();

    // 포문돌리면서  하나씩 값을 넣을 것?
    // 하나 값을 넣어서  포문돌려서 값을 넣을 것?

    // $model->test();
      echo "값을 넣었음asd<br>";

    // $model->outputValue();
    $poductArray[0][0] = "1";




    $model->inputValue($poductArray);


  class model{     // model

    public $valueArray;
    public $valueX;
    public $valueY;

    public function test(){
      echo "aaa";
    }

    public function __construct(){
      $this->valueArray = array();
      $this->valueX = 1;
      $this->valueY = 501;
    }

    public function inputValue($poductArray){
      for($x = 0; $x < 10; $x++){
        for($y = 0; $y < 10; $y++){
          $this->valueArray[$x][$y] = $this->valueY;
          $this->valueY++;
        }
      }
      echo "model의 배열에 값을 넣었음<br>";
      $this->inputValue2($poductArray);
    }



    public function inputValue2($poductArray){
      for($x = 0; $x < 10; $x++){
        for($y = 0; $y < 10; $y++){
          $poductArray[$x][$y] = $this->valueArray[$x][$y];
        }
      }
      echo "product의 배열에 값을 넣었음<br>";
      $this->outputValue($poductArray);
    }




    public function outputValue($poductArray){
      for($x = 0; $x < 10; $x++){
        for($y = 0; $y < 10; $y++){
          echo $poductArray[$x][$y]."&nbsp&nbsp&nbsp&nbsp";
        }
        echo "<br>";
      }
      echo "<br><br><br>되는건가!!?!?";
    }


        // public function outputValue($a){
        //
        // }
  }


?>
