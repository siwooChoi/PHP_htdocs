    <table>
      <tr>
        <th>사용자ID</th>
        <td>
          <input type="text" name="user_name" value="<?php echo $this->escape($user_name); ?>" />
                    <?php  // 여기의 $this->escape  는 View 와 관련이 있다.  특수문자를 html ntt로 바꾼다
                           // 스크립트 태그<>를 사용하여 해킹하는 것을 방지하기 위한 방법이다. ?>
        </td>
      </tr>
      <tr>
        <th>패스워드</th>
        <td>
          <input type="password" name="password" value="<?php echo $this->escape($password); ?>" />
        </td>
      </tr>
    </table>
