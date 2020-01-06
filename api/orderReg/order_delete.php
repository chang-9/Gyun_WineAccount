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
			for($j=0; $j<count($chk); $j++)
			{
				$sql = "delete from order_detail where order_code = '".$chk[$j]."'";
				$conn->DBQ($sql);
				$conn->DBE();
			}

			for($i=0; $i<count($chk); $i++)
			{
				$sql = "delete from wine_order where order_code = '".$chk[$i]."'";
				$conn->DBQ($sql);
				$conn->DBE();
			}

			switch ($order_cate) {
				case "주문":
					?>
					<script type="text/javascript">alert("삭제되었습니다.");
					window.location.href="../../order.php"</script>
					<?

					break;
				case "발주":
					?>
					<script type="text/javascript">alert("삭제되었습니다.");
				window.location.href="../../orderbook.php"</script>
				<?
					break;
			}
		}
		else { ?>
     <script>alert('선택한 항목이 없습니다.');history.back();</script>
   <? }

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
