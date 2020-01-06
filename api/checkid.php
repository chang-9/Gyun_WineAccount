<meta http-equiv="content-type" content="text/html; charset=UTF-8"> <!--인코딩-->
<?
//회원가입
	include 'api/dbconn.php';
	include 'api/pageClass.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속


 
	$idch = $_POST['id'];
	 

	 
	$con->query = "SELECT * FROM Account_entrepreneur WHERE id='".$idch."'";
	$con->DBQ();
	$num = $con->result->num_rows; //객체지향 방법 
	$data = $con->result->fetch_row();


	if($idch == ''){
		?>
		<script>alert("아이디를 입력하지 않았습니다.");history.back();</script>
	 <?php
	}
					
	else{
		
		if($num == 0){
			?>
			<div style="color:green">
				<div>
					<?=$idch?>는 사용가능한 아이디입니다.
					<input type="button" value="사용하기" onclick="parent('<?=$idch?>','1')">
				</div>
			</div>
			<form action="checkid.php" method="POST">
				<div>다른 아이디를 검색하시려면 ▼</div>
				<div><input type="text" name="id" value="" placeholder="아이디를 입력해주세요.">
				<input type="submit" value="중복확인" onclick=""></div>
			</form>
		
		<?php
		}else{
		?>
		<div style="color:red">
			<div>
				<?=$idch?>와 같은아이디가 존재합니다.
			</div>
		</div>
		
		<form action="checkid.php" method="get">
			<div>다른 아이디를 검색하시려면 ▼</div>
			<div><input type="text" name="id" value="" placeholder="아이디를 입력해주세요.">
			<input type="submit" value="중복확인" onclick=""></div>
		</form>
		
		</div>
		<?php
		}
	}
	?>


	<script>
		function parent(id){
			var du = window.opener;
			
			opener.document.register_form.idDuplication.value ="idCheck";
				// 회원가입 화면의 ID입력란에 값을 전달
			du.id.value = id;
			if (opener != null) {
				opener.chkForm = null;
				self.close();
			} 
		}
	</script>


	


