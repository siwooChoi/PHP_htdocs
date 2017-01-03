<?php
// require "b/3.php";
// require "./b/3.php";
require "../b/3.php";


//require 받은 파일의 경로는 최초에 require시킨 파일!

//그 기준은 현재 파일 즉,

//b
echo "<br>";
echo __FILE__."<br>";
echo dirname(__FILE__);
echo "<br>";
echo "실행";
?>
