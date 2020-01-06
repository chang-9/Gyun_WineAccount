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

		$query ="INSERT INTO wine_member(id,password,mail,address,b_code,b_name,call_num,phone,
		                                 reg_pic,name,work_type,fax,page,b_represent,b_email) 
						VALUES(:id,:pass,:mail,:addr,:b_c,:b_n,:call,:phone,:pic,:name,:type,:fax,:page,:rep,:c_m)";
		$conn->DBQ($query);

		$conn->result->bindParam(':id', $id); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':pass', $pass); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':mail', $mail); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':addr', $addr); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':b_c', $b_c); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':b_n', $b_n); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':call', $call); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':phone', $phone); //바인드 변수로 들어갈 변수 지정
		//$conn->result->bindParam(':pic', $pic); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':name', $name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':type', $type); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':fax', $fax); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':page', $page); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':rep', $rep); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':c_m', $c_m); //바인드 변수로 들어갈 변수 지정

		if(isset($_FILES["upfile"]["name"]) && $_FILES["upfile"]["name"] != null){
			$conn->result->bindParam(':pic', $pic); //바인드 변수로 들어갈 변수 지정 (수정인데 사진이 필요 없는 경우)
			$pic = photo('./reg_pic/','reg_pic');
        }

		// insert a row
		$id = $_POST['id'];
		$pass = $hash;
        $mail = $_POST['email'];
		$addr = $_POST['address'];
		$b_c = $_POST['Cnum'];
		$b_n = $_POST['Cname'];
		$call = $_POST['call'];
		$phone = $_POST['phone'];
		//$pic = ;
		$name = $_POST['name'];
		$type = $_POST['Ctype'];
        $fax = $_POST['fax'];
		$page = $_POST['Cpage'];
		$rep = $_POST['Crepresent'];
        $c_m = $_POST['Cemail'];		



		$conn->DBE();
		
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