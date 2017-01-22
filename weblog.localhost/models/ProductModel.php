<?php
class ProductModel extends ExecuteModel {

  public function tt(){
    return 2;
  }

  // DB에 있는 상품들을 각 배열에 값저장하기
  public function substituteProductData(){
    $productArray = array();

    $sql = "select * from product order by p_Number desc";
    $productArray = $this->getAllRecord($sql);

    return $productArray;
  }

    // search로 DB상품 찾기
  public function searchProductData($argSearchValue){
    $productArray = array();
    $sql = "select * from product where p_Name like :p_name or p_Comment like :p_name";
    $productArray = $this->getAllRecord($sql, array(':p_name' => $argSearchValue));
    return $productArray;
  }

  // 상품상세설명 상품값 찾기
  public function getDetailData($p_Number){
    $productArray = array();
    $sql = "select * from product where p_Number = :p_Number";
    $productArray = $this->getAllRecord($sql, array(':p_Number' => $p_Number));
    return $productArray;
  }

  // 해당 아이디에 장바구니가 존재하는지 여부 검사
  public function flagBasket($user_name){
    $sql = "select basket from user where user_name = :user_name";
    $flag = $this->getRecord($sql, array(':user_name' => $user_name));
    return $flag;
  }

  // 장바구니 만들기
  public function createBasket($user_name){
    $user_name_basket = $user_name."_basket";
    // echo "$user_name_basket"."<br><br>";

    $sql = "create table $user_name_basket (
             b_Number int AUTO_INCREMENT,
             p_Number int,
             p_Name varchar(30) not null,
             p_Price int not null,
             p_Comment varchar(40),
             p_Type varchar(15),
             p_Amount int not null,
             p_Imgname varchar(40),
             regist_day char(20),
             primary key(b_Number)
           )";
    // $sql = "select * from user where user_name = :user_name;";
    // $stt = $this->execute($sql, array(':user_name' => $user_name));
    // $stt = $this->execute($sql, array(':user_name_basket' => $user_name_basket));
    $this->execute($sql);
  }

  // 장바구니 여부 f를 t로 바꾸기
  public function modifyBasketValue($user_name){
    $sql = "update user set basket = 't' where user_name = :user_name";
    $this->execute($sql, array(':user_name' => $user_name));
  }

  // 장바구니에 상품 담기
  public function insertIntoBasket($user_name){

    $id_basket = $user_name."_basket";

    $regist_day = new DateTime();
    $regist_day = $regist_day->format('Y-m-d H:i');


    $sql = "insert into $id_basket(p_Number, p_Name, p_Price, p_Comment, p_Type, p_Amount, p_Imgname, regist_day)
                    values(:p_number, :p_name, :p_price, :p_comment, :p_type, :p_amount, :p_imgname, :regist_day)";

    $this->execute($sql, array(
                        ':p_number'     => $_POST['Post_pNumber'],
                        ':p_name'       => $_POST['Post_pName'],
                        ':p_price'      => $_POST['Post_pPrice'],
                        ':p_comment'    => $_POST['Post_pComment'],
                        ':p_type'       => $_POST['Post_pType'],
                        ':p_amount'     => $_POST['Post_pAmount'],
                        ':p_imgname'    => $_POST['Post_pImgname'],
                        ':regist_day'   => $regist_day
                      )
                  );

  }

  // 장바구니의 목록 보여주기
  public function showBasket($user_name){
    $id_basket = $user_name."_basket";
    $productArray = array();

    $sql = "select * from $id_basket order by b_Number desc";
    $productArray = $this->getAllRecord($sql);

    return $productArray;
  }

  // 장바구니에서 목록삭제하기
  public function deleteBasket($user_name_basket, $pnum, $bnum){
    $sql = "delete from $user_name_basket where p_Number = :pnum and b_Number = :bnum";
    $this->execute($sql, array(':pnum' => $pnum,
                               ':bnum' => $bnum)
                    );
  }

  // 물품구매하기
  public function buyPoduct($productName, $productNumber){

        // 재고 구하기.
    $sql = "select * from product where p_Number = :pnum";
    $stt = $this->execute($sql, array(':pnum'=>$productNumber));
    $productAmount = $stt->fetch();
    $productAmount = $productAmount['p_Amount'];


        // 해당상품의 재고에 따라 판매가능, 불가능
    if($productAmount <= 0){
      // echo "<script>alert('모델에서 script  :  <$productValues>');</script>";
      return "false";
    } else {
             // 구매 시 재고수량 -1 시키기
            $sql = "update product set p_Amount = p_Amount - 1 where p_Number = :pnum";
            $stt = $this->execute($sql, array(':pnum'=>$productNumber));
    }
  }

  // 장바구니 내에서 물품구매하기
  public function buyPoduct_in_Basket($user_name, $productName, $productNumber, $Basket_product_Number){

    $user_name_basket = $user_name."_basket";

        // 재고 구하기.
    $sql = "select * from product where p_Number = :pnum";
    $stt = $this->execute($sql, array(':pnum'=>$productNumber));
    $productAmount = $stt->fetch();
    $productAmount = $productAmount['p_Amount'];


        // 해당상품의 재고에 따라 판매가능, 불가능
    if($productAmount <= 0){
      // echo "<script>alert('모델에서 script  :  <$productValues>');</script>";
      return "false";
    } else {
             // 구매 시 재고수량 -1 시키기
            $sql = "update product set p_Amount = p_Amount - 1 where p_Number = :pnum";
            $stt = $this->execute($sql, array(':pnum'=>$productNumber));
    }

    $this->deleteBasket($user_name_basket, $productNumber, $Basket_product_Number);
  }



}

?>
