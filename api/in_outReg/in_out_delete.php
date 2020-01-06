<?
	require_once '../dbconn.php';

	$conn = new DBC();

	if(isset($_POST['chk_info'])){
    $chk = $_POST['chk_info'];
  }

	try{
		$conn->DBI();
		$query = "SELECT * FROM wine_in_out where in_out_code = '".$chk[0]."'";
					$conn->DBQ($query);
					$conn->DBE();
					$res = $conn->DBF();

		if(isset($_POST['delete'])){
		  if(isset($_POST['chk_info'])){
			
				for($j=0; $j<count($chk); $j++)
				{
					$sql = "delete from in_out_detail where in_out_code = '".$chk[$j]."'";
					$conn->DBQ($sql);
					$conn->DBE();
				} 

				for($i=0; $i<count($chk); $i++)
				{
					$sql = "delete from wine_in_out where in_out_code = '".$chk[$i]."'";
					$conn->DBQ($sql);
					$conn->DBE();
					
				}
				
				switch ($res['in_out_cate']) {
					case "매입":
						?>
						<script type="text/javascript">alert("삭제되었습니다.");
						window.location.href="../../purchase.php"</script>
						<?

						break;
					case "매출":
						?>
						<script type="text/javascript">alert("삭제되었습니다.");
					window.location.href="../../sale.php"</script>
					<?
						break;
					}
			}else { ?>
			 <script>window.location.href="../../purchase.php"</script>
			   <?}
		  }else{
			  if(isset($chk)){
				  
				for($i=0; $i<count($chk); $i++)
				{
					$conn->DBI();
					$sql = "UPDATE wine_in_out SET in_out_state = '1' where in_out_code = '".$chk[$i]."'";
					$conn->DBQ($sql);
					$conn->DBE();
					
				}

				switch ($res['in_out_cate']) {
					case "매입":
						?>
						<script type="text/javascript">alert("종결되었습니다.");
						window.location.href="../../purchase.php"</script>
						<?

						break;
					case "매출":
						?>
						<script type="text/javascript">alert("종결되었습니다.");
					window.location.href="../../sale.php"</script>
					<?
						break;
					}
			  }else { ?>
			 <script>window.location.href="../../purchase.php"</script>
			   <?}

		  }
	}catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
?>
