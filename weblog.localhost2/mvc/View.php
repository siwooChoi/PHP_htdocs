<?php

class View{
    protected $_baseUrl; //view 파일의 폴더 경로 정보
    protected $_initialValue;

    // protected $p_rowCount;
    // public $example;

    // 컨트롤러 render()에서의 전달정보 (리퀘스트,리퀘스트의 Base URL, Session)
    protected $_passValues = array();// View에 전달할 정보

    //레이아웃 페이지에 제목으로 보낼 데이터 설정
    public function __construct($baseUrl,
                                $initialValue = array()){
        $this->_baseUrl = $baseUrl;
        $this->_initialValue = $initialValue;
        // $this->example = "example test!";

    }

    //뷰파일을 읽어 들이는 메서드
		//뷰파일명,뷰파일에전달하는정보(액션메서드로부터 전달받은),레이아웃 페이지
    public function setPageTitle($name, $value){
      $this->_passValues[$name] = $value;


    }

    // print $this->render('account/inputs',
    //                            array('user_name' => $user_name, 'password' => $password,)
    //                          );
    public function render($filename,  $parameters = array(),  $template = false){
      // 5> (BlogController.php에서의 설명 -> Controller.php에서의 render()의 설명에 이어서)
      //     statuses의 값들이 매개변수 $parameters를 통해 넘어오게 된다.
      // 6> (아래쪽의 extract()에 이어서)

      $view = $this->_baseUrl . '/' . $filename . '.php';



      // var_dump($filename);

      // echo "View클래스(객체)에서의 변수 filename의 값 : ";
      // var_dump($filename);    // 값 : template
      // echo "<br>";

      // echo "View클래스(객체)에서의 변수 parameters의 값 : ";
      // var_dump($parameters);
      // echo "<br>";

      // echo "View클래스(객체)에서의 변수 view의 값 : ";
      // var_dump($view);
      // echo "<br>";

      extract(array_merge($this->_initialValue,  $parameters));
      //6>  extract <-- php내장함수 _____ ※키값을 사용해서 변수화 시킴.
      // ex)            배열(리퀘스트 객체, 리퀘 url, 세션객체)  ,  배열 중 status 키값존재
      // $parameters 에서 들고온 status 키값을 변수로 만든다. ___ 'status' => '값들'
      // --->   $status = "값들";



      //뷰파일 디렉토리 경로+리퀘스트객체+세션객체,액션메서드로부터 받은 배열 정보
  		//http://php.net/manual/kr/function.array-merge.php
  		//array_merge($arr1,$arr2),$arr1과 $arr2를 병합하여 배열반환(같은 키는 $arr2 우선)
  		//http://php.net/manual/kr/function.ob-start.php
  		//출력버퍼링을 유효화(사용가능하게함)
  		//ob_implict_flush()
  		//자동출력의 여부를 결정(기본값은 TRUE or 1 - on, FALSE or 0 - off)
  		//ob_get_clean()
  		//현재 버퍼 내용을 반환하고 출력 버퍼를 삭제
      ob_start();

      ob_implicit_flush(0);

      
      require $view;


      $content = ob_get_clean();

      if ($template) {
        //레이아웃 파일명이 존재하면 실행
				//레이아웃 파일명, $parameters['title'],parameters[')content']되도록 배열머지

        $content = $this->render( $template,
                                  array_merge($this->_passValues, array('_content' => $content))
                          );


      }
      // $content = $content."aaaaaaaaaa";  // string(숫자) contents의 길이가 길어지면 숫자가 커진다.
      // var_dump($content);                // 숫자는 아마도 코드글자수 인듯하다

      return $content;
    }

//HTML Escape를 수행

    public function escape($string){
      //특수문자를 HTML 엔티티로 변경
			//ENT_QUOTES 설정되면 ':&#039;값'
        return htmlspecialchars($string,
                                ENT_QUOTES,
                                'UTF-8');
    }
}
