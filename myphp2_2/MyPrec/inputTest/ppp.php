<?php
//
//
//   echo "<script>
//
//
//  echo "prompt('aaaa')";
//
//   // confirm
// //  $input = a;
// </script>";
//
//
// //  echo "$input";

  $value1 = $_POST['var1'];

  if($value1 > 0 && $value1 <= 10) {
    for($x = 1; $x <= $value1; $x++) {
      echo "ㄱ";

    }
  } else {
    for($x = 1; $x <= $value1; $x++) {
      if($x == 1){
        echo "1~10 입력하세요<br>";
        echo "<script> alert('1~10') </script>";
      }
      echo "ㄱ";
    }
  }

 ?>









<!-- -->
