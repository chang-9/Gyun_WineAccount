<meta http-equiv="content-type" content="text/html; charset=UTF-8"> <!--인코딩-->
<?php
	session_start();
	require_once './dbconn.php';
	$con = new DBC();//객체 생성
	$con->DBI(); //db접속


	$id = $_POST['id'];
    $pass = md5($_POST['pass']);
	$nick = $_POST['nick'];
	$permit = $_POST['per'];
	$response = array();

	$con->query = "SELECT * FROM Account_member WHERE id='".$id."'AND password='".$pass."'";
	$con->DBQ();
	$num = $con->result->num_rows; //객체지향 방법 
	$data = $con->result->fetch_row();

	if($num==1){
	
		$_SESSION[id]=$id;	
		$_SESSION[nick]=$data[3];
		$_SESSION[email]=$data[4];
		$_SESSION[per]=$data[5];
		
		
			
		header("location: ../index.php");  // welcome.php 페이지로 넘깁니다.
	
	}else{
	echo '<script>alert("회원정보가 없습니다."); location.replace("../login.php");</script>';
	}
	
	




 
?>