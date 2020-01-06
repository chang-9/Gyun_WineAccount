<?
	header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩
	require_once '../dbconn.php';
	const PASSWORD_COST = ['cost'=>12];

	$conn = new DBC;
	$chgPass = password_hash($_POST['password2'], PASSWORD_DEFAULT, PASSWORD_COST);

	try{
		$conn->DBI();
		$query = "select * from Account_member where idx = '".$_SESSION['id']."'";
		$conn->DBQ($query);
		$conn->DBE();
		$row = $conn->DBF();
		$rowResult = $conn->resultRow();

		if($_POST['password1'] != $_POST['password2'])
		{
			if(!password_verify($_POST['password1'], $row['password']))
			{
				?>
				<script type="text/javascript">alert("현재 비밀번호가 일치하지 않습니다!");
				window.location.href="../../mypageP.php"</script>
				<?
			}
			else
			{
				if($_POST['password2'] == $_POST['password3'])
				{
					$sql = "update Account_member set password = '".$chgPass."' where idx = '".$_SESSION['id']."'";

					// $sql = "update Account_member set password = '".$chgPass."' , id = '".$_POST['id']."' , address = '".."' ,  where idx = '".$_SESSION['id']."'";
					// $sql = "update Account_entrepreneur set en_name ='".$_POST['']."'  where en_code = $row[0]";
					$conn->DBQ($sql);
					$conn->DBE();
					?>
					<script type="text/javascript">alert("비밀번호 변경이 완료되었습니다!");
					window.location.href="../../mypageP.php"</script>
					<?
				}
				else if($_POST['password2'] != $_POST['password3'])
				{
					?>
					<script type="text/javascript">alert("변경할 비밀번호가 일치하지 않습니다!")
					window.location.href="../../mypageP.php"</script>
					<?
				}
			}
		}
		else
		{
			?>
			<script type="text/javascript">alert("현재 비밀번호와 다른 비밀번호를 입력해주세요!");
			window.location.href="../../mypageP.php"</script>
			<?
		}

	} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
?>
