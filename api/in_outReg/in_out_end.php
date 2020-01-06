<?
	require_once '../dbconn.php';

	$conn = new DBC();

	if(isset($_POST['chk_info'])){
    $chk = $_POST['chk_info'];
  }

	try{
		$conn->DBI();

		if(isset($chk))
		{
			
			for($i=0; $i<count($chk); $i++)
			{
				$sql = "UPDATE wine_in_out SET in_out_state = '1' where in_out_code = '".$chk[$i]."'";
				$conn->DBQ($sql);
				$conn->DBE();
			}

			?>
			<script type="text/javascript">alert("삭제 되었습니다!");
			window.location.href="../../purchase.php"</script>
			<?
		}
		else { ?>
     <script>window.location.href="../../purchase.php"</script>
   <? }

		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
?>
