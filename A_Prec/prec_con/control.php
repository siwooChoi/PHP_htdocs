<?php
  require_once "./prec_view/viewObj.php";
  require_once "./prec_mod/mod.php";



  echo $mode;

  class control{
    private $contorl_of_mod;
    private $contorl_of_view;

    if(isset($_GET['mode'])){
      $mode = $_GET['mode'];
    }

    if($mode == "login"){
      echo "된건가";
    }


    public function __construct(){
      print "컨트롤 생성자가 실행됨.<br>";
      $contorl_of_mod = new mod();
      $contorl_of_view = new viewObj();
    }


  }
?>
