<?php
  class SampleC{
    private $values = array();
    public function disp(){
      print "<pre>";
      print_r($this->values);
      print "</pre>";

    }

    public function __set($name, $value){   // 정의하지 않은 프로퍼티를 사용하고자 하면 설정된다.
      print "{$name}에 {$value}를 설정함. <br>";
      $this->values[$name]=$value;    // 연관배열이 됨
    }

    public function __get($name){

      if(!isset($this->values[$name])){
        print "{$name}는 존재한다. <br>";
      } else{
        print "{$name}의 값은 {$this->values[$name]} 이다.";
        return $this->values[$name];
      }
    }

    public function test_0(){
      return $this->values['mem'];
    }

    public function test_1($val1){
      $this->values['mem']=$val1;
    }

    public function test_2($val1, $val2){
      $this->values['mem']=$val1 .">>>".$val2;
    }

    public function __isset($name){
      return empty($this->values[$name]);  // empty 값이 비어있는지 확인하는 함수
    }

    public function __unset($name){
      unset($this->values[$name]);
    }

    public function __call($name, $param){
      // // $name :  호출한 함수이름
      // // $param :  인수리스트배열
      // if(count($param)==0){ // $name()
      //   return $this->values[$name];
      // } else{
      //   if(count($param)==1)
      //   $this->values[$name]=$param[0]; //$name($param)
      //   if(count($param)==2)
      //   $this->values[$name]=$param[0]." ".$param[1];
      // }
      if($name='test'){
        if(count($param)==0) {
          return $this->test_0();
        } else if(count($param)==1){
          $this->test_1($param[0]);
        } else{
          $this->test_2($param[0], $param[1]);
        }


          return empty($this->values[$name]);
      }

    }


  }
?>
