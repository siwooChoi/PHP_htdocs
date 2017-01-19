<?php
class ProductModel extends ExecuteModel {

  public function tt(){
    return 2;
  }

  // DB에서 상품이 총 몇개인지 판별
  public function selectProduct(){
    // $sql = "select * from product";
    // $stt
    // $stt->execute();
    // $rowCount = $stt->rowCount();
    //
    // return $rowCount;

    $nonearray = array();
    $sql = "select * from product";
    $stt = $this->execute($sql, $nonearray);

    $rowCountValue = $stt->rowCount();
    return  $rowCountValue;
  }

  ///////////////// 아래쪽은 아직 이 mvc에 맞도록 수정한 코드가 아님! /////////////////

    // search로 DB상품 찾기
  // public function selectProduct_search($search){
  //   $s = "%".$search."%";
  //   $sql = "select * from product where p_Name like :p_name or p_Comment like :p_name2";
  //   $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
  //   $stt->execute(array(
  //                       ':p_name'=>$s,
  //                       ':p_name2'=>$s
  //                     ));
  //   $rowCount = $stt->rowCount();
  //
  //   $this->rc = $rowCount;
  //
  //   return $rowCount;
  // }


  // DB에 있는 상품들을 각 배열에 값저장하기
  public function substituteProductData($rowCount, $product){
    $tempArray = array();

    $sql = "select * from product order by p_Number desc";
    $tempArray = $this->getAllRecord($sql, $product);
    // $stt = $this->dbo->prepare($sql);
    // $stt->execute();
    // $row = $stt->fetchAll();


        // for($i = 0 ; $i<$rowCount;$i++){
        //   $tempArray[0][$i] = $product["p_Number_$i"] = $row[$i]["p_Number"];
        //   $tempArray[1][$i] = $product["p_Name_$i"] = $row[$i]["p_Name"];
        //   $tempArray[2][$i] = $product["p_Price_$i"] = $row[$i]["p_Price"];
        //   $tempArray[3][$i] = $product["p_Comment_$i"] = $row[$i]["p_Comment"];
        //   $tempArray[4][$i] = $product["p_Type_$i"] = $row[$i]["p_Type"];
        //   $tempArray[5][$i] = $product["p_Amount_$i"] = $row[$i]["p_Amount"];
        //   $tempArray[6][$i] = $product["p_Imgname_$i"] = $row[$i]["p_Imgname"];
        //   $tempArray[7][$i] = $product["p_Detail_$i"] = $row[$i]["p_detail"];
        // }
        // $this->pr = $tempArray;

    return $tempArray;

                      //2차원배열로 출력 성공!  ver.2
        // for($i = 0 ; $i<$rowCount;$i++){
        //   echo $tempArray[0][$i]."<br>";
        //   echo $tempArray[1][$i]."<br>";
        //   echo $tempArray[2][$i]."<br>";
        //   echo $tempArray[3][$i]."<br>";
        //   echo $tempArray[4][$i]."<br>";
        //   echo $tempArray[5][$i]."<br>";
        //   echo $tempArray[6][$i]."<br>";
        //   echo $tempArray[7][$i]."<br><br>";
        // }

              // 아래는 백업본. ver.1
    // for($i = 0 ; $i<$rowCount;$i++){
    //   $product["p_Number_$i"] = $row[$i]["p_Number"];
    //   $product["p_Name_$i"] = $row[$i]["p_Name"];
    //   $product["p_Price_$i"] = $row[$i]["p_Price"];
    //   $product["p_Comment_$i"] = $row[$i]["p_Comment"];
    //   $product["p_Type_$i"] = $row[$i]["p_Type"];
    //   $product["p_Amount_$i"] = $row[$i]["p_Amount"];
    //   $product["p_Imgname_$i"] = $row[$i]["p_Imgname"];
    //   $product["p_Detail_$i"] = $row[$i]["p_detail"];
    // }
    //            // 출력 성공! ver.1출력버전
    // for($i = 0 ; $i<$rowCount;$i++){
    //   echo $product["p_Number_$i"]."<br>";
    //   echo $product["p_Name_$i"]."<br>";
    //   echo $product["p_Price_$i"]."<br>";
    //   echo $product["p_Comment_$i"]."<br>";
    //   echo $product["p_Type_$i"]."<br>";
    //   echo $product["p_Amount_$i"]."<br>";
    //   echo $product["p_Imgname_$i"]."<br>";
    //   echo $product["p_Detail_$i"]."<br>";
    //   echo "<br><br>";
    // }

        // 값저장은 했음.  view에 뿌리기



  }





  // DB에 있는 게시글 값들 각각 배열에 저장하기.
  // public function substituteContentData($rowCount, $content){
  //   $sql = "select * from content";
  //   $stt = $this->dbo->prepare($sql);
  //   $stt->execute();
  //   $row = $stt->fetchAll();
  //
  //   $tempArray = array();
  //
  //       for($i = 0 ; $i<$rowCount;$i++){
  //         $tempArray[0][$i] = $content[0][$i] = $row[$i]["num"];
  //         $tempArray[1][$i] = $content[1][$i] = $row[$i]["id"];
  //         $tempArray[2][$i] = $content[2][$i] = $row[$i]["name"];
  //         $tempArray[3][$i] = $content[3][$i] = $row[$i]["nick"];
  //         $tempArray[4][$i] = $content[4][$i] = $row[$i]["content"];
  //         $tempArray[5][$i] = $content[5][$i] = $row[$i]["regist_day"];
  //         // echo $tempArray[0][$i]."<br>";   // 값이 들어감.
  //       }
  //       return $tempArray;
  //  }



}

?>
