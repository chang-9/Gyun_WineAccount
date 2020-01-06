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

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)

	try{
		$conn->DBI(); //DB 접속

		$query ="INSERT INTO Account_entrepreneur(en_code, en_name, id, password, en_com_name,
		                                          address, email, phone_num, en_call_num, en_fax_num, en_work_type, en_page, join_date)
		               VALUES(:en_code, :en_name, :id, :password, :en_com_name, :address, :email, :phone_num, :en_call_num, :en_fax_num, :en_work_type, :en_page, :join_date)";


		$conn->DBQ($query);


	  $conn->result->bindParam(':en_code', $en_code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':en_name', $en_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':id', $id); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':password', $password); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':en_com_name', $en_com_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':address', $address); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':email', $email); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':phone_num', $phone_num); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':en_call_num', $en_call_num); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':en_fax_num', $en_fax_num); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':en_work_type', $en_work_type); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':en_page', $en_page); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':join_date', $join_date); //바인드 변수로 들어갈 변수 지정
		// $conn->result->bindParam(':en_pic', $en_pic);

		// insert a row
		$en_code = $_POST['en_code'];
		$en_name = $_POST['en_name'];
		$id = $_POST['id'];
		$password = $hash;
		$en_com_name = $_POST['en_com_name'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$phone_num = $_POST['phone_num'];
		$en_call_num = $_POST['en_call_num'];
    $en_fax_num = $_POST['en_fax_num'];
		$en_work_type = $_POST['en_work_type'];
		$en_page = $_POST['en_page'];
		$join_date = date("Y-m-d H:i:s");
		// $en_pic = $_POST['en_pic'];





		$conn->DBE($query);


	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}

	$conn->DBO(); // db객체 해제 (종료)
	echo "<script>alert('가입 완료 되었습니다(승인이 완료될때 까지 기다려주세요).');location.href='../../';</script>";
?>
<?
/*
echo "{$_POST['id']}<br/>";

echo md5($_POST['pass1'])."<br/>";
echo password_hash($_POST['pass2'], PASSWORD_DEFAULT, PASSWORD_COST)."<br/>";

echo "{$_POST['name']}<br/>";
echo "{$_POST['email']}<br/>";
echo "{$_POST['phone']}<br/>";
echo "{$_POST['address']}<br/>";

echo "{$_POST['Cname']}<br/>";
echo "{$_POST['Cnum']}<br/>";
echo "{$_POST['Crepresent']}<br/>";
echo "{$_POST['Ctype']}<br/>";
echo "{$_POST['call']}<br/>";
echo "{$_POST['fax']}<br/>";

echo "{$_POST['Cpage']}<br/>";
echo "{$_POST['Cemail']}<br/>";
echo "{$_FILES['upfile']['name']}<br/>";
*/
?>
