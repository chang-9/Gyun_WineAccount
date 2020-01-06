<?
//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';
	include 'api/mypage_access.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속
	$pNo = $_POST['pNo'];
    $query = "select * from Account_member where idx = '".$pNo."'";
	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">

<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">');?>
<?$layout->head($head);?>
<script>
	function Onname() {
		var pattern = /[^(ㄱ-힣a-zA-Z)]/;
		if(pattern.test(document.getElementById('name').value))
		{
			alert("한글 및 영문만 가능합니다.");
			document.getElementById('name').value = "";
			document.getElementById('name').foucs();
			return false;
		}
	}

	function Oncode() {
		var pattern = /[^0-9]/g;
		if(pattern.test(document.getElementById('en_code').value))
		{
			alert("숫자만 입력 가능합니다.");
			document.getElementById('en_code').value = "";
			document.getElementById('en_code').foucs();
			return false;
		}
	}

	function Onemail() {
		var pattern = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
		if(pattern.test(document.getElementById('email').value))
		{
			alert("이메일 형식에 맞게 입력해주세요! (ex. wwwww@domain.co.kr)");
			document.getElementById('email').value = "";
			document.getElementById('email').foucs();
			return false;
		}
	}

	function Onnumber() {
		var pattern = /[^0-9]/g;
		if(pattern.test(document.getElementById('phone').value))
		{
			alert("숫자만 입력 가능합니다.");
			document.getElementById('phone').value = "";
			document.getElementById('phone').foucs();
			return false;
		}
	}

	function Onfax() {
		var pattern = /[^0-9]/g;
		if(pattern.test(document.getElementById('fax').value))
		{
			alert("숫자만 입력 가능합니다.");
			document.getElementById('fax').value = "";
			document.getElementById('fax').foucs();
			return false;
		}
	}

	function Oncompany() {
		var pattern = /[^(ㄱ-힣a-zA-Z)]/;
		if(pattern.test(document.getElementById('company').value))
		{
			alert("한글 및 영문만 가능합니다.");
			document.getElementById('company').value = "";
			document.getElementById('company').foucs();
			return false;
		}
	}
</script>


<head>

<?
   session_start();
   if(!$_SESSION["id"]){
?>

<?
  }
?>

</head>



