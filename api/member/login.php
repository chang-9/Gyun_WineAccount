<?
	header('Content-Type: text/html; charset=UTF-8');
	require_once '../dbconn.php';


    if(isset($_POST['emp'])){
			echo "<script>alert('직원 로그인 개발중입니다.');location.href='../../';</script>";
	}
	
	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)

	try{
		$conn->DBI(); //DB 접속

		$query ="select * from wine_member where id = '{$_POST['id']}' and permit = 1"; //변수에 쿼리 저장

		$conn->DBQ($query); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)
		$conn->DBE(); //쿼리 실행

		//조회된 row결과의 개수나 수정된 row결과의 개수를 출력
		$rowcnt = $conn->resultRow(); 

        //쿼리 결과 가져와서 비밀번호 체크
		if($rowcnt == 1){
			$row = $conn->DBF(); 

			if(!password_verify($_POST['pass'] , $row['password'])){
				$page = "<script>alert('비밀번호가 틀립니다.');location.href='../../';</script>";
				//throw new Exception('비밀번호가 일치하지 않습니다.');
			}else{
				$page = "<script>location.href='../../dashBoard.php';</script>";
			}

		}else{
			$page = "<script>alert('존재하지 않는 아이디이거나 승인 진행중인 아이디 입니다.');location.href='../../';</script>";
		}
		
	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}

	$conn->DBO(); // db객체 해제 (종료)
	echo $page;
?>
<?
/*
if($_POST['id'] == 1 && $_POST['pass'] == 1){
	echo '<script>location.href="../../dashBoard.php";</script>';
}else if(isset($_POST['emp'])){
	$emp = $_POST['emp'];
	echo "emp is dev ~ing({$emp})";
	//echo '<script>alert("emp is dev ~ing({$emp})");history.back();;</script>';
}else{
	echo '<script>alert("This is incorrect information");history.back();;</script>';
}
*/
?>