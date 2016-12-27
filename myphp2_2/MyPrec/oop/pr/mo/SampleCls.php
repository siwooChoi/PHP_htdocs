<?php   // <?php 가 한칸이라도 개행되어 2line 부터 시작하더라도 에러. namespace 는 가장 위에 있어야 한다.

  namespace project\module;
  // 네임스페이스 관리를 위해 폴더구조로 작성

  class SampleCls{
    public function show(){
      print '이름공간 : ['.__NAMESPACE__.'] <br><br>'.__CLASS__;
      // __FILE__ , __CLASS__, __NAMESPACE__

    public function show2(){
      print 'show2의 function show2() 이다.';
    }

    }
  }

?>
