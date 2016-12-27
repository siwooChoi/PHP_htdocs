<?php
  require_once "./prec_mod/DBManager.php";




  class mod {

  public $dbo;

    // 디비 생성
    public function __construct(){
      print "mod의 생성자가 실행됨<br>";
      try{
            $this->dbo = connect();
      }catch(PDOException $e) {
         exit("에러발생 {$e->getMessage()}");
      }
    }

    // 테스트 메서드
    public function testalert(){
      echo "<script>alert('mod 안의 Test메서드');</script>";
    }

    // 아이디체크 _ controlor/control.php 에서 호출 // 값이 제대로 넘어간다는걸 확인성공
    public function checkId(){
      // echo $_POST["userid"];

          $sql = "select * from member where id = :id_of_post and pass = :pw_of_post";
          $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
          $stt->execute(array(':id_of_post'=>$_POST["userid"], ':pw_of_post'=>$_POST["userpw"]));
          $result = $stt->rowCount();

          if($result){

            $sql = "select * from member where id = :id";
            $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
            $stt->execute(array(':id'=>$_POST['userid']));
            $row = $stt->fetch();

            $_SESSION['userid'] = $row['id'];
            $_SESSION['userName'] = $row['name'];
            $_SESSION['userNick'] = $row['nick'];
            $temp_hp = $row['hp'];
            $explode_hp = explode("-", $temp_hp);
            $_SESSION['userTel1'] = $explode_hp[0];
            $_SESSION['userTel2'] = $explode_hp[1];
            $_SESSION['userTel3'] = $explode_hp[2];

            $temp_email = $row['email'];
            $explode_email = explode("@", $temp_email);
            $_SESSION['userEmail1'] = $explode_email[0];
            $_SESSION['userEmail2'] = $explode_email[1];

            // $this->view_content();
            // $this->view_product();
            // control::logon($result, $_POST["userid"], $_POST["userpw"]);


          } else{
            echo "<script> alert('아이디 및 비밀번호가 잘못되었습니다.');</script>";
            echo "<script> location.replace('../index.php'); </script>";
          }
          echo "<script> location.replace('../index.php'); </script>";
    }

    // 로그아웃
    public function logout(){
      session_destroy();

      echo("<script>  location.replace('../index.php');  </script>");
      // $this->view_product();
    }
    // 회원가입
    public function createUser(){
      // $sql = "select * from member;";
      // $stt = $this->dbo->prepare($sql);
      // $row = $stt->execute();
      $sql = "select id from member where id = :id_of_post";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(':id_of_post'=>$_POST["createId"]));
      $row = $stt->fetch();

      echo $row[0];

      // id중복검사
      if($_POST['createId'] != "" && $_POST['createId'] == $row[0]){
        echo "<script> alert('중복된 아이디 입니다.');</script>";
        echo "<script> history.go(-1); </script>";
        exit;
      }

      // 비번, 비번확인  같은가
      if($_POST['createPw1'] != $_POST['createPw2']){
        echo "<script> alert('비밀번호와 비밀번호확인이 일치하지 않습니다.');</script>";
        echo "<script> history.go(-1); </script>";
        exit;
      }

      // 아이디,비번 이외의 입력공간에 공백이 있을 경우
      if(($_POST['createName'] || $_POST['createNick'] || $_POST['createTel1'] || $_POST['createTel2']
        || $_POST['createTel3'] || $_POST['createEmail']) == ""){
        echo "<script> alert('입력하지 않은 내용이 있습니다.');</script>";
        echo "<script> history.go(-1); </script>";
          exit;
      }


      $createTel = $_POST['createTel1']."-".$_POST['createTel2']."-".$_POST['createTel1'];
      $createEmail = $_POST['createEmail1']."@".$_POST['createEmail2'];
      $regist_day = date("Y-m-d (H:i)");
      $level = 1;
      $sql = "insert into member(id, pass, name, nick, hp, email, regist_day, level, basket) values(:id, :pass, :name, :nick, :hp, :email, :regist_day, :level, :basket)";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(':id'=>$_POST["createId"],
                          ':pass'=>$_POST["createPw1"],
                          ':name'=>$_POST["createName"],
                          ':nick'=>$_POST["createNick"],
                          ':hp'=>$createTel,
                          ':email'=>$createEmail,
                          ':regist_day'=>$regist_day,
                          ':level'=>$level,
                          ':basket'=>"off"
                        )
                        );

      $_SESSION['userName'] = $_POST['createName'];
      $_SESSION['userNick'] = $_POST['createNick'];
      $_SESSION['userTel1'] = $_POST['createTel1'];
      $_SESSION['userTel2'] = $_POST['createTel2'];
      $_SESSION['userTel3'] = $_POST['createTel3'];
      $_SESSION['userEmail1'] = $_POST['createEmail1'];
      $_SESSION['userEmail2'] = $_POST['createEmail2'];
      $_SESSION['usertel'] = $createTel;
      $_SESSION['userLevel'] = $level;
      $_SESSION['basket'] = "off";

      echo "<script> alert('가입 완료.');</script>";
      echo "<script> location.replace('../index.php'); </script>";
    }

    // 정보수정 전 정보 불러오기
    public function modifybebore(){
      $sql = "select * from member where id = :id";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(':id'=>$_SESSION['userid']));
      $row = $stt->fetch();


      $_SESSION['beforeName'] = $row['name'];
      $_SESSION['beforeNick'] = $row['nick'];
          /*explode 사용예
              $문자열 = "문자열-문자열";
              $arr = explode("-", $문자열);
              echo $arr[0];
              echo $arr[1];
          */
      $temp_hp = $row['hp'];
      $explode_hp = explode("-", $temp_hp);
      $_SESSION['beforeTel1'] = $explode_hp[0];
      $_SESSION['beforeTel2'] = $explode_hp[1];
      $_SESSION['beforeTel3'] = $explode_hp[2];

      $temp_email = $row['email'];
      $explode_email = explode("@", $temp_email);
      $_SESSION['beforeEmail1'] = $explode_email[0];
      $_SESSION['beforeEmail2'] = $explode_email[1];

    }

    // 정보수정 하기
    public function modifyUser(){

      // 비번, 비번확인  같은가
      if($_POST['modifyPw1'] != $_POST['modifyPw2']){
        echo "<script> alert('비밀번호와 비밀번호확인이 일치하지 않습니다.');</script>";
        echo "<script> history.go(-1); </script>";
        exit;
      }

      // 아이디,비번 이외의 입력공간에 공백이 있을 경우
      if(($_POST['modifyName'] || $_POST['modifyNick'] || $_POST['modifyTel1'] || $_POST['modifyTel2']
        || $_POST['modifyTel3'] || $_POST['modifyEmail']) == ""){
        echo "<script> alert('입력하지 않은 내용이 있습니다.');</script>";
        echo "<script> history.go(-1); </script>";
          exit;
      }

      $modifyTel = $_POST['modifyTel1']."-".$_POST['modifyTel2']."-".$_POST['modifyTel1'];
      $modifyEmail = $_POST['modifyEmail1']."@".$_POST['modifyEmail2'];



      $sql = "update member set pass=:pass, name=:name, nick=:nick, hp=:hp, email=:email where id=:id;)";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(':pass'=>$_POST["modifyPw1"],
                          ':name'=>$_POST["modifyName"],
                          ':nick'=>$_POST["modifyNick"],
                          ':hp'=>$modifyTel,
                          ':email'=>$modifyEmail,
                          ':id'=>$_SESSION['userid']

                        ));

          $_SESSION['userName'] = $_POST['modifyName'];
          $_SESSION['userNick'] = $_POST['modifyNick'];


      //
      echo "<script> alert('수정 완료.');</script>";
      echo "<script> location.replace('../index.php'); </script>";

    }

    // 회원탈퇴
    public function deleteUser(){
      $sql = "delete from member where id = :id";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(':id'=>$_SESSION["userid"]));
      session_destroy();

      echo "<script> alert('탈퇴 완료.');</script>";
      echo "<script> location.replace('../index.php'); </script>";

    }

    // 검색
    // public function search(){
    //   $_SESSION['search'] = $_POST['search'];
    //   echo "<script> location.replace('../index.php'); </script>";
    // }

    // 상품등록
    public function insert_product(){

      echo $_SESSION['p_name']."<br>";
      echo $_SESSION['p_price']."<br>";
      echo $_SESSION['p_comment']."<br>";
      echo $_SESSION['p_type']."<br>";
      echo $_SESSION['p_amount']."<br>";
      echo $_SESSION['p_imgname']."<br>";


      $sql = "INSERT INTO product(p_Name, p_Price, p_Comment, p_Type, p_Amount, p_Imgname)
                        VALUES(:p_name, :p_price, :p_comment, :p_type, :p_amount, :p_imgname)";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(
                          ':p_name'=>$_SESSION['p_name'],
                          ':p_price'=>$_SESSION['p_price'],
                          ':p_comment'=>$_SESSION['p_comment'],
                          ':p_type'=>$_SESSION['p_type'],
                          ':p_amount'=>$_SESSION['p_amount'],
                          ':p_imgname'=>$_SESSION['p_imgname']
                        ));

      echo "<script> alert('등록 완료.');</script>";
      echo "<script> location.replace('../index.php'); </script>";


    }



    // DB에서 상품찾기
    public function view_product(){

        $sql = "select * from product";
        $stt = $this->dbo->prepare($sql);
        $stt->execute();
        $rowCount = $stt->rowCount();
        $row = $stt->fetchAll();

        for($i = 0 ; $i<$rowCount;$i++){

        }
      echo "<script> location.replace('../index.php') </script>";
    }

    // 검색으로 상품찾기
    public function product_search($search){
      $s = "%".$search."%";
      $sql = "select * from product where p_Name like :p_name or p_Comment like :p_name2";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(
                          ':p_name'=>$s,
                          ':p_name2'=>$s
                        ));
      $rowCount = $stt->rowCount();
      $row = $stt->fetchAll();

      $_SESSION['row'] = $row;
      $_SESSION['rowCount'] = $rowCount;

      for($i = 0 ; $i<$rowCount;$i++){
        $_SESSION["p_Name_$i"] = $row[$i]["p_Name"];
        $_SESSION["p_Price_$i"] = $row[$i]["p_Price"];
        $_SESSION["p_Comment_$i"] = $row[$i]["p_Comment"];
        $_SESSION["p_Type_$i"] = $row[$i]["p_Type"];
        $_SESSION["p_Amount_$i"] = $row[$i]["p_Amount"];
        $_SESSION["p_Imgname_$i"] = $row[$i]["p_Imgname"];
      }
        echo "<script> location.replace('../index.php') </script>";
    }

    // 게시판 글 보여주기
    public function view_content(){
      $sql = "select * from content";
      $stt = $this->dbo->prepare($sql);
      $stt->execute();
      $rowCount = $stt->rowCount();
      $row = $stt->fetchAll();

      $_SESSION['content_row'] = $row;
      $_SESSION['content_rowCount'] = $rowCount;


      for($i = 0 ; $i<$rowCount;$i++){
        $_SESSION["c_num_$i"] = $row[$i]["num"];
        $_SESSION["c_id_$i"] = $row[$i]["id"];
        $_SESSION["c_name_$i"] = $row[$i]["name"];
        $_SESSION["c_nick_$i"] = $row[$i]["nick"];
        $_SESSION["c_content_$i"] = $row[$i]["content"];
        $_SESSION["c_registday_$i"] = $row[$i]["regist_day"];
      }
      // echo "<script> location.replace('../index.php') </script>";
    }

    // 게시판 글 작성
    public function create_content(){
      $regi = date("Y-m-d");
      $regist_day = substr($regi, 0, 10);


      $sql = "INSERT INTO content(id, name, nick, content, regist_day)
                        VALUES(:id, :name, :nick, :content, :regist_day)";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(
                          ':id'=>$_SESSION['userid'],
                          ':name'=>$_POST['boardname'],
                          ':nick'=>$_SESSION['userNick'],
                          ':content'=>$_POST['content'],
                          ':regist_day'=>$regist_day
                        ));

      echo "<script> alert('작성 완료.');</script>";
      // echo "<script> location.replace('../index.php'); </script>";
      echo "<script> location.replace('../index.php?mode=menu2view'); </script>";

      $this->view_content();
    }

    // 게시판 글 삭제
    public function contentDelete($argContent){
      $c_num = $argContent;
      $sql = "delete from content where num = :num";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(':num'=>$c_num));


      echo "<script> alert('삭제완료');</script>";
      $this->view_content();
      // echo "<script> history.go(-1); </script>";
      echo "<script> location.replace('../index.php?mode=menu2view'); </script>";


    }

    // 게시 글 수정
    public function contentModify($contentnum, $after_title, $after_content){

      $sql = "update content set name=:name, content=:content where num=:num";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(
                          ':name'=>$after_title,
                          ':content'=>$after_content,
                          ':num'=>$contentnum
                        ));
                        echo "<script> alert('수정 완료.');</script>";

      $this->view_content();
      echo "<script> location.replace('../index.php?mode=menu2view'); </script>";



      // echo "<script> alert('수정완료');</script>";
      // echo "<script> history.go(-1); </script>";



    }

    // 장바구니 없다면 생성, 있으면 생략
    public function createBasket(){
      $sql = "select basket from member where id = :id";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(
                          ':id'=>$_SESSION['userid']
                        ));
      $row = $stt->fetch();
      // echo $row['basket'];    아직 안만들었으면 off;

      if($row['basket'] == "off"){
        $id = $_SESSION['userid'];
        $sql = "create table $id(
                 p_Number int AUTO_INCREMENT,
                 p_Name varchar(30) not null,
                 p_Price int not null,
                 p_Comment varchar(40),
                 p_Type varchar(15),
                 p_Amount int not null,
                 p_Imgname varchar(40),
                 regist_day char(20),
                 primary key(p_Number)
                 )";
        // $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
        // $stt->execute(array(  ':id'=>$_SESSION['userid']  ));

        $stt = $this->dbo->prepare($sql);
        $stt->execute();
      $this->modifyBasket();  // member 에서 $row['basket']  on으로 바꿔주기
      // echo "장바구니 생성!";
      } else{
        // echo "장바구니 이미 있음<br>";
      }


    }

    // 장바구니존재여부 값 바꾸기
    public function modifyBasket(){
      $sql = "update member set basket='on' where id = :id;";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(':id'=>$_SESSION['userid']));

          // 장바구니 on으로 변경되는지 확인
      // $sql = "select basket from member where id = :id";
      // $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      // $stt->execute(array(
      //                     ':id'=>$_SESSION['userid']
      //                   ));
      // $row = $stt->fetch();
      //
      //
      // echo $row['basket'];  //  아직 안만들었으면 off;  만들었으면 on
    }

    // 장바구니 insert
    public function insertBasket(){


              //장바구니 담을 때 사용할 변수들.
              // $id = $_SESSION['userid'];
              //   $_POST['insertBasket_pName']
              //   $_POST['insertBasket_pPrice']
              //   $_POST['insertBasket_pComment']
              //   $_POST['insertBasket_pType']
              //   $_POST['insertBasket_pAmount']
              //   $_POST['insertBasket_pImgname']
      $id = $_SESSION['userid'];
      $regist_day = date("Y-m-d (H:i)");

      $sql = "insert into $id(p_Name, p_Price, p_Comment, p_Type, p_Amount, p_Imgname, regist_day)
                      values(:p_name, :p_price, :p_comment, :p_type, :p_amount, :p_imgname, :regist_day)";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(':p_name' => $_POST['insertBasket_pName'],
                          ':p_price' => $_POST['insertBasket_pPrice'],
                          ':p_comment' => $_POST['insertBasket_pComment'],
                          ':p_type' => $_POST['insertBasket_pType'],
                          ':p_amount' => $_POST['insertBasket_pAmount'],
                          ':p_imgname' => $_POST['insertBasket_pImgname'],
                          ':regist_day'=> $regist_day
                        )
                        );

      echo "<script> alert('장바구니에 담았습니다.');</script>";
      echo "<script> history.go(-1); </script>";
    }

    // 내 장바구니 보기 (DB에서 내 장바구니정보 찾기)
    public function showMyBasket(){
      $id = $_SESSION['userid'];
      $sql = "select * from $id";
      $stt = $this->dbo->prepare($sql);
      $stt->execute();
      $rowCount = $stt->rowCount();
      $row = $stt->fetchAll();

      $_SESSION['inBasket_row'] = $row;
      $_SESSION['inBasket_rowCount'] = $rowCount;


      for($i = 0 ; $i<$rowCount;$i++){
        $_SESSION["inBasket_p_Num_$i"] = $row[$i]["p_Number"];
        $_SESSION["inBasket_p_Name_$i"] = $row[$i]["p_Name"];
        $_SESSION["inBasket_p_Price_$i"] = $row[$i]["p_Price"];
        $_SESSION["inBasket_p_Comment_$i"] = $row[$i]["p_Comment"];
        $_SESSION["inBasket_p_Type_$i"] = $row[$i]["p_Type"];
        $_SESSION["inBasket_p_Amount_$i"] = $row[$i]["p_Amount"];
        $_SESSION["inBasket_p_Imgname_$i"] = $row[$i]["p_Imgname"];
        $_SESSION["inBasket_p_registday_$i"] = $row[$i]["regist_day"];
      }
    }


    // 회원탈퇴 시 장바구니도 같이 사라지게함
    public function dropBasket($basketName){
      // 장바구니 사라지게 하는 sql 만들기.
      // 회원가입function 안에  이 function호출하기.
      $basketName = $basketName;
      // $sql = "drop table"
    }

    // 장바구니에서 상품삭제.
    public function basketProductDelete($argContent){
      $id = $_SESSION['userid'];
      $p_num = $argContent;
      $sql = "delete from $id where p_Number = :p_num";
      $stt = $this->dbo->prepare($sql, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
      $stt->execute(array(':p_num'=>$p_num));

      // echo $p_num;
      echo "<script> alert('장바구니에서 지웠습니다.');</script>";
      $this->showMyBasket();
      echo "<script> location.replace('../index.php?mode=viewMyBasket'); </script>";

    }

}

























?>
