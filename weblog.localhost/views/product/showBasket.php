<!-- <form action="./controlor/controlSupport.php?mode=noSearch" method="post"> -->

<link href="/css/showBasket_css.css" type="text/css" rel="stylesheet">


    <!-- <form action="./controlor/controlSupport.php?mode=basket" method="post"> -->

<!--  -->
  <!-- <table> -->
    <?php

    $rowCount = count($basket);

      if(isset($rowCount)){

        $basketCount = 1;

        for($i = 0 ; $i< $rowCount; $i++){


          if($i % 3 == 0){
            echo "<tr>";
          }

          ?>
<!-- <form action="./controlor/controlSupport.php" method="post"> -->
          <td width=33%>  <!-- 각각의 큰 틀 -->



              <table border="solid black 1px" style="margin-left:50px;" >
                <tr>
                  <td>

                        <img width="200px" height="200px" src='/img/<?php echo $basket[$i]['p_Imgname'];  ?>' >

                  </td>

                  <td style="text-align:center" width="70%">
                    <table width="100%">
                      <td>
                          <?php  echo '장바구니 번호 : '.$basket[$i]['b_Number']; ?>
                          <br><br><br>
                        </td>


                      <tr><td>
                          <b><h3 style="text-align:center"><?php  echo $basket[$i]['p_Name']; ?></h3></b>
                          <p><?php echo $basket[$i]['p_Comment'];?></p>
                          <p><?php echo "갯수 : ".$basket[$i]['p_Amount'];?></p>
                      </td></tr>

                      <tr><td>

                     </td></tr>
                 </table>
                  </td>
                </tr>
                <tr>
                  <td style="text-align:center">
                    판매가격 : <?php echo $basket[$i]['p_Price'];?> <br>
                  </td>
                  <td>
                    <table >
                      <tr><td>



                  </td>
                  <td>
                    <form action="<?php echo $base_url; ?>/product/buyProduct_in_Basket" method="post">
                      <input type="hidden" name="Post_bNumber" value="<?php  echo $basket[$i]['b_Number']; ?>">
                      <input type="hidden" name="Post_pNumber" value="<?php echo $basket[$i]['p_Number']; ?>">
                      <input type="hidden" name="Post_pName" value="<?php  echo $basket[$i]['p_Name']; ?>">
                      <input type="hidden" name="Post_bAmount" value="<?php  echo $basket[$i]['p_Amount']; ?>">

                      <input type="submit" name="submit" value="구매하기">
                    </form>
                  </td>
                  <td>
                    <!-- <form action="./controlor/controlSupport.php?mode=basketProductDelete" method="post">
                      <input type="submit" value="삭제하기">
                    </form> -->
                    <form  action="<?php echo $base_url; ?>/product/deleteBasket" method="post">
                      <input type="hidden" name="hidden_b_Number" value="<?php echo $basket[$i]['b_Number']; ?>">
                      <input type="hidden" name="hidden_p_Number" value="<?php echo $basket[$i]['p_Number']; ?>">
                      <input type="submit" value="삭제하기">
                    </form>
                  </td>
                    <td style="width:40px;">
                        <!-- 빈공간 -->
                    </td>
                    <td>
                      <?php $regi = substr($basket[$i]['regist_day'], 0, 10 ); ?>
                     장바구니에 담은 날짜 <?php echo $regi; ?>
                    </td>

                  </td>
                </tr>

              </table>

              </table>
          </td>
          </td>

          <?php
          if($basket % 3 == 0){
            echo "</tr>";
          }
          $basket++;
        }//for end


        } else{

        }
    ?>
<!-- </form> -->
