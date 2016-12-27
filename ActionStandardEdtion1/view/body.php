  <!-- <form action="./controlor/controlSupport.php?mode=noSearch" method="post"> -->

        <table class='main_product'  width="850px" height="700px" style="margin-left:10px; margin-top:20px;" border="1px white solid">
        <form action="./controlor/controlSupport.php?mode=basket" method="post">





<!--  -->
    <!-- <table> -->
      <?php
      // $_SESSION["p_Name_$i"]
      // $_SESSION["p_Price_$i"]
      // $_SESSION["p_Comment_$i"]
      // $_SESSION["p_Type_$i"]
      // $_SESSION["p_Amount_$i"]
      // $_SESSION["p_Imgname_$i"]


          $productCount = 1;

          for($i = 0 ; $i<$_SESSION['rowCount']; $i++){
            if($i % 3 == 0){
              echo "<tr>";
            }

            ?>
<form action="./controlor/controlSupport.php?mode=basket" method="post">
            <td width=33%>  <!-- 각각의 큰 틀 -->
              <p style='text-align:center'><?php  echo $_SESSION["p_Name_{$i}"] ?></p>  <!-- 메인 상품명 -->

                <table border="solid black 1px" style="" >
                  <tr>
                    <td>
                        <a href='./index.php?product=<?php echo $_SESSION["p_Imgname_{$i}"]; ?>'>
                          <img width="200px" height="200px" src="./imgs/<?php echo $_SESSION["p_Imgname_$i"];?>" >
                        </a>
                    </td>

                    <td style="text-align:center" width="70%">
                      <?php echo $_SESSION["p_Comment_$i"];?>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align:center">
                      판매가격 : <?php echo $_SESSION["p_Price_$i"]; ?> <br>
                      남은 수량 : <?php echo $_SESSION["p_Amount_$i"]; ?>
                    </td>
                    <td>
                      <table>
                        <tr><td>

                        <input type="submit" value="장바구니">
                          <input type="hidden" name="insertBasket_pName" value="<?php  echo $_SESSION["p_Name_{$i}"]; ?>">
                          <input type="hidden" name="insertBasket_pPrice" value="<?php  echo $_SESSION["p_Price_{$i}"]; ?>">
                          <input type="hidden" name="insertBasket_pComment" value="<?php  echo $_SESSION["p_Comment_$i"]; ?>">
                          <input type="hidden" name="insertBasket_pType" value="<?php  echo $_SESSION["p_Type_$i"]; ?>">
                          <input type="hidden" name="insertBasket_pAmount" value="<?php  echo $_SESSION["p_Amount_$i"]; ?>">
                          <input type="hidden" name="insertBasket_pImgname" value="<?php  echo $_SESSION["p_Imgname_{$i}"]; ?>">
                      </form>
                    </td>

                    <td>
                      <form>
                        <input type="submit" value="구매하기">
                      </form>
                    </td>
                    </td>
                  </tr>
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

          
      ?>
  <!-- </form> -->
