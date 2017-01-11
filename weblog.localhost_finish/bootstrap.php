<?php
  require 'mvc/Loader.php'; 

  $loader = new Loader();
  $loader->regDirectory(dirname(__FILE__).'/mvc');
  // C:\xampp\htdocs\weblog.localhost_finish/mvc     <--- 이렇게 되는 것.

  $loader->regDirectory(dirname(__FILE__).'/models');
  // C:\xampp\htdocs\weblog.localhost_finish/models     <--- 이렇게 되는 것.



  /* __FILE__ : 현재 파일의 directory를 저장하고 있는정수
    echo __FILE__;  // C:\xampp\htdocs\weblog.localhost_finish\bootstrap.php  */

  /* dirname() : 지정한 파일 경로의 부모 directory의 경로를 반환
    echo dirname(__FILE__); //   C:\xampp\htdocs\weblog.localhost_finish  */
  //http://php.net/manual/kr/fnction.dirname.php

  $loader->register();
 ?>
