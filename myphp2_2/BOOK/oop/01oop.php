2004년 php5부터 객체지향 php 대응

 1. 클래스 정의 : 멤버를 가짐
class 클래스명 {
   $프로퍼티1;
      . . .
   $프로퍼티n;

   메서드1{실행처리...}
	  . . .
   메서드2{실행처리...}

   생성자 {
	  실행처리...
   }

   소멸자 {  // dbo = NULL;
	  실행처리...
   }

}


 2. 프로퍼티 정의
  엑세스수식자 $프로퍼티명;
 1> public :   클래스 내,외부 에서 접근(사용) 가능
 2> protected :  클래스 내, 자식(서브)클래스 에서 접근(사용)가능
 3> private : 클래스 내에서만 접근(사용)가능


 3. 메서드 정의
 엑세스수식자 function 메소드명(마라미터 리스트{
	실행처리 . . .
 }


 4. 