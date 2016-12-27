<?php
  session_start();
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href='css/common.css'/>
   </head>
   <body>

     <div id="wrap">
       <div id="header">
         <!-- ? include "./lib/top_login1.php"; ?> -->
         <?php require_once "./lib/top_login1.php"; ?>
       </div>  <!--  head end-->



       <div id="menu">
         <?php require_once "./lib/top_menu1.php"; ?>
       </div>  <!--  menu end-->


       <div id="content">
         <div id="main_img"> <img src="./img/main_img.jpg" /></div>
       </div>  <!--  head content-->
     </div>

   </body>
 </html>
