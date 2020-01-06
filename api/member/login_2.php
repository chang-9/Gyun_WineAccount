<?
  // 로그인
   header('Content-Type: text/html; charset=UTF-8');
   require_once '../dbconn.php';

     $conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)

      $conn->DBI();

      $sql = "select * from Account_member where id = '".$_POST['id']."'";
      $conn->DBQ($sql);
      $conn->DBE();
      $rescnt = $conn->resultRow();
      $row = $conn->DBF();

      $sql = "select * from Account_relationship where member_idx = '".$row['idx']."'";
      $conn->DBQ($sql);
      $conn->DBE();
      $reli = $conn->DBF();



      if($rescnt == 1)
      {
        if(!password_verify($_POST['pass'] , $row['password']))
        {
          ?>
          <script type="text/javascript">alert("비밀번호가 일치하지 않습니다!");
          window.location.href="../../index.php"</script>
          <?
        }
        else
        {
          $_SESSION["id"] = $reli["member_idx"];
          // 세션 추가시 이곳에 추가
          ?>
          <script type="text/javascript">
          window.location.href="../../dashBoard.php"</script>
          <?
        }
      }
      else if($rescnt == 0)
      {
        ?>
        <script type="text/javascript">alert("존재하지 않는 아이디이거나 승인이 진행중인 아이디 입니다.");
        window.location.href="../../index.php"</script>
        <?
      }

   $conn->DBO(); // db객체 해제 (종료)
?>
