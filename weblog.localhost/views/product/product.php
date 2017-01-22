<body>
<link href="/css/product_css.css" type="text/css" rel="stylesheet">
    <table class='main_product'  width="850px" height="700px" style="margin-left:10px; margin-top:20px;" border="1px white solid">
    <!-- <form action="./index.php?mode=basket" method="post"> -->

  <?php

      // echo $rowCount = $parameters[0]."<br>";

      if(empty($product)){
          echo "값이 아직 없다<br>";
          // var_dump($product[0]['p_Name']);
          // echo "<br>";
          // echo count($product);


      } else {

        $rowCount = count($product);    // product 테이블의 행 수 (상품의 갯수)
        $productCount = -2;
        // $product[i]['p_Number']      // i번째의 번호
        // $product[i]['p_Name']        // i번째의 이름
        // $product[i]['p_Price']       // i번째의 가격
        // $product[i]['p_Comment']     // i번째의 간략한 단어
        // $product[i]['p_Type']        // i번째의 종류
        // $product[i]['p_Amount']      // i번째의 가격
        // $product[i]['p_Imgname']     // i번째의 이미지파일의 이름
        // $product[i]['p_detail']      // i번째의 상세설명
            // 기존코드
        /*  [0] --> Num,  [1] --> Name,   [2] --> Price,   [3] --> comment
            [4] --> Type,   [5] --> Amount,  --> [6] --> ImgName   [7] --> Detail  */

      for($i = 0 ; $i < $rowCount; $i++){
        if($i % 3 == 0){ echo "<tr>"; }
        ?>

        <form action="<?php print $base_url;?>/product/basket" method="post">
  <td width=33%>  <!-- 각각의 큰 틀 -->
    <p style='text-align:center'><?php  echo $product[$i]['p_Name']; ?>
    </p>  <!-- 메인 상품명 -->
      <table border="solid white 5px" style="width:350px" >
        <tr>
          <td>
              <a href='<?php echo $base_url; ?>/product/productdetail?number=<?php echo $product[$i]['p_Number']; ?>'>
                <img width="200px" height="200px" src='/img/<?php echo $product[$i]['p_Imgname'];  ?>' >
                <input type="hidden" name="Post_pNumber" value="<?php  echo $product[$i]['p_Number']; ?>">
                <input type="hidden" name="Post_pName" value="<?php  echo $product[$i]['p_Name']; ?>">
                <input type="hidden" name="Post_pPrice" value="<?php  echo $product[$i]['p_Price']; ?>">
                <input type="hidden" name="Post_pComment" value="<?php  echo $product[$i]['p_Comment']; ?>">
                <input type="hidden" name="Post_pType" value="<?php  echo $product[$i]['p_Type']; ?>">
                <input type="hidden" name="Post_pAmount" value="<?php  echo $product[$i]['p_Amount']; ?>">
                <input type="hidden" name="Post_pImgname" value="<?php  echo $product[$i]['p_Imgname']; ?>">
                <input type="hidden" name="Post_pDetail" value="<?php  echo $product[$i]['p_detail']; ?>">
                <input type="hidden" name="rowCount" value="<?php  echo $this->rowCount; ?>">
                <input type="hidden" name="row" value="<?php echo $this->productValuesArray; ?>">

              </a>
          </td>

          <td style="text-align:center" width="70%">
            <?php
            echo $product[$i]['p_Comment']; ?>
          </td>
        </tr>
        <tr>
          <td style="text-align:center">
            판매가격 : <?php echo $product[$i]['p_Price']; ?> <br>
            남은 수량 : <?php echo $product[$i]['p_Amount']; ?>
          </td>
          <td>
            <table>
              <tr><td>

<?php if( isset($_SESSION['user']['user_name']) && $_SESSION['user']['user_name'] != "admin") { ?>
              <input type="submit" value="장바구니">
  <?php } ?>
            </form>
          </td>


<?php       if( isset($_SESSION['user']['user_name']) && $_SESSION['user']['user_name'] != "admin"){ ?>
          <td>
            <form action="<?php echo $base_url; ?>/product/buyProduct" method="post">
              <input type="hidden" name="Post_pName" value="<?php  echo $product[$i]['p_Name']; ?>">
              <input type="hidden" name="Post_pNumber" value="<?php  echo $product[$i]['p_Number']; ?>">
              <input type="submit" value="구매하기">
            </form>
          </td>
          </td>
        </tr>
<?php }

       if(isset($_SESSION['user']['user_name']) && $_SESSION['user']['user_name'] == "admin"){ ?>
        <tr>
          <td>
            <form action="./index.php?product_delete=
                          <?php  echo $product[$i]['p_Number']; ?>~
                          <?php  echo $product[$i]['p_Name']; ?>" method="post">
              <input type="submit" value="판매정보 삭제">
            </form>
          </td>
        </tr>
<?php }?>
      </table>

      </table>
    </td>
    </td>

  <?php
  if($productCount % 3 == 0){
    echo "</tr>";
  }
  $productCount++;
}//for end
echo "</table>";

} // 젤 위의 "값이없다"의 else 닫는 괄호
  ?>
</body>
