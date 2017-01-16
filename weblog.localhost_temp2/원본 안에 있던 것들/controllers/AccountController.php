<?php
class AccountController extends Controller{
  protected $_authentication = array('index','signout'); //login에 필요한 action정의
  const SIGNUP = 'account/signup';
  const SIGNIN = 'account/signin';
  const FOLLOW = 'account/follow';

  public function signupAction(){
    // echo "사인업액션 테스트";
    if($this->_session->isAuthenticated()){
      // 여기서는 $this->_session 이 보이지 않는다.
      // 이 $this가 가리키는 것은 상속받고 있는 'Controller'의 것이다.

      $this->redirect('/account');
    }
    $signup_view = $this->render(array(
      'user_name'=>'',
      'password'=>'',
      '_token' => $this->getToken(self::SIGNUP),
      //Controller클래스의 CSRF(Cross-site request forgery,사이트간 요청위조) 대책용 Token을생성
      //http://namu.wiki/w/CSRF
    ));

    return $signup_view;
  }
  public function registerAction(){//signup.php내의 form태그 action에서의 설정
    //1>POST 전송박식으로 전달 받은 데이터에 대한 체크
    if(!$this->_request->ispost()){
      $this->httpNotFound(); //FileNotFoundException 예외객체를 생성
    }
    if($this->_session->isAuthenticated()){
      $this->redirect('/account');
    }
    //2>CSRF대책의 Token 체크
    $token = $this->_request->getpost('_token');
    if(!$this->checkToken(self::SIGNUP, $token)){
      return $this->redirect('/'.self::SIGNUP);
    }
    //3>POST 전송방식으로 전달 받은 데이터를 변수에 저장
    $user_name = $this->_request->getpost('user-name');
    $password = $this->_request->getPost('password');

    $errors = array();
    //4>사용자 ID체크
    //http://php.net/manual/kr/function.strlen.php
    //http://php.net/manual/kr/function.preg-match.php
    if(!strlen($user_name)){
      $errors[]='사용자ID가 입력되어 있지 않음';

    }else if(!preg_match('/^\w{3,20}$/', $user_name)){
      //   정규표현식.
      //^: 행의 선두를 표시
      //\w : 영문자 1개 문자를 의미
      //{n,m} : 직전의 문자가 n개 이상,m개 이하
      //$ : 행의 종단을 의미
      $errors[] = '사용자 ID는 영문 3문자 이상 20자 이내로 입력하시오';
    }else if(!$this->_connect_model->get('User')->isOverlapUserName($user_name)){
        //ConnectionModel 의 get()으로 UserModel 클래스 객체생성후 isOverlapUserName 호출
        $errors[]='입력한 사용자 ID는 다른 사용자가 사용하고 있습니다.';
    }
    //5>사용자 패스워드 체크
    if(!strlen($password)){
      $errors[]='패스워드를 입력하지 않았음';
    }else if(8>strlen($password)||strlen($password)>30){
      $errors[] = '패스워드는 8문자 이상 30자 이내이어야 한다';
    }
    //6>계정 정보 등록
    if(count($errors)===0){ //에러가 없는 경우 처리
      //UserModel클래스의  insert()로 사용자 계정 등록
      $this->_connect_model->get('User')->insert($user_name,$password);
      //세션ID재생성
      $this->_session->setAuthenticateStaus(true);
      //새로 추가된 레코드를 얻어냄
      $user = $this->_connect_model->get('User')->getUserRecord($user_name);
      //얻어온 레코드를 세션에 저장
      $this->_session->set('user',$user);
      //사용자 톱 페이지로 리다이렉트
      return $this->redirect('/');
    }
    //에러가 있는 경우 에러 정보와 함께 페이지 렌더링
    return $this->render(array(
      'user_name' => $user_name,
      'password' => $password,
      'errors' => $errors,
      '_token' => $this->getToken(self::SIGNUP),
    ),'signup');
  }
  public function indexAction(){ // /views/account/index.php
    $user = $this->_session->get('user');
    $followingUsers = $this->_connect_model->get('user')->getFollowingUser($user['id']);

    $index_view = $this->render(array(
      'user' => $user,
      'followingUsers' => $followingUsers,
    ));
    return $index_view;
  }
  public function signinAction(){ // /views/account/signin.php
    if($this->_session->isAuthenticated()){
      return $this->redirect('/account');
    }
    $signin_view = $this->render(array(
      'user_name' => '',
      'password' => '',
      '_token' => $this->getToken(self::SIGNIN),
    ));
    return $signin_view;
    //session ID를 재생성 -> $_SESSION['_authenticated']=true -> $_SESSION에 계정 정보 저장

  }
  public function authenticateAction(){
    if(!$this->_request->isPost()){
      $this->httpNotFound();
    }
    if($this->_session->isAuthenticated()){
      return $this->redirect('/account');
    }
    $token = $this->_request->getPost('_token');
    if(!$this->checkToken(self::SIGNIN.$token)){
      return $this->redirect('/'.self::SIGNIN);
    }
    $user_name = $this->_request->getPost('user_name');
    $password = $this->_request->getPost('password');

    $errors = array();
    if(!strlen($user_name)){
      $errors[]='사용자 ID를 입력 해주세요';
    }
    if(!strlen($password)){
      $errors[] ='패스워드를 입력해주세요';
    }
    if(count($errors)===0){
      $user = $this->_connect_model->get('User')->getUserRecord($user_name);

      //http://php.net/manual/en/function.password-hash.php
      //http://php.net/manual/en/function.password-verify.php
      if(!$user || (!password_verify($password, $user['password']))){
    // password_hash() : _문자열을 암호화_ 와 password_verify() : _암호화된 패스워드를 다시 정상으로_는 쌍으로 사용한다.

        $errors[]='인증 에러임';
      }else{
        $this->_session->setAuthenticateStaus(true);
        $this->_session->set('user',$user);
        return $this->redirect('/');
      }
    }
    return $this->render(array(
      'user_name' => $user_name,
      'password' => $password,
      'errors' => $errors,
      '_token' => $this->getToken(self::SIGNIN),
    ),'signin');
}
    public function signoutAction(){
      $this->_session->clear();
      $this->_session->setAuthenticateStaus(false);
      return $this->redirect('/'.self::SIGNIN);
    }
    public function followAction(){
      if(!$this->_request->isPost()){
        $this->httpNotFound();
      }
      $follow_user_name = $this ->_request->getPost('follow_user_name');
      if(!$follow_user_name){
        $this->httpNotFound();
      }
      $token = $this ->_request->getPost('_token');

      if(!$this->checkToken(self::FOLLOW,$token)){
        return $this->redirect('/user/'.$follow_user_name);
      }
      $follow_user = $this->_connect_model->get('User')->getUserRecord($follow_user_name);
      if(!$follow_user){
        $this->httpNotFound();
      }
      $user = $this->_session->get('user');

      $followTblConnection = $this->_connect_model->get('Following');

      if($user['id'] !== $follow_user['id'] && !$followTblConnection->isFollowedUser($user['id'],
      $follow_user['id'])){
        $followTblConnection->registerFollowUser($user['id'],$follow_user['id']);
      }
      return $this->redirect('/account');
    }


}
 ?>
