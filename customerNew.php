<?
//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">');?>
<?$layout->head($head);?>

<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>고객 추가</h3>
				<div class="row mt">
					<div class="col-lg-12">
						<div class="form-panel">
							<form action="./api/customerReg/customerInsert.php" class="form-horizontal style-form" method="post">


								<!-- form-group 고객 -->
								<div class="form-group ">
									<div class="fa-hover col-md-2 col-sm-3">
									<label for=""> <font color="red">*고객명</font></label>
									</div>
									<div class="col-lg-10">
									<input class="form-control" id="cusname" type="text" name="cusname" pattern="^[ㄱ-ㅎ가-힣]*$" title="한글을 사용해주세요">

									</div>
										</div>


								<!-- form-group 번호 -->
					<div class="form-group">
                    <label for="phone" class="control-label col-lg-2"><font color="red">*휴대폰번호</font></label>
                    <div class="col-lg-10">
					  <div class="col-lg-4" style="padding-left:0px;padding-right:0px">
					  <select class="form-control" name="txtMobile1" id="phone" required>
						  <option value="">::선택::</option>
						  <option value="010">010</option>
						  <option value="011">011</option>
						  <option value="016">016</option>
						  <option value="017">017</option>
						  <option value="019">019</option>
					  </select>
					  </div>
					  <div class="col-lg-4" style="padding-left:0px;padding-right:0px">
					    <input class="form-control" name="txtMobile2" size="4" required
						pattern="^[0-9]*$" title="숫자를 입력해 주세요">
					  </div>
					  <div class="col-lg-4" style="padding-left:0px;padding-right:0px">
					    <input class="form-control" name="txtMobile3" size="4" required
						pattern="^[0-9]*$" title="숫자를 입력해 주세요">
					  </div>
                    </div>
				</div>

									<!-- form-group 나이 -->
									<div class="form-group">
											<label for="date" class="control-label col-lg-2"><font color="red"> 생년 월 일 </font></label>
											<div class="col-lg-10">
												<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-append date dpYears">
													<input type="text" id="datepicker" name="date_from" readonly="readonly" placeholder="현재 생년월일을 입력해주세요." value="" class="form-control" required="">
												</div>
											</div>
									</div>


										<!-- form-group 번호 -->
							<div class="form-group ">
								<div class="fa-hover col-md-2 col-sm-3">
									<a> 비고(특이사항) </a>
								</div>
								<div class="col-lg-10">
									<input class="form-control" id="bgo" type="text" name="bgo">
								</div>
							</div>


											<!-- form-group -->
							<div class="row" style="text-align:right">
								<div class="col-lg-12" style="">
									<button type="submit" class="btn btn-theme" id="saveButton">등록</button>
									<button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
								</div>
							</div>

					</form>


				<!-- row -->

      </section>

			<!-- <div class="row mt">
				<div class="col-lg-6" style="">
					<section>
						<table class="table table-bordered table-hover table-striped">
							<thead class="cf" style='background-color: #BDBDBD'>
								<tr>
									<th class="numeric">선택</th>
									<th class="numeric">제품번호</th>
									<th class="numeric">제품명</th>
								</tr>
							</thead>

							<tbody>
								<td data-title="선택">
										<input type="checkbox" id="chk_info[]" name="chk_info[]" value=""></input>
								</td>
								<th class="numeric" data-title="제품번호"></th>
								<th class="numeric" data-title="제품명"></th>
							</tbody>
						</table>
					</section>
				</div>
			</div> -->

    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
<?$layout->JsFile("
	<script type='text/javascript' src='lib/bootstrap-datepicker/js/bootstrap-datepicker.js'></script>

	<script>
		$( function () {
			jQuery( '#datepicker' ).datepicker();
		} );
		$( function() {
		 	jQuery( '#datepicker1' ).datepicker();
		} );
	</script>
  ");?>
  <?$layout->js($js);?>

</body>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
