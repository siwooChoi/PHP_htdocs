<?php
class AccountController extends Controller {
  protected $_authentication = array('index', 'signout');

   //login에 필요한 action정의
  const SIGNUP = 'account/signup';
  const SIGNIN = 'account/signin';
  // const FOLLOW = 'account/follow';

  // test //
  public function alertAction(){
    print "<script> alert('test') </script>";
    $this->redirect('/account');
  }

  // 인덱스
  public function indexAction() {
    // /views/account/index.php
    $user = $this->_session->get('user');
    $followingUsers = $this->_connect_model
                           ->get('User')
                           ->getFollowingUser($user['id']);

    $index_view = $this->render(array(
      'user'           => $user,
      'followingUsers' => $followingUsers,
    ));
    return $index_view;
  }

  // 회원가입
  public function signupAction() {
    if ($this->_session->isAuthenticated()) {
      // 여기서는 $this->_session 이 보이지 않는다.
      // 이 $this가 가리키는 것은 상속받고 있는 'Controller'

      $this->redirect('/account');
    }
    $signup_view = $this->render(array(
        'user_name' => '',
        'password'  => '',
        'nick'      => '',
        'tel'       => '',
        'email'     => '',
        'basket'    => '',
        '_token'    => $this->getToken(self::SIGNUP),
     //Controller클래스의 CSRF(Cross-site request forgery,사이트간 요청위조) 대책용 Token을생성
   //http://namu.wiki/w/CSRF
    ));
    return $signup_view;
  }

  // 회원가입 체크
  public function registerAction() {
      //signup.php내의 form태그 action에서의 설정
      //1>POST 전송박식으로 전달 받은 데이터에 대한 체크
      if (!$this->_request->isPost()) {
          $this->httpNotFound();
          // FileNotFoundException 예외객체를 생성
      }

      if ($this->_session->isAuthenticated()) {
        $this->redirect('/account');
      }
      //2>CSRF대책의 Token 체크
      $token = $this->_request->getPost('_token');// view의 hidden 으로 넘어오는 값
      if (!$this->checkToken(self::SIGNUP, $token)){
   // 로그인을 필요로하는 페이지에서 토큰을 체크  true false 반환 ,  비정상접근 일 경우 false 인데
   // $this 앞에 !가 있어서  true로 바뀌고   아래쪽 redirect 실행.

        return $this->redirect('/' . self::SIGNUP);
      }
      //3>POST 전송방식으로 전달 받은 데이터를 변수에 저장
      $user_name = $this->_request->getPost('user_name');
      $password  = $this->_request->getPost('password');
      $password2  = $this->_request->getPost('password2');
      $nick = $this->_request->getPost('nick');
       $tel1 = $this->_request->getPost('tel1');
       $tel2 = $this->_request->getPost('tel2');
       $tel3 = $this->_request->getPost('tel3');
      $tel = $tel1."-".$tel2."-".$tel3;

        $email1 = $this->_request->getPost('email1');
        $email2 = $this->_request->getPost('email2');
      $email = $email1."@".$email2;

      // echo "--------- 어카운트 컨트롤러 -------------<br>";
      // echo "user_name : ";
      // var_dump($user_name);
      // echo "<br>";
      //
      // echo "password : ";
      // var_dump($password);
      // echo "<br>";
      //
      // echo "user_nick : ";
      // var_dump($nick);
      // echo "<br>";
      //
      // echo "user_tel : ";
      // var_dump($tel);
      // echo "<br>";
      //
      // echo "user_email : ";
      // var_dump($email);
      // echo "<br>";




      $errors = array();
      //4>사용자 ID체크
      //http://php.net/manual/kr/function.strlen.php
      //http://php.net/manual/kr/function.preg-match.php

      if (!strlen($user_name)) {
        $errors[] = '사용자ID가 입력되어 있지 않음';
      } else if (
        //^: 행의 선두를 표시
        //\w : 영문자 1개 문자를 의미
        //{n,m} : 직전의 문자가 n개 이상,m개 이하
        //$ : 행의 종단을 의미
        !preg_match('/^\w{3,20}$/',
        $user_name)
      ){
        $errors[] = '사용자 ID는 영문 3문자 이상 20자 이내로 입력하시오';
      }  else if($password != $password2){
        $errors[] = 'PW와 PW확인이 일치하지 않습니다.';
      }  else if (!$this->_connect_model
                       ->get('User')
                       ->isOverlapUserName($user_name)
                       //ConnectionModel 의 get()으로 UserModel 클래스 객체생성후 isOverlapUserName 호출
      ){
        $errors[] = '입력한 사용자 ID는 다른 사용자가 사용하고 있습니다.';
      }

      //5>사용자 패스워드 체크
      if (!strlen($password)) {
        $errors[] = '패스워드를 입력하지 않았음';
      } else if (8 > strlen($password)
                 || strlen($password) > 30
      ){
        $errors[] = '패스워드는 8문자 이상 30자 이내이어야 한다';
      }

      //6>계정 정보 등록
      if (count($errors) === 0) {//에러가 없는 경우 처리
        //UserModel클래스의  insert()로 사용자 계정 등록
        $this->_connect_model
             ->get('User')
             ->insert($user_name, $password, $nick, $tel, $email );

         // 아이디를 생성하면 장바구니테이블 자동생성
       $this->_connect_model
            ->get('product')
            ->createBasket($user_name);

        //  아이디를 생성하면 구매이력테이블 자동생성  createBuyList
        $this->_connect_model
             ->get('product')
             ->createBuyList($user_name);

             //세션ID재생성
        $this->_session
             ->setAuthenticateStaus(true);
              //새로 추가된 레코드를 얻어냄

        $user = $this->_connect_model
                     ->get('User')          // get('User') --> UserModel, get('Status') --> StatusModel...을 의미
                     ->getUserRecord($user_name);
                     //얻어온 레코드를 세션에 저장
        $this->_session->set('user', $user);
             //사용자 톱 페이지로 리다이렉트

        return $this->redirect('/');
      }
      //에러가 있는 경우 에러 정보와 함께 페이지 렌더링

      return $this->render(array(
          'user_name' => $user_name,
          'password'  => $password,
          'user_nick' => $nick,
          'user_tel'  => $tel,
          'user_email'=> $email,
          'errors'    => $errors,
          '_token'    => $this->getToken(self::SIGNUP),
      ), 'signup');

  } // registerAction의 끝나는 부분

