<?php
class BlogController extends Controller{
  protected $_authentication = array('index','post'); //login필요한 action정의
  const POST = 'status/post';
  const FOLLOW = 'account/follow';

  public function indexAction(){
    //세션에 있는 사용자 정보를 얻어옴/
    $user = $this->_session->get('user');
    //status테이블에서 사용자 ID로 데이터를 조회해 옴(사용자의 글목록)
    $dat = $this->_connect_model->get('Status')->getUserData($user['id']);

    $index_view = $this->render(array(
      'statuses' => $dat, //글목록 정보
      'message' => '',  //글작성정이라 공백처리,form태그내 입력창의 입력된 내용
      '_token' => $this->getToken(self::POST),
    ));
    return $index_view;
  }
  public function postAction(){ //views/blog/index.php내의 form태그의 actionㅎ속성
    if(!$this->_request->isPost()){
      $this->httpNotFound();
    }
    $token = $this->_request->getPost('_token');
    if(!$this->checkToken(self::POST,$token)){
      return $this->redirect('/');
    }
    $message = $this->_request->getPost('message');

    $errors = array();

    //http://php.net/manual/kr/function.mb-strlen.php mb: multi-bytes
    if(!strlen($message)){
      $errors[]='글을 작성해주세요';
    }else if(mb_strlen($message)>200){
      $errors[]='작성글은 최대 200문자 까지 입니다.';
    }
    if(count($errors) === 0){ //에러가 없는경우
      $user = $this->_session->get('user'); //Session에서 사용자 데이터 획득
      $this->_connect_model->get('Status')->insert($user['id'],$message);
      //StatusModel 의 insert()호출하여 작성글데이터를 DB에 저장

      return $this->redirect('/');

    }

    //에러가 있는경우
    $user = $this ->_session->get('user');
    $dat = $this->_connect_model->get('Status')->getUserData($user['id']);//사용자의 글 목록 가져옴

    $result = $this ->render(array(
      'errors' => $errors,
      'message' => $message,
      'statuses' => $dat,
      '_token' => $this->getToken(self::POST),
    ),'index');
    return $result;

  }

  public function userAction($par){
    $user = $this->_connect_model->get('User')->getUserRecord($par['user_name']);
    if(!$user){
      $this->httpNotFound();
    }
    $dat = $this->_connect_model->get('Status')->getPostedMessage($user['id']);
    $state = null;

    if($this->_session->isAuthenticated()){
      $loginUser = $this ->_session->get('user');
      if($loginUser['id']!==$user['id']){
        $state  = $this->_connect_model->get('Following')->isFollowedUser($loginUser['id'],$user['id']);
      }
    }
    $user_view = $this->render(array(
      'user' => $user,
      'statuses' => $dat,
      'followstate' => $state,
      '_token' => $this->getToken(self::FOLLOW),
    ));
    return $user_view;
  }
  public function specificAction($par){
    $dat = $this->_connect_model->get('Status')->getSpecificMessage($par['id'],$par['user_name']);

    if(!$dat){
      $this->httpNotFound();
    }
    $specific_view = $this -> render(array('status'=>$dat));
    return $specific_view;
  }
}
 ?>
