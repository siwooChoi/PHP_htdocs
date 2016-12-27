<?php
  require_once "./control.php";


  $control = new control();

  // $a = $_FILES['userfile'];



  if(isset($_GET['mode'])){
    // print $_GET['mode'].'<br>';

    $mode = $_GET['mode'];

    switch ($mode) {
      case 'login':
        $control->checkId();
        // $control->logon($_SESSION['userid'], $_SESSION['userpw']);
        break;

      case 'logout':
        $control->logout();
        break;

      case 'modify':
        $control->modify();
        break;

      case 'modifyUser':
        $control->modifyUser();
        break;

      case 'createUser' :
        $control->createUser();
      break;

      case 'deleteUser' :
        $control->deleteUser();
      break;

      case 'productsearch' :
        $control->product_search($_POST['productsearch']);
      break;

      case 'resetSearch' :
        $control->resetSearch();
      break;

      case 'basketProductDelete' :
        $control->basketProductDelete($argContent);
        break;


      // 장바구니에 담기
      case 'basket' :
        if(!isset($_SESSION['userid'])){
          echo "<script> alert('로그인 후 이용하세요.'); </script>";
          echo "<script> history.go(-1); </script>";
        } else{
                $control->createBasket();
                $control->insertBasket();
        }

        break;

      //내 장바구니 보기
      case 'myBasket' :
          $control->showMyBasket();
          echo "<script> location.replace('../index.php?mode=viewMyBasket') </script>";
        break;

        // admin으로 상품등록 버튼을 눌렀을 떄
      case 'upload_product1' :
        $control->upload_product1();
        break;

        //
        // 상품등록 하기
      case 'upload_product2' :
        $_SESSION['p_name'] = $_POST['p_name'];
        $_SESSION['p_price'] = $_POST['p_price'];
        $_SESSION['p_comment'] = $_POST['p_comment'];
        $_SESSION['p_type'] = $_POST['p_type'];
        $_SESSION['p_amount'] = $_POST['p_amount'];
        $_SESSION['p_imgname'] = $_POST['p_imgname'];

        $control->upload_product2();
        break;

      default:
        break;
    }

  } else{

  }

  // if(isset($_GET['productsearch'])){
  //
  // }

    // 게시글 쓰기
  if(isset($_GET['create_content'])){
    $_SESSION['userfile'] = $_FILES['userfile']['name'];

     if($_POST['boardname'] == "" || $_POST['content'] == ""  )  {
      echo "<script>alert('제목 또는 내용을 입력하지 않았습니다.')</script>";
      // echo "<script> history.go(-1); </script>";
      // echo "<script>location.replace('../index.php')</script>";
      echo "<script> location.replace('../index.php?mode=menu2view'); </script>";
    } else{

      $control->create_content();

    }
  }

    // 게시글 삭제
  if(isset($_GET['deletecontentPage'])){
    $control->contentDelete($_GET['deletecontentPage']);
  }

    // 장바구니에서 상품삭제
  if(isset($_GET['deleteProductNum'])){
    $control->basketProductDelete($_GET['deleteProductNum']);
  }

    // 게시글 수정
  if(isset($_GET['modifycontentPage'])){

    $_SESSION['userfile'] = $_FILES['userfile']['name'];
     if($_POST['boardname'] == "" || $_POST['content'] == ""  )  {
      echo "<script>alert('제목 또는 내용을 입력하지 않았습니다.')</script>";
      // echo "<script> history.go(-1); </script>";
      echo "<script>location.replace('../index.php')</script>";

    } else{
      // echo $_POST['boardname']."<br>";                  //수정한 제목
      // echo $_POST['content']."<br>";                    //수정한 내용
        $control->contentModify($_GET['modifycontentPage'],
                                $_POST['boardname'],
                                $_POST['content']
                                );
    }




  }

?>
