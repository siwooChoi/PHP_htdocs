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
        $searchValue = "%".$this->_request->getPost('searchValue')."%";

        $this->productValues = $this->_connect_model->
          get('Product')->searchProductData($searchValue);

          $products_view = $this->render(array('product' => $this->productValues), "product", "template");
          return $products_view;
    }

    // 관리자 상품등록페이지 호출
    public function adminUpPageAction(){
      return $this->render();
    }

    // 관리자 상품삭제하기
    public function admindeleteProductAction(){
      $delete_p_number = $this->_request->getPost('deleteNumber');

      $this->productValues = $this->_connect_model->
        get('Product')->admindeleteProduct($delete_p_number);

        echo "<script>alert('상품정보 삭제 완료')</script>";
        echo "<script> location.replace('/index.php'); </script>";

    }

    // 관리자 상품등록하기
    public function adminUploadProductAction(){
      $up_p_name = $this->_request->getPost('p_name');
      $up_p_price = $this->_request->getPost('p_price');
      $up_p_comment = $this->_request->getPost('p_comment');
      $up_p_type = $this->_request->getPost('p_type');
      $up_p_amount = $this->_request->getPost('p_amount');
      $up_p_imgname = $_FILES['myfile']['name'];
      $up_p_detail = $this->_request->getPost('p_detail');

      $up_p_values = array($up_p_name, $up_p_price, $up_p_comment, $up_p_type,
                           $up_p_amount, $up_p_imgname, $up_p_detail
                          );

      $this->productValues = $this->_connect_model->
        get('Product')->adminUploadProduct($up_p_values);

        echo "<script>alert('상품 등록 완료')</script>";
        echo "<script> location.replace('/index.php'); </script>";
    }

    // 사진업로드
    public function fileuploadAction(){
       // 설정
       $file = array();
       // 변수 정리
       $file['error'] = $_FILES['myfile']['error']; //파일 업로드에 관련한 에러 코드.
       $file['fname'] = $_FILES['myfile']['name']; //넘어온 파일의 이름을 추출할때 사용
       $file['ftype'] = pathinfo($file['fname'])['extension']; //파일의 확장자를 확인을 하기 위해서 한것이다.
       $file['fsize'] = $_FILES['myfile']['size'];// 파일의 사이즈
       $file['fpath'] = './img/'.$file['fname'];
       $file['allowed_ext'] = array('JPG','jpg','jpeg','png','gif','txt');

       // 오류 확인
       if( $file['error'] != UPLOAD_ERR_OK ) {
           switch( $file['error'] ) {
               case UPLOAD_ERR_INI_SIZE: //업로드한 파일이 php.ini파일의 upload_max_filesize 지시어보다 큽니다.
               case UPLOAD_ERR_FORM_SIZE://업로드한 파일이 HTML 폼에서 지정한 MAX_FILE_SIZE 지시어보다 큽니다.
                   echo "<script>window.alert(파일이 너무 큽니다. (".$file['error']."));</script>";
                   break;
               case UPLOAD_ERR_NO_FILE:
                   echo "<script>window.alert(파일이 첨부되지 않았습니다. (".$file['error']."));</script>";
                   break;
               default:
                   echo "<script>window.alert(파일이 제대로 업로드되지 않았습니다. (".$file['error']."));</script>";
           }
           exit;
       }

       // 확장자 확인
       if( !in_array($file['ftype'], $file['allowed_ext']) ) {
           echo "허용되지 않는 확장자입니다.";
           exit;
       }

       // 파일 이동
       //move_uploaded_file는 임시로 저장이 된 파일을 디렉토리에 옮기는 함수이다. 첫번째 인자는 임시저장한 파일, 두번째 인자는 이동할 디렉토리경로와 파일명을 적는다.
       //$_FILES[yourfile]['tmp_name']는 서버에 저장된 업로드된 파일의 임시 파일 이름을 말한다.
       move_uploaded_file( $_FILES['myfile']['tmp_name'], $file['fpath']);

       $this->adminUploadProductAction();
       $backPage = "<script> history.go(-2); </script>";

      //  return $backPage;
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
      }

      if($flag['basket'] == "t" ){
        $valuesRow = $this->_connect_model->get('Product')->showBasket($user_name);
        $rowCount = count($valuesRow);
      }

      if(!isset($_SESSION['user']['user_name'])){
        echo "<script>alert('로그인 후 이용해주세요.')</script>";
        echo "<script> history.go(-1); </script>";
      }
        if($flag['basket'] == "f" || $rowCount == 0 ){
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

      $pnum = $this->_request->getPost('hidden_p_Number');
      $bnum = $this->_request->getPost('hidden_b_Number');

      $this->_connect_model->get('Product')->deleteBasket($user_name_basket, $pnum, $bnum);

      echo "<script>alert('장바구니 목록에서 제외했습니다.')</script>";
      echo "<script> history.go(-1); </script>";

    }

    // 구매하기
    public function buyProductAction(){
      $productName   = $this->_request->getPost('Post_pName');
      $productNumber = $this->_request->getPost('Post_pNumber');

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
      $productName   = $this->_request->getPost('Post_pName');
      $productNumber = $this->_request->getPost('Post_pNumber');
      $Basket_product_Number = $this->_request->getPost('Post_bNumber');

      $productValues = $this->_connect_model->get('Product')->buyPoduct_in_Basket($user_name, $productName, $productNumber, $Basket_product_Number);

      if($productValues == "false"){
        echo "<script>alert('<$productName>는(은) 재고가 없습니다.');</script>";
        echo "<script> history.go(-1); </script>";
      } else {
        echo "<script>alert('$productName 를(을) 구매하여 장바구니에서 제외되었습니다.')</script>";
        echo "<script> history.go(-1); </script>";

      }

    }

    // 회원탈퇴시 장바구니 삭제
    public function deleteUserBasketAction($user_name){
      $this->_connect_model->get('Product')->deleteUserBasket($user_name);

    }





/////
  }
 ?>
