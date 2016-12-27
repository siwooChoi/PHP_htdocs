<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <link href="./css/index_Css.css" type="text/css" rel="stylesheet">
  </head>
  <body> <!-- -->

<div id="main_div">
    <!-- header line-->
          <div id='headerLine'>
      <!-- logo-->

            <div id='logo'>
              <a href="./controlor/controlSupport.php?mode=resetSearch">
                <img src="./imgs/bg/bg6.jpg" height="100%" width="100%">
              </a>

            </div>


      <!-- search?? -->
      <div id='search'>
        <?php
          require_once "./view/search.php";

         ?>
      </div>

      <!-- login-->
            <div id='login'>
              <?php
                require_once "./view/login.php";
               ?>
            </div>


          </div>
          <!--headerLine 끝나는 지점-->

          <div id='menu'>
            <a href="./controlor/controlSupport.php?mode=resetSearch"><div class='menulist'> 메인 화면 </div></a>
            <a href="./index.php?mode=menu1view"><div class='menulist'> 메 뉴 1 </div></a>
            <a href="./index.php?mode=menu2view"><div class='menulist'> 자유 게시판</div></a>
            <a href="./index.php?mode=menu3view"><div class='menulist'> 메 뉴 3 </div></a>
          </div>

    <!-- body line-->

          <div id='bodyLine'>
            <?php


          

            if(isset($_GET['mode'])){

              $mode = $_GET['mode'];

              switch ($mode) {

                case 'bodyview':
                  unset($_SESSION['productsearch']);
                  require_once "./view/body.php";
                  break;

                case 'menu1view':
                  require_once "./view/menu1.php";
                  break;

                case 'menu2view':
                  require_once "./messageBoard/messageBoard.php";
                  break;

                case 'insert_memo':
                  require_once "./memo/insert.php";
                  break;

                case 'menu3view':
                  require_once "./view/menu3.php";
                  break;
                // case 'searchview':
                //   require_once "./view/searchview.php";
                // break;
                case 'viewMyBasket' :
                  require_once "./view/myBasket.php";
                  break;

                  /////////////////////// 게시글 작성 /////////////////
                case 'createBoard':
                  require_once "./messageBoard/createBoard.php";
                  break;

                case 'boardCreate':
                  require_once "./messageBoard/messageBoard.php";
                  break;

                case 'viewMyBasket' :
                  require_once "./view/myBasket.php";
                  break;


              }
            } else{
              if(isset($_GET['product'])){
                  require_once "./view/product_details.php";
              }

              else if(isset($_GET['myBasket_pd'])){
                require_once "./view/mybasket_p_d.php";
              }

              else if(isset($_GET['messagenum'])){
                require_once "./messageBoard/messageContent.php";
              }
              else{
                require_once "./view/body.php";
              }
            }





             ?>
          </div>

</div>




  </body>
</html>
