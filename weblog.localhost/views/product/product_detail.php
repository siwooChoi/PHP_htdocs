
           <link href="/css/detail_css.css" type="text/css" rel="stylesheet">

              <!-- 상품명 -->
          <div style="font-size:35px;" class="p_name">
              <table border="solid black 1px" style="" >
                <tr>
                  <td>
                    <?php echo $product[0]['p_Name']; ?><br>
                  </td>
                </tr>
              </table>
          </div>


            <!-- 상품이미지 -->
          <div style="" class="p_img">
              <table border="solid black 1px" style="" >
                <tr>
                  <td>
                    <img width="300px" height="300px" src="/img/<?php echo $product[0]['p_Imgname']; ?>">  <br>
                  </td>
                </tr>
              </table>
          </div>


          <!-- 코멘트 -->
          <div style="" class='detail_com'>
              <table style="" >
                <tr>
                  <td>
                    <?php echo $product[0]['p_Comment']; ?><br>
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
                    <?php echo $product[0]['p_Price']; ?><br>
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
                    <?php echo $product[0]['p_Amount']; ?><br>
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
                    <?php echo $product[0]['p_Type']; ?><br>
                  </td>
                </tr>
              </table>
          </div>

          <!-- 상세 설명 -->
          <div style="" class='detail_text'>
              <table border="solid black 1px" style="width:450px; height:150px" >
                <tr>
                  <td>
                    <?php echo $product[0]['p_detail'] ?><br>
                  </td>
                </tr>
              </table>
          </div>


<?php if( isset($_SESSION['user']['user_name']) && $_SESSION['user']['user_name'] != "admin"){ ?>
          <div style="" class='detail_buy'>
              <form action="<?php echo $base_url; ?>/product/buyProduct" method="post">
                <input type="hidden" name="Post_pNumber" value="<?php  echo $product[0]['p_Number']; ?>">
                <input type="hidden" name="Post_pName" value="<?php  echo $product[0]['p_Name']; ?>">
                <input type="hidden" name="Post_pPrice" value="<?php  echo $product[0]['p_Price']; ?>">
                <input type="hidden" name="Post_pComment" value="<?php  echo $product[0]['p_Comment']; ?>">
                <input type="hidden" name="Post_pType" value="<?php  echo $product[0]['p_Type']; ?>">
                <input type="hidden" name="Post_pAmount" value="<?php  echo $product[0]['p_Amount']; ?>">
                <input type="hidden" name="Post_pImgname" value="<?php  echo $product[0]['p_Imgname']; ?>">
                <input type="hidden" name="Post_pDetail" value="<?php  echo $product[0]['p_detail']; ?>">
                <input type="submit" value="구매하기">
              </form>
          </div>

          <div  class='detail_basket'>
              <form action="<?php echo $base_url; ?>/product/basket" method="post">
                <input type="submit" value="장바구니">
                <input type="hidden" name="Post_pNumber" value="<?php  echo $product[0]['p_Number']; ?>">
                <input type="hidden" name="Post_pName" value="<?php  echo $product[0]['p_Name']; ?>">
                <input type="hidden" name="Post_pPrice" value="<?php  echo $product[0]['p_Price']; ?>">
                <input type="hidden" name="Post_pComment" value="<?php  echo $product[0]['p_Comment']; ?>">
                <input type="hidden" name="Post_pType" value="<?php  echo $product[0]['p_Type']; ?>">
                <input type="hidden" name="Post_pAmount" value="<?php  echo $product[0]['p_Amount']; ?>">
                <input type="hidden" name="Post_pImgname" value="<?php  echo $product[0]['p_Imgname']; ?>">
                <input type="hidden" name="Post_pDetail" value="<?php  echo $product[0]['p_detail']; ?>">

              </form>
          </div>
<?php } ?>
<?php if(isset($_SESSION['userid']) && $_SESSION['userid'] == "admin"){ ?>

      <form action="" method="post">
        <input type="submit" value="판매정보 삭제">
      </form>

<?php }?>

          <div style="" class="back">
              <form class="" action="<?php echo $base_url; ?>/product/product" method="post">
                <input type="submit" value="메인으로">
              </form>
          </div>
