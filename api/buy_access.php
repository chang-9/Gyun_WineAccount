<?

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속
  //   $sql = "SELECT SUBSTR(emp_auth,2,1) FROM Account_member WHERE idx ='".$_SESSION['id']."'";
  //   $conn->DBQ($sql);
	// $conn->DBE(); //쿼리 실행
	// $auth1 = $conn->DBF();
	//
	// if(isset($_SESSION['id'])){
	//
	// 	return true;
	//
	// }else{
	//
	// 	if($auth1['0'] =='1'){
	//
	// 	}else{?>
	 <!-- <script type="text/javascript">alert("접근 권한이 없습니다!")
	  window.location.href="./dashBoard.php"</script> -->
		<?//}
	//}

?>
