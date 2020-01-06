<?
	header('Content-Type: text/html; charset=UTF-8');
	require_once '../dbconn.php';
	require_once 'photoF.php';

	const PASSWORD_COST = ['cost'=>12]; // cost 의 기본 값은 10
	if($_POST['pass1'] == $_POST['pass2']){
		$hash = password_hash($_POST['pass1'] , PASSWORD_DEFAULT, PASSWORD_COST);
		//echo $hash;
	}else{
		echo "비빌번호 확인 재확인 바람";
	}

  $id = $_POST['id'];
  $password = $hash;
  $address = $_POST['address'];

	if(isset($_POST['email_c']))
	{
		if($_POST['email_c'] == "naver")
		{
			$email = $_POST['email_ins']. '@' .$_POST['email_c'];
		}
		else if($_POST['email_c'] == "gmail")
		{
			$email = $_POST['email_ins']. '@' .$_POST['email_c'];
		}
		else if($_POST['email_c'] == "gmail")
		{
			$email = $_POST['email_ins']. '@' .$_POST['email_c'];
		}
		else if($_POST['email_c'] == "hanmail")
		{
			$email = $_POST['email_ins']. '@' .$_POST['email_c'];
		}
		else if($_POST['email_c'] == "hotmail")
		{
			$email = $_POST['email_ins']. '@' .$_POST['email_c'];
		}
		else if($_POST['email_c'] == "yahoo")
		{
			$email = $_POST['email_ins']. '@' .$_POST['email_c'];
		}
	}
  $en_name = $_POST['en_name'];
  $phone_num = $_POST['phone_num'];

  $en_com_name = $_POST['en_com_name'];
  $en_code = $_POST['en_code'];
  $en_work_type = $_POST['en_work_type'];

  $en_call_num = $_POST['en_call_num'];
  $en_fax_num = $_POST['en_fax_num'];
  $en_home = $_POST['en_page'];

  $join_date = date("Y-m-d H:i:s");

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)

  try{
    $conn->DBI();

    $sql = "insert into Account_entrepreneur(en_code, en_com_name, address, en_work_type, en_call_num, en_fax_num, join_date, en_home)
    values('".$en_code."','".$en_com_name."','".$address."','".$en_work_type."','".$en_call_num."','".$en_fax_num."','".$join_date."','".$en_home."')";
    $conn->DBQ($sql);
    $conn->DBE();

    $sql = "insert into Account_member(en_code, id, password, en_name, email, phone_num)
    values('".$en_code."','".$id."','".$password."','".$en_name."','".$email."','".$phone_num."')";
    $conn->DBQ($sql);
    $conn->DBE();

    $sql = "select * from Account_entrepreneur where en_code = '".$en_code."'";
    $conn->DBQ($sql);
    $conn->DBE();
    $entre = $conn->DBF();

    $sql = "select * from Account_member where en_code = '".$en_code."'";
    $conn->DBQ($sql);
    $conn->DBE();
    $member = $conn->DBF();

    $sql = "insert into Account_relationship(entrepreneur_idx, member_idx, position, authority)
    values('".$entre['idx']."','".$member['idx']."','대표','10')";
    $conn->DBQ($sql);
    $conn->DBE();

    ?>
    <script>alert('가입 완료 되었습니다(승인이 완료될때 까지 기다려주세요).');location.href='../../index.php'</script>
    <?

  } catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}
?>
