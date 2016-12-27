<?php
  require_once '219interfaceEx1.php';
  require_once '220interfaceEx2.php';

  class SubC2 extends SuperC2 implements ISample {
    public function Multi($n){
      if(self::NUM > $n) {
        $this->val = $n * 3;
      } else {
        $this->val = $n;
      }
    }

    public function Divi($n){
      if(ISample::NUM < $n) {
        $this->val = $n/2;
      } else {
        $this->val = $n;
      }
    }



  }

?>
