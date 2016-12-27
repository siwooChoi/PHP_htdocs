


<html>
  <head>
    <meta charset="utf-8">
    <title></title>
     <link href="./css/detail.css" type="text/css" rel="stylesheet">

  </head>
  <body> <!-- -->

<?php

// get으로 어떤 상품을 클릭했는지 판단 (이미지이름)  컨트롤서포트  로 값을 넘겨야된다.
if(isset($_GET['myBasket_pd'])){
  // $getimgname = $_GET['mode'];
  // $explode_imgname = explode(".", $getimgname);
  $imgname = $_GET['myBasket_pd'];


} else{
  echo "<script>alert('상품에 대한 상세정보를 찾을 수 없습니다.')</script>";
  echo "<script> history.go(-1); </script>";
}
  $row = $_SESSION['row'] ;
  $rowCount = $_SESSION['rowCount'];

// 같은 이미지이름을 찾고 사용할수 있게 변수에 값을 넣는다.

for($i = 0 ; $i<$rowCount;$i++){
  $row[$i]["p_Number"] = $_SESSION["p_Number_$i"];
  $row[$i]["p_Name"] = $_SESSION["p_Name_$i"];
  $row[$i]["p_Price"] = $_SESSION["p_Price_$i"] ;
  $row[$i]["p_Comment"] = $_SESSION["p_Comment_$i"] ;
  $row[$i]["p_Type"] = $_SESSION["p_Type_$i"] ;
  $row[$i]["p_Amount"] = $_SESSION["p_Amount_$i"] ;
  $row[$i]["p_Imgname"] = $_SESSION["p_Imgname_$i"];
  $row[$i]["p_Detail"] = $_SESSION["p_Detail_$i"];

  if($imgname == $_SESSION["p_Imgname_$i"]){
    $detail_number = $_SESSION["p_Number_$i"];
    $detail_name = $_SESSION["p_Name_$i"];
    $detail_price = $_SESSION["p_Price_$i"] ;
    $detail_comment = $_SESSION["p_Comment_$i"] ;
    $detail_type = $_SESSION["p_Type_$i"] ;
    $detail_amount = $_SESSION["p_Amount_$i"] ;
    $detail_image = $_SESSION["p_Imgname_$i"];
    $detail_detail = $_SESSION["p_Detail_$i"];
  }
}
// 판단에 성공한 상품의 상세표시이미지를 만든다.

  ?>

        <!-- 상품명 -->
    <div style="font-size:35px;" class="p_name">
        <table border="solid black 1px" style="" >
          <tr>
            <td>
              <?php echo $detail_name; ?><br>
            </td>
          </tr>
        </table>
    </div>


      <!-- 상품이미지 -->
    <div style="" class="p_img">
        <table border="solid black 1px" style="" >
          <tr>
            <td>
              <img width="300px" height="300px" src="./imgs/<?php echo $detail_image; ?>">  <br>
            </td>
          </tr>
        </table>
    </div>


    <!-- 코멘트 -->
    <div style="" class='detail_com'>
        <table style="" >
          <tr>
            <td>
              <?php echo $detail_name; ?><br>
            </td>
          </tr>
        </table>
    </div>
    <!-- 가격 -->
    <div style="" class='detail_price_text'>가격  </div>

    <div style="" class='detail_price'>
        <table >
          <tr>
            <td>
              <?php echo $detail_price; ?><br>
            </td>
          </tr>
        </table>
    </div>

    <!-- 수량 -->
    <div  class='detail_amount_text'> 남은 수량  </div>
    <div style="" class='detail_amount'>
        <table  style="" >
          <tr>
            <td>
              <?php echo $detail_amount; ?><br>
            </td>
          </tr>
        </table>
    </div>

    <!-- 종류 -->
    <div style="" class='detail_type_text'> 종류  </div>
    <div style="" class='detail_type'>
        <table style="" >
          <tr>
            <td>
              <?php echo $detail_type; ?><br>
            </td>
          </tr>
        </table>
    </div>

    <!-- 상세 설명 -->
    <div style="" class='detail_text'>
        <table border="solid black 1px" style="width:450px; height:150px" >
          <tr>
            <td>
              <?php echo $detail_detail; ?><br>
            </td>
          </tr>
        </table>
    </div>


    <!-- 구매하기, 장바구니버튼   일단은 submit 이 아니라 button 으로 설정해놓았음-->
    <div style="" class='detail_buy'>
        <form class="" action="" method="post">
          <input type="button" value="구매하기">
        </form>
    </div>

    <div style="" class="back">
        <form class="" action="./index.php" method="post">
          <input type="submit" value="메인으로">
        </form>
    </div>

  </body>
  </html>
