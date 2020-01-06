<?
	require_once '../dbconn.php';

	if(isset($_GET['chk_info'])){
		$multiDelete = $_GET['chk_info'];
	}
	// print_r($multiDelete);

	$conn = new DBC();
	
	try{
		$conn->DBI();

		for($i=0; $i<count($multiDelete); $i++){
		$query = "DELETE FROM wine_customer WHERE idx=$multiDelete[$i]";
		$conn->DBQ($query);
		$conn->DBE(); //디비 실행한다
		}
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

	//$cnt = count($multiDelete);

	//DELETE FROM table WHERE idx  = 

	//$del_id = $checkbox[$i]; 
	//해당 변수로 수정
	
	//$sql = "DELETE FROM links WHERE link_id='$del_id'";
    //해당 SQL문으로 수정

	//$result = mysqli_query($sql);
	//해당 DB 접근문으로 수정 dbconn.php에 맞는 
?>
<script type="text/javascript">alert("삭제 되었습니다!");
window.location.href="../../customer.php"</script>