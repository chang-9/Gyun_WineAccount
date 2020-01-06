<?
	require_once './dbconn.php';

	$conn = new DBC();

	if(isset($_POST['encode'])){
    $code = $_POST['encode'];
   }
   if(isset($_POST['compare'])){
    $compare = $_POST['compare'];
   }

	try{
		$conn->DBI();

		switch ($compare) {
					case "대기중":
						for($i=0; $i<count($code); $i++){
							$sql = "UPDATE Account_entrepreneur SET permission = '1' where en_code = '".$code[$i]."'";
							$conn->DBQ($sql);
							$conn->DBE();
					}

						?>
						<script type="text/javascript">alert(<?print_r($code);?>);
						window.location.href="../dashboard_admin.php"</script>
						<?

						break;
					case "거부":
						for($i=0; $i<count($code); $i++){
							$sql = "UPDATE Account_entrepreneur SET permission = '0' where en_code = '".$code[$i]."'";
							$conn->DBQ($sql);
							$conn->DBE();
					}
						?>
						<script type="text/javascript">alert("거부되었습니다.");
					window.location.href="../dashboard_admin.php"</script>
					<?
						break;
					}
		
	}catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
?>
