<?php
	require_once '../dbconn.php';
	header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩
	session_start();

	
	$Pass = $_POST['password'];
	$checkId = $_SESSION['id'];
	$checkPass = $Pass;

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속



	$sql = "select * from Account_member where id = '".$checkId."' AND password = '".$checkPass."'";
	$sql = "select * from Account_member where id = '".$checkId."'";

	$num = $sql->num_rows;
	echo $num;

	if($num==1){
		$sql ="delete from Account_member where id = '".$checkId."'";


	}


	try{
		$conn->DBQ($query); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)
	
	session_destroy();

	echo '<script>alert("탈퇴"); location.replace("../../");</script>';



	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}

	$conn->DBO(); // db객체 해제 (종료)
	echo $complete;


?>
