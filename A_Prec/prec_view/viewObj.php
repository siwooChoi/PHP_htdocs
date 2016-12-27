<?php
  class viewObj{

    public function __construct(){
      ?>
      <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title></title>

          <link href="./css/css_show.css" type="text/css" rel="stylesheet">

        </head>
        <body> <!-- -->

      <div id="main_div">
          <!-- header line-->
                <div id='headerLine'>
            <!-- logo-->

                  <div id='logo'>
                    <!-- <a href="./controlor/controlSupport.php?mode=resetSearch"> -->
                      <!-- <img src="./imgs/bg/bg6.jpg" height="100%" width="100%"> -->
                    </a>

                  </div>


            <!-- search?? -->
            <div id='search'>
              <?php
                // require_once "./view/search.php";

               ?>
            </div>

            <!-- login-->
                  <div id='login'>
                    <?php
                      $this->login();
                     ?>
                  </div>


                </div>
                <!--headerLine 끝나는 지점-->

                <div id='menu'>
                  <div class='menulist'> 메인 화면 </div>
                  <div class='menulist'> 메 뉴 1 </div>
                  <div class='menulist'> 자유 게시판</div>
                  <div class='menulist'> 메 뉴 3 </div>
                </div>

          <!-- body line-->

                <div id='bodyLine'>
                  <?php

                      // require_once "./view/viewobj.php";

                   ?>
                </div>

      </div>




        </body>
      </html>
<?php



    }
    private function login(){
      require_once "./prec_view/login/login.php";
    }


  }
?>
