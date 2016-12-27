<?php

  require_once 'DBManager.php';
   // include       <-- 없어도 실행은 하지만 언젠가 에러가 날지도 모름
   // include_once  <-- 필요할떄 한번만 include 함   메모리절약
   // require       <-- 실행 하기 위한 것이 없으면 바로 에러
   // require_once  <-- 실행을 하기 위해서 반드시 필요한 것을, 한번만 부르겠다.

   try{
     $dbo = connect();    // user_data 라는 이 형식의 테이블을 만들었다면 이 코드가 실행가능
     $sql = 'INSERT INTO user_data VALUES(:id,
                                          :name,
                                          :zipcode,
                                          :address,
                                          :tel,
                                          :email)'
                                    //:필드명   <-- place holder
    $dbo->prepare($sql,
                  array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
                  // 커서가 앞뒤로 왔다갔다 하면서 읽는다.
                  // SCROLL로 하면 순서를 뒤바꿔도 실행이 된다.
                  // FWDONLY는 커서가 한방향으로만 가기 때문에 순서가 바뀌면 에러.
    $pdostt->execute( array(    //execute의 반환값은 boolean(true,false) 이다.
        ':id'=>$_POST['id'],
        ':name'=>$_POST['name'],
        ':zipcode'=>$_POST['zipcode'],
        ':address'=>$_POST['address'],
        ':tel'=>$_POST['tel'],
        ':email'=>$_POST['email']
      )
    );

    $dbo = NULL;    // DB를 절단하는 역할

  } catch(PDOException $e) {
      exit("에러발생 : {$e->getMessage()}");

   }
 ?>
