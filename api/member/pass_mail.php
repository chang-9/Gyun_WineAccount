<?php
  header('Content-Type: text/html; charset=UTF-8');
  require_once '../dbconn.php';
  const PASSWORD_COST = ['cost'=>12]; // cost 의 기본 값은 10

  $conn = new DBC();

  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  $name = $_POST['per_name'];
  $id = $_POST['per_id'];

  $nameFrom = "WineAccount"; // 발신자
  $mailFrom = "WineAccount"; // 발신주소
  $mailTo = $_POST['email']; // 수신주소
  $subject = "WineAccount 비밀번호 안내입니다!"; // 제목
  $content = "임시 비밀번호를 안내해드리겠습니다. <br />\n<br />\n 귀하의 임시 비밀번호는 '".generateRandomString()."' 입니다!"; // 내용

  $chk = substr($content,101,10); // db에 담을 비밀번호
  $hash = password_hash($chk , PASSWORD_DEFAULT, PASSWORD_COST);

  try {
    $conn->DBI();

    $sql = "select * from Account_member where email = '".$mailTo."'";
    $conn->DBQ($sql);
    $conn->DBE();
    $res = $conn->resultRow();
    $row = $conn->DBF();

    if($res == 1)
    {
      $nameTo = $row['en_name'].' 고객님';

      $charset = "UTF-8";

      $nameFrom = "=?$charset?B?".base64_encode($nameFrom)."?=";
      $nameTo = "=?$charset?B?".base64_encode($nameTo)."?=";
      $subject = "=?$charset?B?".base64_encode($subject)."?=";
      $header = "Content-Type: text/html; charset=utf-8\r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Return-Path: <". $mailFrom .">\r\n";
      $header .= "From: ". $nameFrom ." <". $mailFrom .">\r\n";
      $header .= "Reply-To: <". $mailFrom .">\r\n";

      if($row['en_name'] == $name && $row['id'] == $id && $row['email'] == $mailTo )
      {
        $sql = "update Account_member set password = '".$hash."' where id = '".$id."'";
        $conn->DBQ($sql);
        $conn->DBE();

        // echo $password;

        mail($mailTo, $subject, $content, $header, $mailFrom);
        ?>
        <script type="text/javascript"> alert("임시비밀번호 발급이 완료되었습니다! \n 메일이 보이지 않을시 스팸메일함을 확인해주세요!")
        window.location.href="../../index.php"</script>
        <?
      }
      else {
        ?>
        <script type="text/javascript"> alert("일치하는 정보가 없습니다! 다시 입력해주세요.")
        window.location.href="../../index.php"</script>
        <?
      }
    }
    else if($res == 0)
    {
      ?>
      <script type="text/javascript"> alert("해당 이메일이 존재하지 않습니다!")
      window.location.href="../../index.php"</script>
      <?
    }

  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

?>
