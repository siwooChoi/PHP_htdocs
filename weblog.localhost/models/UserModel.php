<?php
class UserModel extends ExecuteModel {
  // **insert()***
    //http://php.net/manual/kr/function.password-hash.php
    //패스워드의 해쉬 처리 : 암호화
    //http://php.net/manual/kr/datetime.format.php
    //DateTime::format
  public function insert($user_name, $password, $nick, $tel, $email) {
    if($nick == ""){
      $nick = "닉네임 없음";
    }

    if($tel == "--"){
      $tel = "010-0000-0000";
    }

    if($email == "@"){
      $email = "none@none";
    }

      $password = password_hash($password,
                                PASSWORD_DEFAULT);
      $now = new DateTime();
      $sql = "INSERT INTO user(user_name, password, nick, tel, email, time_stamp, basket)
              VALUES(:user_name, :password, :nick, :tel, :email, :time_stamp, :basket)";
      $stmt = $this->execute($sql, array(
          ':user_name'  => $user_name,
          ':password'   => $password,
          ':nick'       => $nick,
          ':tel'        => $tel,
          ':email'      => $email,
          ':time_stamp' => $now->format('Y-m-d H:i:s'),
          ':basket'     => "f"
      ));
       // execute(); 추상 클래스 ExecuteModel의 메소드
  }

  // ***getUserRecord()***
  public function getUserRecord($user_name) {
      $sql = "SELECT *
              FROM   user
              WHERE  user_name = :user_name";

      $userData = $this->getRecord(
                         $sql,
                         array(':user_name' => $user_name));
  // getRecord(); 추상 클래스 ExecuteModel의 메소드
      return $userData;
  }

  public function deleteId($user_number){
    $sql = "delete from user where id = $user_number";
    $this->execute($sql);
  }

  // ***isOverlapUserName()***
  public function isOverlapUserName($user_name) {
      $sql = "SELECT COUNT(id) as count
              FROM   user
              WHERE  user_name = :user_name";

      $row = $this->getRecord(
                    $sql,
                    array(':user_name' => $user_name));
      if ($row['count'] === '0') {
        // $user_name의 유저가 미동륵이면
          return true;
      }
      return false;
  }

  // ***getFollowingUser()***
  public function getFollowingUser($user_id) {
    $sql = "SELECT    u.*
            FROM      user u
            LEFT JOIN followingUser f ON f.following_id = u.id
            WHERE     f.user_id = :user_id";
    $follows = $this->getAllRecord(
                      $sql,
                      array(':user_id' => $user_id));
    return $follows;
  }
}
