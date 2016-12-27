<?php

  // http://php.net/manual/kr/function.serialize.php
  // http://php.net/manual/kr/function.unserialize.php

  $savefile = dirname(__FILE__)."/bbslog.txt";

  $mode = isset($_GET['mode']) ? $_GET['mode'] : "show";
  switch($mode){
    case "show" : show(); break;
    case "write" : write(); break;
    case "reset" : reseta(); break;
    default : show(); break;
  }

  function reseta() {
    save_data(array());
    $self = $_SERVER["SCRIPT_NAME"];
    echo "<a href = '$self' >게시판 초기화 완료</a>";
  }



  function show() {
    show_form();
    // 보드내용표시

    $log = load_data();
    echo "<ul>";
      foreach($log as $item) {
        $name = htmlspecialchars($item['namae']);
        $body = htmlspecialchars($item['body']);

        echo "<li>  <b style = 'color:red;'>$name</b> : $body  </li>";
      }

    echo "</ul>";
  }


  function load_data() {
    global $savefile;
    $log = array();
    if(file_exists($savefile)){   // 파일이 있는지 알아본다.
      $txt = file_get_contents($savefile);
      $log = unserialize($txt);

    }
    return $log;
  }

  function write() {
    if($_GET['namae'] == "" || $_GET['body'] == "") {
      echo "이름이나 본문이 비어있음, 다시 적어야됨";
      exit;
    }
    $log = load_data();
    array_unshift($log, $_GET);   // $_GET의 내용을 앞에다가 추가 하는것,  (연관배열)
    save_data($log);

    $self = $_SERVER['SCRIPT_NAME'];
    echo "<a href = '$self'>저장함</a>";

  }


  function save_data($savedata) {
    global $savefile;
    $txt = serialize($savedata);
    file_put_contents($savefile, $txt);
  }



  function show_form(){
    echo <<< FORM
      <form>
        ★이름 : <input type='text' name='namae' size='8' />
        본문 : <input type='text' name='body' size='22' />

        <input type='submit' value='쓰기' />
        <input type='hidden' name='mode' value='write' />

      </form>
      <form>
        <input type='submit' value='초기화' />
        <input type = 'hidden' name = 'mode' value='reset' />

      </form>

      <hr />

FORM;

  }

?>
