<?php
  class TestModel extends ExecuteModel {

  //   public function Testprint_model($argValue1, $argValue2){
  //
  //     $sql = "SELECT *
  //             FROM   user
  //             WHERE  id = :user_id_number";
  //
  //     $userData = $this->getRecord(
  //                       $sql,
  //                       array(':user_id_number' => $argValue1));
  //
  // // getRecord(); 추상 클래스 ExecuteModel의 메소드
  //
  //     if(($argValue1 + $argValue2) == 10){
  //       $result = $argValue1 + $argValue2;
  //       return $result;
  //     } else {
  //       return $userData;
  //     }
  //   }

    public function testModel_rowCount(){
      $nonearray = array();
      $sql = "select * from user";
      $stt = $this->execute($sql, $nonearray);


      $rowCountValue = $stt->rowCount();
      return  $rowCountValue;
      // echo $rowCountValue;
    }


  }
 ?>
