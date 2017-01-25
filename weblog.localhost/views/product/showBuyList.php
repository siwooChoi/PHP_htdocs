<!-- <form action="./controlor/controlSupport.php?mode=noSearch" method="post"> -->

<link href="/css/showbuylist_css.css" type="text/css" rel="stylesheet">


    <!-- <form action="./controlor/controlSupport.php?mode=buylist" method="post"> -->

<!--  -->
  <!-- <table> -->
    <?php

    $rowCount = count($buylist);

      if(isset($rowCount)){

        $buylistCount = 1;

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

                        <img width="200px" height="200px" src='/img/<?php echo $buylist[$i]['p_Imgname'];  ?>' >

                  </td>

                  <td style="text-align:center" width="70%">
                    <table width="100%">
                      <td>
                          <?php  echo '구매이력 번호 : '.$buylist[$i]['b_Number']; ?>
                          <br><br><br>
                        </td>


                      <tr><td>
                          <b><h3 style="text-align:center"><?php  echo $buylist[$i]['p_Name']; ?></h3></b>
                          <p><?php echo $buylist[$i]['p_Comment'];?></p>
                          <p><?php echo "갯수 : ".$buylist[$i]['p_Amount'];?></p>
                      </td></tr>

                      <tr><td>

                     </td></tr>
                 </table>
                  </td>
                </tr>
                <tr>
                  <td style="text-align:center">
                    판매가격 : <?php echo $buylist[$i]['p_Price'];?> <br>
                  </td>
                  <td>
                    <table >
                      <tr><td>



                  </td>
                  <td>
                    <!-- <form action="./controlor/controlSupport.php?mode=buylistProductDelete" method="post">
                      <input type="submit" value="삭제하기">
                    </form> -->
                    <form  action="<?php echo $base_url; ?>/product/deleteBuyList" method="post">
                      <input type="hidden" name="hidden_b_Number" value="<?php echo $buylist[$i]['b_Number']; ?>">
                      <input type="hidden" name="hidden_p_Number" value="<?php echo $buylist[$i]['p_Number']; ?>">
                      <input type="hidden" name="_token" value="<?php print $this->escape($_token); ?>">
                      <input type="submit" value="삭제하기">
                    </form>
                  </td>
                    <td style="width:40px;">
                        <!-- 빈공간 -->
                    </td>
                    <td>
                      <?php $regi = substr($buylist[$i]['regist_day'], 0, 10 ); ?>
                     구매한 날짜  : <?php echo $regi; ?>
                    </td>

                  </td>
                </tr>

              </table>

              </table>
          </td>
          </td>

          <?php
          if($buylist % 3 == 0){
            echo "</tr>";
          }
          $buylist++;
        }//for end


        } else{

        }
    ?>
<!-- </form> -->
