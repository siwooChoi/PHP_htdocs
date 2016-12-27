
<?php

 // function testFuntion($variable1, $variable2)/*가인수*/ {
 //   $inFunctionVar = $variable1 + $variable2;
 //
 //   return $inFunctionVar;
 // }
 //
 // $testValue1 = 20;
 // $testValue2 = 40;
 //
 // $result = testFuntion($testValue1, $testValue2); /*실인수*/
 //
 // echo $result."입니다. <br />";
 // echo "{$result}입니다. <br />";


 $testGlobalVar = 5;
 function testF_LocalVar(){
   global  $testGlobalVar;

   $Local_var1 = 10;
   $testGlobalVar = $Local_var1;
 }

 testF_LocalVar();
  printf("maji!?\n");
 echo "{$testGlobalVar}입니다. <br />";


 ?>














<!-- -->
