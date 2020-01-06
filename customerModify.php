<?
//재고 수불부
	include 'layout/layout.php';
	include 'api/dbconn.php';



	$layout = new Layout;

	// <script>
	// function chkValue()	{
	// 	var nick = document.write_form.v_name.value.replace(/\s|　/gi, '');
	// 	var phone = document.write_form.v_phone.value.replace(/\s|　/gi, '');
	// 	var age = document.write_form.v_age.value.replace(/\s|　/gi, '');
	//
	// 	if(nick == ''){
	// 		alert('이름을 입력해주세요');
	// 		document.v_name.focus();
	// 		return false;
	// 	}
	// 	else if(phone == ''){
	// 		alert('휴대폰번호를 입력해주세요');
	// 		document.v_phone.focus();
	// 		return false;
	// 	}
	// 	else if(age == ''){
	// 		alert('나이를 입력해주세요');
	// 		document.v_age.focus();
	// 		return false;
	// 	}
	// 	else {
	// 		document.write_form.submit();
	// 	}
	// }
	// </script>

?>

<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">
');?>
<?$layout->head($head);?>

<body>


  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->

    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
			      <?
				      $conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
				      $conn->DBI(); //DB 접속

				      $pNo = $_GET['pNo'];
				      $query = "select * from wine_customer where idx = '".$pNo."'";
				      $conn->DBQ($query);
				      $conn->DBE();
							$row = $conn->DBF();
			      ?>

		        <h3><i class="fa fa-angle-right"></i>고객 정보 수정</h3>
						<div class="row mt">
							<div class="col-lg-12">
								<div class="form-panel">
									<form action="./api/customerReg/customerModifyOk.php" class="form-horizontal style-form" method="post">

										<input type="hidden" value="<? echo $row['idx'];?>" name="c_idx"></input>
										<!-- form-group 고객 -->
										<div class="form-group ">
											<div class="fa-hover col-md-2 col-sm-3">
											<a> 고객 명 </a>
											</div>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="c_name" required
												pattern="^[ㄱ-ㅎ가-힣]*$" <? echo $row['cust_name']; ?>"></input>
											</div>
												</div>
										<!-- form-group 번호 -->
										<div class="form-group ">
											<div class="fa-hover col-md-2 col-sm-3">
											<a> 휴대폰 번호 </a>
											</div>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="c_phone" required
												pattern="^[0-9]*$" title="숫자를 입력해 주세요" value="<? echo $row['phone_num']; ?>"></input>
											</div>
												</div>
											<!-- form-group 나이 -->
											<div class="form-group ">
												<div class="fa-hover col-md-2 col-sm-3">
												<a> 나이 </a>
												</div>
												<div class="col-lg-10">
													<input type="text" class="form-control" id="c_age"  required
													pattern="^[0-9]*$" title="숫자를 입력해 주세요" value="<? echo $row['cust_age']; ?>"></input>
												</div>
													</div>
												<!-- form-group 번호 -->

										<div class="row" style="text-align:right">
										  <div class="col-lg-12" style="">
											<button type="submit" class="btn btn-theme" id="saveButton" onclick="chkValue()">저장</button>
											</div>
										</div>
									</form>
								</div>
								<!-- form-panel -->
							</div>
							<!-- col-lg-12 -->
						</div>
						<!-- form-panel -->
					<!-- col-lg-12 -->
				<!-- row -->
      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <?$layout->js($js);?>
</body>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