  // 로그인
  public function signinAction() {
    // /views/account/signin.php
    if ($this->_session->isAuthenticated()) {
        return $this->redirect('/account');
        //session ID를 재생성 -> $_SESSION['_authenticated']=true -> $_SESSION에 계정 정보 저장
    }

    $signin_view = $this->render(array(
        'user_name' => '',
        'password'  => '',
        '_token'    => $this->getToken(self::SIGNIN),
    ));
    return $signin_view;
	}

  // 로그인 체크
  public function authenticateAction() {
     if (!$this->_request->isPost()) {
      $this->httpNotFound();
    }
   if ($this->_session->isAuthenticated()) {
      return $this->redirect('/account');
    }

    $token = $this->_request
                  ->getPost('_token');
    if (!$this->checkToken(self::SIGNIN, $token)){
      return $this->redirect('/' . self::SIGNIN);
    }

    $user_name = $this->_request ->getPost('user_name');
    $password  = $this->_request ->getPost('password');

    $errors = array();
    if (!strlen($user_name)) {
      $errors[] = '사용자 ID를 입력 해주세요';
    }

    if (!strlen($password)) {
      $errors[] = '패스워드를 입력해주세요';
    }

    if (count($errors) === 0) {
			$user = $this->_connect_model->get('User')  // get('User') --> UserModel.php 를 의미.
                                  // get('Following') --> FollowingModel.php,
                                  // BlogController의 get('Status') 는 StatusModel.php 를 의미
                   ->getUserRecord($user_name);

      if (!$user || (!password_verify($password, $user['password']))
   // password_hash() : _문자열을 암호화_    와
   // password_verify() : _암호화된 패스워드를 다시 정상으로_
   //                     는 쌍으로 사용한다.
			){
 	     	$errors[] = '로그인 실패';
      } else {
        $this->_session->setAuthenticateStaus(true);
        $this->_session->set('user', $user);

        // 로그인 후 바로 보여지는 경로
        $result = $this->redirect('/product/product');
      }

    }

    return $this->render(array(
        'user_name' => $user_name,
        'password'  => $password,
        'errors'    => $errors,
        '_token'    => $this->getToken(self::SIGNIN),
    ), 'signin');
  }

  // 로그아웃
	public function signoutAction(){
		$this->_session->clear();
		$this->_session->setAuthenticateStaus(false);
		return $this->redirect('/' . self::SIGNIN);
	}

  // 회원탈퇴하기
  public function deleteIdAction(){
    $user_number = $_SESSION['user']['id'];
    $user_name   = $_SESSION['user']['user_name'];
    $flag = $this->_connect_model->get('Product')->flagBasket($user_name);
    $this->_connect_model->get('User')->deleteId($user_number);

    // 회원 장바구니 존재여부 판단
    // if($flag['basket'] == "t"){
      // echo $flag['basket'];
      $this->_connect_model->get('Product')->deleteUserBasket($user_name);
      $this->_connect_model->get('Product')->deleteUserBuyList($user_name);
    // }

    session_destroy();
    echo "<script>alert('회원탈퇴 하였습니다.')</script>";
    echo "<script> location.replace('/index.php'); </script>";
  }


  // 팔로우 //
  public function followAction() {
    if (!$this->_request->isPost()) {
      $this->httpNotFound();
    }

    $follow_user_name = $this->_request->getPost('follow_user_name');
    if (!$follow_user_name){
      $this->httpNotFound();
    }

    $token = $this->_request->getPost('_token');

    if (!$this->checkToken(self::FOLLOW, $token)){
      return $this->redirect('/user/' . $follow_user_name);
    }

    $follow_user = $this->_connect_model->get('User')->getUserRecord($follow_user_name);
    if (!$follow_user) {
        $this->httpNotFound();
    }

    $user = $this->_session->get('user');

    $followTblConnection = $this->_connect_model->get('Following');

    if ($user['id'] !== $follow_user['id']
        && !$followTblConnection->isFollowedUser(
          $user['id'], $follow_user['id'])
    ){
      $followTblConnection
        ->registerFollowUser($user['id'],
                             $follow_user['id']);
    }

    return $this->redirect('/account');
  }
}
