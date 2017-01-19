<?php
  class ProductController extends Controller{
    public $p_rowCount;
    public $testValues;
    public $product_values;

    public function productAction(){
      // model 에서 product 테이블의 값들을 찾도록 해야함.
      $this->p_rowCount = $this->_connect_model->get('Product')->selectProduct();
      $this->product_values = array();

      // 찾은 값들을 배열로 저장
      $arrayRowCount = array($this->p_rowCount);


      // return $this->render($arrayRowCount, "product", "template");  // 값 넣어야됨.
      return $this->render($arrayRowCount, null, null);
    }

    public function TestButtonAction(){
      // model 에서 product 테이블의 값들을 찾도록 해야함.
      // 찾은 값들을 배열로 저장
      $this->testValues = $this->_connect_model->get('Product')->substituteProductData($this->p_rowCount, $this->product_values);
      // var_dump($this->testValues); // 배열로 값이 다 들어갔음!

      // return $this->render($arrayRowCount, "product", "template");  // 값 넣어야됨.

///////////////////  statuses를 $status로 배열형식의 변수로 만드는 방법를 보고 참고하기 /////////////////
              // $index_view = $this->render(array(
              //   'statuses' => $dat,//글목록 정보
              //   'message'  => '', //글작성 전이라 공백처리,form태그내 입력창의 입력된 내용
              //   '_token'   => $this->getToken(self::POST),
              // ));
              //
              // return $index_view;
/////////////////////////////////////////////////////////////////////////////////////////////////////

      // var_dump($this->testValues); // 배열로 값이 다 들어갔음!
      $products_view = $this->render(array('product' => $this->testValues), "product", "template");

      return $products_view;
    }



  }



 ?>