<body>

  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
      <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row mt">
          <div class="col-lg-12">
            <div class="row content-panel">
              <div class="col-md-4 profile-text mt mb centered">
								<?
								$sql = "select * from Account_member where idx = '".$_SESSION['id']."'";
								$conn->DBQ($sql);
								$conn->DBE();
								$row = $conn->DBF();

								$sql = "select * from Account_entrepreneur where en_code = '".$row['en_code']."'";
								$conn->DBQ($sql);
								$conn->DBE();
								$row2 = $conn->DBF();

								$sql = "select * from wine_company";
								$conn->DBQ($sql);
								$conn->DBE();
								$count = $conn->resultRow();
								?>
                <div class="right-divider hidden-sm hidden-xs">
                  <h4>회사명</h4>
                  <h6><?php echo $row2['en_com_name']; ?></h6>
                  <h4><?php echo $count; ?></h4>
                  <h6>거래처 개수 </h6>
                  <h4><?php echo number_format($de_sum); ?>￦ </h4>
                  <h6>이번달 수익</h6>
                </div>
              </div>
              <!-- /col-md-4 -->
              <div class="col-md-4 profile-text">
                <h3> My Page </h3>
                <h6>마이페이지</h6>
                <p></p>
                <br>
              </div>
              <!-- /col-md-4 -->
              <div class="col-md-4 centered">
                <div class="profile-pic">
                  <p><img src="img/ui-sam.jpg" class="img-circle"></p>
                  <p>

					<button class="btn btn-theme02" onclick="location.href='http://ccit2.dothome.co.kr/wineAccount/mypagef.php' " ><i class="" ></i> 회원정보수정</button>

					<button class="btn btn-theme02" onclick="location.href='http://ccit2.dothome.co.kr/wineAccount/mypageP.php' " ><i class="" ></i> 비밀번호수정</button>

                    <button class="btn btn-theme02" onclick="location.href='http://ccit2.dothome.co.kr/wineAccount/mypageD.php' " ><i class="" ></i> 회원탈퇴신청</button>
                  </p>
                </div>
              </div>
              <!-- /col-md-4 -->
            </div>
            <!-- /row -->
          </div>
          <!-- /col-lg-12 -->
				</div>




			<div class="row mt">
					<form action="./api/basicReg/mypageFF.php" method="post" name="mypagef">
					<input type="hidden"value="<?echo $row['idx'];?>"name="c_idx"></input>



							<div class="col-lg-6">
								<div class="form-panel">
									<div class="cmxform form-horizontal style-form">

										<div class="form-group">
											<label for="date" class="control-label col-lg-2"><font color="red">아이디</font></label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="id" name="id" readonly="readonly" value="<? echo $row['id']; ?>">
											</div>
										</div>

									<div class="form-group">
										<label for="date" class="control-label col-lg-2"><font color="red">성함</font></label>
										<div class="col-lg-10">
											<input class="form-control" id="name" type="text" name="name"  value="<?echo $row['en_name'];?>" required onchange="Onname()" title="한글, 영문만 입력가능합니다"  >
										</div>
									</div>

								<div class="form-group">
									<label for="date" class="control-label col-lg-2"><font color="red">사업자 번호</font></label>
									<div class="col-lg-10">
										<input class="form-control" id="en_code" type="text" name="en_code" required onchange="Oncode()" title="숫자만 입력가능합니다"  value="<?echo $row['en_code'];?>">
									</div>
								</div>

							<div class="form-group">
								<label for="date" class="control-label col-lg-2"><font color="red">이메일</font></label>
								<div class="col-lg-10">
									<input class="form-control" id="email" type="text" name="email" onchange="Onemail()" title="이메일 형식에 맞게 입력해주세요" value="<?echo $row['email'];?>">
								</div>
							</div>




<!-------------------------------------------------------------------------------------------------------------------------------------------------->
				</div>
				<!-- /cmxform form-horizontal style-form -->
			</div>
			<!-- /form-panel -->
		</div>
		<!-- /col-lg-6 -->
<!-------------------------------------------------------------------------------------------------------------------------------------------------->


		<div class="col-lg-6">
			<div class="form-panel">
				<div class="cmxform form-horizontal style-form">

				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">회사명</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="company" required onchange="Oncompany()" title="한글만 사용해주세요"  type="text" name="company"  value="<?echo $row2['en_com_name'];?>" >
					</div>
				</div>


				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">회사 주소</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="cmanager" type="text" name="address"  value="<?echo $row2['address'];?>" >
					</div>
				</div>

				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">팩스번호</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="fax" type="text" name="fax" required onchange="Onfax()" title="숫자를 입력해 주세요"  value="<?echo $row2['en_fax_num'];?>">
					</div>
				</div>

				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">회사전화</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="phone" type="text" name="phone" required onchange="Onnumber()" title="숫자를 입력해 주세요"  value="<?echo $row2['en_call_num'];?>" >
					</div>
				</div>


				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">업태</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="work" type="text" name="work" value="<?echo $row2['en_work_type'];?>" >
					</div>
				</div>




			</div>
			</div>
		</div>
		<!-- /col-lg-6 -->
</div>


		<div class="row mt" style="text-align:right">
			<div class="col-lg-12">
				<button type="submit" class="btn btn-primary submit mb-1">수정</button>
			</div>
		</div>


		</form>



	<!-- /col-lg-12 -->



      <!-- /wrapper -->
    </section>



    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
<?//$layout->JsFile();?>
  <?$layout->js($js);?>

</body>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
