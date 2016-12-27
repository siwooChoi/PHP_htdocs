<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="../controlor/controlSupport.php?mode=upload_product2" method="post">
      상품 등록하기<br><br>
      상품명: <input type="text" name="p_name"><br>
      가격: <input type="text" name="p_price"><br>
      설명: <input type="text" name="p_comment"><br>

      종류 선택: <select style='width:150px' name="p_type">
        <option value="증류주">증 류 주</option>
        <option value="리큐르">리 큐 르</option>
        <option value="주스및기타">주스 및 기타</option>
      </select><br>
      수량: <input type="text" name="p_amount"><br>

      이미지파일명: <input type="text" name="p_imgname"><br>
      <br>
      <input type="submit" value="등록하기">
    </form>

    <form action="../index.php" method="post">
      <input type="submit" value="취소">
    </form>
  </body>
</html>
