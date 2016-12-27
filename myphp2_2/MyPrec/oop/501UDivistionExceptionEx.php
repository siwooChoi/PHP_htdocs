<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      class ZeroDivisionException extends Exception{
        // return "Code : ".$this->getCode() . "메시지: ". $this->getMessage();
    }

    class NumberFormatException extends Exception{

    }

    class Division {
      public static function divider($a, $b){
        if($b === 0){
          throw new ZeroDivisionException("0으로 못나눈다.");
        }

        if(!is_numeric($a) || !is_numeric($b)){
          throw new NumberFormatException("인수는 숫자로 입력해야 한다.");
        }

        return $a/$b;

      }
    }

    try{
      print Division::divider(1, 'abb') . "<br>";
    }catch(ZeroDivisionException $e){
      print $e->getMessage();
    } catch(NumberFormatException $e){
      print $e->getMessage();
    }

    ?>
  </body>
</html>
