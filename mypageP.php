<?
//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';
	include 'api/mypage_access.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속
	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">

<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">');?>
<?$layout->head($head);?>


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
                <div class="right-divider hidden-sm hidden-xs">
                  <h4>회사명</h4>
                  <h6>원준 회사 </h6>
                  <h4>??</h4>
                  <h6>거래처 개수 </h6>
                  <h4>$ </h4>
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

					<?
					$sql = "select substr(emp_auth, 1, 1) from wine_employee where emp_id = '".$_SESSION['emp_id']."'";
					$conn->DBQ($sql);
					$conn->DBE();
					$auth_1 = $conn->DBF();
					?>


					<?
					$sql = "select * from Account_entrepreneur where idx = '".$_SESSION['id']."'";
					$conn->DBQ($sql);
					$conn->DBE();
					$row = $conn->DBF();

					$sql=  "select * from Account_entrepreneur where en_code = '".$row['en_code']."'";
					$conn->DBQ($sql);
					$conn->DBE();
					$row2 = $conn->DBF();
					?>




			<div class="row mt">
					<form action="./api/basicReg/mypagefix.php" method="post" name="mypagef">

<!-------------------------------------------------------------------------------------------------------------------------------->
	<div class="row mt">
		<div class="col-lg-12">
			<div class="form-panel">
				<div class="cmxform form-horizontal style-form">

 					<div class="form-group">
						<label for="date" class="control-label col-lg-2"><font color="red">현재비밀번호</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="cmanager" type="password" name="password1" value="" placeholder="현재 비밀번호를 입력해주세요.">
					</div>
				</div>

				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">변경할 비밀번호</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="cmanager" type="password" placeholder="변경할 비밀번호를 입력해주세요." name="password2" value="" >
					</div>
				</div>

				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">변경할 비밀번호2</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="cmanager" type="password" placeholder="변경할 비밀번호를 다시 한번 입력해주세요." name="password3" value="" >
					</div>
				</div>

			</div>
		</div>
	</div>
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
