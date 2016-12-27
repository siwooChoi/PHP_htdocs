<?php
  session_start();
  require_once "../mod/mod.php";

  class control{

    public $mod;

    public function __construct(){
      $this->mod = new mod();
    }

    // 테스트 메서드
    public function testM(){
      echo " <script> alert('detail_on start!'); </script>";
    }

    // 로그인아이디 비번 체크 _ controlB.php 에서 호출
    public function checkId() {
      $this->mod->checkId();
    }

    // 로그인
    // public function logon($argResult, $argId, $argPw){
    //
    //   $result = $argResult;
    //   $a = $argId;
    //   $b = $argPw;
    //
    //   if($result){
    //     $userid = $_POST['userid'];
    //     $userpw = $_POST['userpw'];
    //
    //      $_SESSION['userid'] = $userid;
    //      $_SESSION['userpw'] = $userpw;
    //
    //
    //     //  echo("
    //     //     <script>
    //     //       location.replace('../index.php');
    //     //     </script>
    //     //  ");
    //   } else{
    //     echo("
    //        <script>
    //          alert('비밀번호가 틀립니다.');
    //          history.go(-1);
    //        </script>
    //     ");
    //   }
    //   // $this->mod->view_product();
    //   // $this->mod->view_content();
    // }          // 없어도됨. checkId 에서 해결

    // 로그아웃
    public function logout(){
      $this->mod->logout();
    }

    // 아이디정보 불러온 후 정보수정 페이지로 이동
    public function modify(){
      $this->mod->modifybebore();
      echo "<script> location.replace('../view/modify.php'); </script>";
    }

    // 회원정보 수정하기
    public function modifyUser(){
      $this->mod->modifyUser();
    }

    // 회원탈퇴
    public function deleteUser(){
      $this->mod->deleteUser();
    }

    // 회원가입
    public function createUser(){
        $this->mod->createUser();
      }

    // ID중복확인
    public function createCheckId(){
      $this->mod->createCheckId();
    }

    // (관리자)상품등록 클릭했을 때
    public function upload_product1(){
      // $this->mod->upload_product();
      require_once "../view/upload_product.php";
    }

    // DB에 상품insert 하기
    public function upload_product2(){
      $this->mod->insert_product();
    }

    public function resetSearch(){
      $this->mod->view_product();
    }

    // 상품 검색
    public function product_search($search){
      $this->mod->product_search($search);
    }

    // 게시판 글 보여주기 기능
    public function view_content(){
      $this->mod->view_content();
    }

    // 게시글 작성
    public function create_content(){
      $this->mod->create_content();
    }

    // 게시글 삭제
    public function contentDelete($argContent){
      $this->mod->contentDelete($argContent);
    }

    // 게시글 수정
    public function contentModify($contentnum, $after_title, $after_content){
      $this->mod->contentModify($contentnum, $after_title, $after_content);
    }

    // 장바구니가 없으면 만들고, 있다면 생략
    public function createBasket(){
      $this->mod->createBasket();
    }

    // 장바구니에 담기
    public function insertBasket(){
      $this->mod->insertBasket();
    }

    // 내 장바구니 보기.
    public function showMyBasket(){
      $this->mod->showMyBasket();
    }
    // 장바구니 상품삭제
    public function basketProductDelete($argContent){
      $this->mod->basketProductDelete($argContent);
    }




}




?>
