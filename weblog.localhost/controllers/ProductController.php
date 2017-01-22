<?php
  class ProductController extends Controller{

    public $testValues;
    public $productValues;

    // 메인화면을 위한 상품값들을 View로 보내기
    public function productAction(){
     // model 에서 product 테이블의 값들을 찾도록 해야함.
     // 찾은 값들을 배열로 저장
      $this->productValues = $this->_connect_model->
        get('Product')->substituteProductData();
      // var_dump($this->testValues); // 배열로 값이 다 들어갔음!
      // return $this->render($arrayRowCount, "product", "template");  // 값 넣어야됨.
      $products_view = $this->render(array('product' => $this->productValues), "product", "template");
      return $products_view;
    }

    // 상품 이미지 클릭시 상세설명
    public function productdetailAction(){
      $p_Number = $this->_request->getGet('number');

      $this->productValues = $this->_connect_model->
        get('Product')->getDetailData($p_Number);

      $products_view = $this->render(array('product' => $this->productValues), "product_detail", "template");

      return $products_view;
    }

    // search 로 상품 찾고 View로 값 보내기
    public function searchAction(){
        $searchValue = "%".$_POST['searchValue']."%";

        $this->productValues = $this->_connect_model->
          get('Product')->searchProductData($searchValue);

          $products_view = $this->render(array('product' => $this->productValues), "product", "template");
          return $products_view;
    }

    // 장바구니에 상품 담기,  (장바구니 존재여부 판단 및 장바구니테이블 생성)
    public function basketAction(){
      // 해당 아이디에 장바구니가 존재하는지 여부확인

      if(!isset($_SESSION['user']['user_name'])){
        echo "<script>alert('로그인 후 이용해주세요.')</script>";
        echo "<script> history.go(-1); </script>";
      } else{
        $user_name =  $_SESSION['user']['user_name'];

        // 현재 아이디가 장바구니를 만들었는지를 판단, 장바구니가 있으면 "t", 없으면 "f"
        $flag = $this->_connect_model->get('Product')->flagBasket($user_name);


            if($flag['basket'] == "f"){
              // 장바구니가 없다면 만든다.
              $this->_connect_model->get('Product')->createBasket($user_name);

              // 장바구니 여부값을 변경시킨다.
              $this->_connect_model->get('Product')->modifyBasketValue($user_name);
            }
              // else 장바구니가 있다면 장바구니에 상품에 대한 정보를 담는다.
              $this->_connect_model->get('Product')->insertIntoBasket($user_name);
              echo "<script> alert('장바구니에 담았습니다.');</script>";
              echo "<script> history.go(-1); </script>";


      } // 로그인 판단 if_else end
    }

    // 장바구니 내용 보여주기
    public function showBasketAction(){

      if(isset($_SESSION['user']['user_name'])){
        $user_name =  $_SESSION['user']['user_name'];
        $flag = $this->_connect_model->get('Product')->flagBasket($user_name);
        $valuesRow = $this->_connect_model->get('Product')->showBasket($user_name);
        $rowCount = count($valuesRow);
      }

      

      if(!isset($_SESSION['user']['user_name'])){
        echo "<script>alert('로그인 후 이용해주세요.')</script>";
        echo "<script> history.go(-1); </script>";

      } else if($flag['basket'] == "f" || $rowCount == 0 ){
        echo "<script>alert('장바구니 목록이 없습니다.')</script>";
        echo "<script> history.go(-1); </script>";
      }

      else {
          $user_name =  $_SESSION['user']['user_name'];

          $this->productValues = $this->_connect_model->
                get('Product')->showBasket($user_name);

          $products_view = $this->render(array('product' => $this->productValues), "showBasket", "template");
          return $products_view;
      }
    }

    // 장바구니에서 상품삭제하기
    public function deleteBasketAction(){
      $user_name_basket =  $_SESSION['user']['user_name']."_basket";

      $pnum = $_POST['hidden_p_Number'];
      $bnum = $_POST['hidden_b_Number'];

      $this->_connect_model->get('Product')->deleteBasket($user_name_basket, $pnum, $bnum);

      echo "<script>alert('장바구니 목록에서 제외했습니다.')</script>";
      echo "<script> history.go(-1); </script>";

    }

    // 구매하기
    public function buyProductAction(){
      $productName   = $_POST['Post_pName'];
      $productNumber = $_POST['Post_pNumber'];

      $productValues = $this->_connect_model->get('Product')->buyPoduct($productName, $productNumber);

      if($productValues == "false"){
        echo "<script>alert('<$productName>는(은) 재고가 없습니다.');</script>";
        echo "<script> history.go(-1); </script>";
      } else {
        echo "<script>alert('$productName 를(을) 구매했습니다.')</script>";
        echo "<script> history.go(-1); </script>";
      }
    }

    // 장바구니 내에서 구매하기 클릭
    public function buyProduct_in_BasketAction(){
      $user_name =  $_SESSION['user']['user_name'];
      $productName   = $_POST['Post_pName'];
      $productNumber = $_POST['Post_pNumber'];
      $Basket_product_Number = $_POST['Post_bNumber'];

      $productValues = $this->_connect_model->get('Product')->buyPoduct_in_Basket($user_name, $productName, $productNumber, $Basket_product_Number);

      if($productValues == "false"){
        echo "<script>alert('<$productName>는(은) 재고가 없습니다.');</script>";
        echo "<script> history.go(-1); </script>";
      } else {
        echo "<script>alert('$productName 를(을) 구매하여 장바구니에서 제외되었습니다.')</script>";
        echo "<script> history.go(-1); </script>";

      }

    }







/////
  }
 ?>
