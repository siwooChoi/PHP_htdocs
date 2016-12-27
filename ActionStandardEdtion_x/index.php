<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <style>
       #headerLine{
         height:150px;
       }

       #logo{
         float: left;
         width: 20%;
         height:100%;
         background-color: pink;
       }
       #search{
        float: left;
        width: 50%;
        height:100%;
        background-color: #555555;
       }


       #login{
         float: left;
         width:30%;
         height:100%;
         background-color: #777777;
       }
       #menu{
         height:50px;
         background-color: green;
       }

       .menulist{
         float: left;
         height: 50%;
         width: 20%;
         margin-top: 13px;
         margin-left:25px;
         background-color: red;
       }



       #bodyLine{
         background-color: #bbbbbb;
         height:800px;
       }


    </style>
  </head>
  <body> <!-- -->

    <?php
      require_once "control.php";

      $control = new control();
     ?>

    <!-- header line-->
          <div id='headerLine'>
      <!-- logo-->

            <div id='logo'>
              여기는 이미지 넣고, 이미지 클릭 시 index.php로 오는
              이미지 하이퍼링크
            </div>


      <!-- search?? -->
            <div id='search'>
              <?php
                require_once "search.php";

               ?>
            </div>

      <!-- login-->
            <div id='login'>
              <?php
                  $control->viewLoginPage();
               ?>
            </div>


          </div><!--headerLine 끝나는 지점-->


      <!-- menu-->
          <div id='menu'>

            <div class='menulist'>메뉴1</div>
            <div class='menulist'>메뉴2</div>
            <div class='menulist'>메뉴3</div>
          </div>

    <!-- body line-->
          <div id='bodyLine'>
            <?php
              // require_once "body.php";

             ?>
          </div>





  </body>
</html>
