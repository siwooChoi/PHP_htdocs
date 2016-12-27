
<?php

class LSB_A{
  public static function test(){
    print __CLASS__ .':안녕 PHP !<br>';
  }

  public function testAccess(){
    // self::test();    // 정적 지연 바인딩.
    static::test();
  }
}

 ?>
