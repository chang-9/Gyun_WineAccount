<?
//입금 추가
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	//불러오기
	if(isset($_GET['aNo']))
	{
		$aNo = $_GET['aNo'];

		$query = "select * from wine_in_out where idx = '".$_GET['aNo']."'";
		$conn->DBQ($query);
		$conn->DBE();
		$in_out= $conn->DBF(); // wine_in_out

		$query = "select * from in_out_detail where in_out_code = '".$in_out['in_out_code']."'";
		$conn->DBQ($query);
		$conn->DBE();
		$rescnt = $conn->resultRow();
		for($i=0; $i<$rescnt; $i++)
		{
			$board[$i] = $conn->DBF();
		}

		$sumArr = array();
		for($a=0; $a<$rescnt; $a++)
		{
			$sumArr[$a] = $board[$a]['all_price'];

			$sum += preg_replace("/[^\d]/","",$sumArr[$a]);
		}
	}
	$sum2 = $sum - $board['de_sp_price'];

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">');?>
<?$layout->head($head);?>
<style>
	#bo_line {
	 width:100%;
	 height:2px;
	 background: gray;
	 margin-top:20px;
	 margin-bottom: 20px;
	}
</style>

<script>
	function getNumber(obj) {

			 var num01;
			 var num02;
			 num01 = obj.value;
			 num02 = num01.replace(/\D/g,""); //숫자가 아닌것을 제거,
																				//즉 [0-9]를 제외한 문자 제거; /[^0-9]/g 와 같은 표현
			 num01 = setComma(num02); //콤마 찍기
			 obj.value =  num01;
	}

	function setComma(n) {
			 var reg = /(^[+-]?\d+)(\d{3})/;   // 정규식
			 n += '';                          // 숫자를 문자열로 변환
			 while (reg.test(n)) {
					n = n.replace(reg, '$1' + ',' + '$2');
			 }
			 return n;
	}
		function comma(str) {
		str = String(str);
		return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
	}

	function uncomma(str){
		str = String(str);
		return str.replace(/[^\d]+/g, '');
	}

	function call()
	{
		var total_price = uncomma(document.getElementById('total_price').innerHTML);

		document.getElementById('reMoney').innerHTML = total_price - document.getElementById('input_money').value;
		document.getElementById('remain_money').value = total_price - document.getElementById('input_money').value;

		if(document.getElementById('remain_money').value < 0)
		{
			document.getElementById('cant').value = 0;
			document.getElementById('reMoney').innerHTML = '-' + comma(uncomma(document.getElementById('reMoney').innerHTML)) + ' ' + '₩';
			document.getElementById('remain_money').value = '-' + comma(uncomma(document.getElementById('remain_money').value)) + ' ' + '₩';
		}
		else if(document.getElementById('remain_money').value >= 0)
		{
			document.getElementById('cant').value = 1;
			document.getElementById('reMoney').innerHTML = comma(uncomma(document.getElementById('reMoney').innerHTML)) + ' ' + '₩';
			document.getElementById('remain_money').value = comma(uncomma(document.getElementById('remain_money').value)) + ' ' + '₩';
		}
	}
</script>

<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
        <h3><a href="depositNew2.php?aNo=<?echo $aNo?>"><i class="fa fa-angle-right"></i> 입금 추가</a></h3>
					<form action="./api/despReg/Insert.php" class="form-horizontal style-form" id="insert_form" name="insert_form" method="post">
						<input type="hidden" name="compare" value="11">
						<input type="hidden" name="in_out_code" value="<?php echo $in_out['in_out_code']; ?>">

					<!-- 매출서 정보 -->
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-6">
                <div class="form-panel">
                  <div class="cmxform form-horizontal style-form">
                    <!-- 일자 -->
                    <div class="form-group">
                      <label for="date" class="control-label col-lg-2">일자</label>
                      <div class="col-lg-10">
                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-append date dpYears">
													<?$cur_date = date('Y/m/d');?>
                          <input type="text" readonly="readonly" placeholder="금액이 입금되는 날짜를 선택해주세요." value="<?echo $in_out['input_date'];?>" class="form-control" required="">
                        </div>
                      </div>
                  </div>

                    <!-- 담당자 -->
                    <div class="form-group">
                      <label for="date" class="control-label col-lg-2">담당자</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cmanager" type="text" readonly="" value="<?echo $in_out['m_name']?>" required="">
                      </div>
                  </div>

                    <!-- 거래처 -->
                    <div class="form-group">
                      <div class="fa-hover col-md-2 col-sm-3">
                        <a href="" data-toggle="modal" data-target="#myModal_com"><i class="fa fa-search" name= "com_name"></i> 거래처 </a>
                    </div>


                    <div class="col-lg-10">
                      <input class="form-control" id="ccompany" name="company" type="text" value="<?echo $in_out['com_name']?>" readonly="" required="">
                    </div>
                  </div>

              </div>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-6 -->

          <div class="col-lg-6">
            <div class="form-panel">
              <div class="cmxform form-horizontal style-form">

                <!-- 창고 -->
                <div class="form-group">
                  <div class="fa-hover col-md-2 col-sm-3">
                    <a href="#" data-toggle="modal" data-target="#myModal_deposit"><i class="fa fa-search" name= "deposit_name"></i> 출하창고 </a>

                </div>

                <div class="col-lg-10">
                  <input class="form-control" id="cwarehouse" name="warehouse" type="text" readonly="" value="<?echo $in_out['ware_code']?>" required="">
                </div>
              </div>

              <!-- 매장명 -->
              <div class="form-group">
                <label for="date" class="control-label col-lg-2"> 매장명 </label>
                <div class="col-lg-10">
                  <input class="form-control" id="cwarehouse" name="store" type="text" readonly="" value="<?echo $in_out['store_name']?>" required="">
                </div>
            </div>

            <!-- 비고 -->
            <div class="form-group">
              <label for="comment" class="control-label col-lg-2">비고</label>
              <div class="col-lg-10">
                <input class="form-control" id="cwarehouse" readonly="" value="<?echo $in_out['memo']?>" type="text">
              </div>
            </div>

              </div>
            </div>
          </div>
          <!-- /col-lg-6 -->
				</div>
				<!-- /col-lg-12 -->
			</div>
			<!-- /row -->

			<div class="row">
				<div class="col-lg-12">
					<section id="no-more-tables">
					<table class="table table-bordered table-hover table-striped" id="order_table">
						<thead class="cf" style="background-color: #BDBDBD;" >
							<tr>
								<th class="numeric">상품코드</th>
								<th class="numeric">상품명</th>
								<th class="numeric">공급가</th>
								<th class="numeric">수량</th>
								<th class="numeric">부가세</th>
								<th class="numeric">할인</th>
								<th class="numeric">총 가격</th>
							</tr>
						</thead>

						<tbody id="tbody">
							<?
							$sql = "select * from in_out_detail where in_out_code = '".$in_out['in_out_code']."' order by idx";
							$conn->DBQ($sql);
							$conn->DBE();

							$resCnt = $conn->resultRow();

							$i=0;
							while($res = $conn->DBF()) {
							?>
							<tr id="myTr[<?php echo $i; ?>]">
								<td data-title="상품코드">
									<div class="input-group">
										<input type="text" class="form-control" id="product_code[<?php echo $i; ?>]" name="product_code[]" readonly="" required="" <?echo 'value='.$res['product_code'];?>>
									</div>
								</td>

								<td data-title="상품명">
									<div class="input-group">
										<input type="text" class="form-control" id="product_name[<?php echo $i; ?>]" name="product_name[]" readonly="" required="" <?echo 'value='.$res['product_name'];?>>
									</div>
								</td>

								<td data-title="공급가"><input type="text" class="form-control" id="sup_price[<?php echo $i; ?>]" readonly="" name="sup_price[]" onchange="call()" required="" <?echo 'value='.$res['sup_price'];?>></td>
								<td data-title="수량"><input type="text" class="form-control" id="in_out_cnt[<?php echo $i; ?>]" readonly="" name="in_out_cnt[]" onchange="call()" required="" <?echo 'value='.$res['in_out_cnt'];?>></td>
								<td data-title="부가세">
									<select class="form-control" id="surtax[<?php echo $i; ?>]" onchange="call()" readonly="" value="" name="surtax[]" style="font-size:13px;">
										<?
											if($res['surtax'] == 1){
												?>
												<option id="apply[0]" selected="" value="1">부가세 적용</option>
												<option id="apply[0]" value="2">부가세 미적용</option>
												<?
											} else if ($res['surtax'] == 2) {
												?>
												<option id="apply[0]" value="1">부가세 적용</option>
												<option id="no_apply[0]" selected="" value="2">부가세 미적용</option>
												<?
											}
										?>
									</select>
								</td>
								<td data-title="할인"><input type="text" class="form-control" id="sale[<?php echo $i; ?>]" name="sale[]" readonly="" value="0" onchange="call()" required="" <?echo 'value='.$res['sale'];?>></td>
								<td data-title="총 가격"><input type="text" class="form-control" id="all_price[<?php echo $i; ?>]"  name="all_price[]" readonly="readonly" required="" <?echo 'value='.$res['all_price'];?>></td>
							</tr>
						<?php $i++;} ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="6" style="text-align:right">합계 금액</td>
								<td><input type="text" class="form-control" readonly="" value="<?php echo number_format($sum); ?>"></td>
							</tr>
						</tfoot>
					</table>
				</section>
				</div>
				<!-- /col-lg-12 -->
			</div>
			<!-- /row-->

			<div id="bo_line"></div>

			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-9">
						<div class="form-panel">
							<div class="cmxform form-horizontal style-form">
								<!-- 일자 -->
								<div class="form-group">
									<label for="date" class="control-label col-lg-2">일자</label>
									<div class="col-lg-10">
										<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-append date dpYears">
											<?$cur_date = date('Y/m/d');?>
											<input type="text" id="datepicker" name="date_from" readonly="readonly" placeholder="금액이 입금되는 날짜를 선택해주세요." value="<?echo $cur_date;?>" class="form-control" required="">
										</div>
									</div>
							</div>

							<!-- 담당자 -->
							<div class="form-group">
								<div class="control-label col-lg-2">
									<a href="#"  data-toggle="modal" data-target="#myModal_mname"><i class="fa fa-search" name= "mname"></i>담당자</a>
								</div>
								<div class="col-lg-10">
									<input class="form-control" id="cmanager" type="text" name="manager" value="" placeholder="" required="">
								</div>
							</div>

							<!-- 비고 -->
							<div class="form-group">
								<label for="comment" class="control-label col-lg-2">비고</label>
								<div class="col-lg-10">
									<input class="form-control" id="cwarehouse" placeholder="" name="memo" value="" type="text">
								</div>
							</div>

					</div>
				</div>
				<!-- /form-panel -->
				</div>
				<!-- /col-lg-6 -->

					<div class="col-lg-3">
						<br><br><br><br><br>
						<div class="well well-small green">
							<div class="pull-left"> 총 금액 </div>
							<div class="pull-right" id="total_price"> <?echo number_format($sum2);?> ₩ </div>
							<div class="clearfix"></div>
						</div>
						<input type="hidden" name="total_price" value="<?echo number_format($sum2);?>">
						<input type="number" style="text-align: right;" class="form-control" id="input_money" name="input_money" value="" placeholder="입금될 금액을 입력하세요. . ." autocomplete="off" onkeyup="call()">
						<input type="hidden" name="remain_money" id="remain_money" value="">
						<div class="well well-small green">
							<div class="pull-left"> 남은 금액 </div>
							<div class="pull-right" id="reMoney"></div>
							<div class="clearfix"></div>
						</div>
					</div>
					<!-- /col-lg-3 -->

				</div>
				<!-- col-lg-12 -->
			</div>
			<!-- /row -->



						<div class="row mt" style="text-align:right;">
							<div class="col-lg-12">
								<input type="hidden" id="cant" value="1">
								<a href="#" data-toggle="modal" data-target="#Modal_sale"><button class="btn btn-theme02" type="button">매출서 불러오기</button></a>
								<button class="btn btn-theme" id="sub" type="submit">등록</button>
								<button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
							</div>
						</div>
				</form>

	    </section>
		</section>

		<!-- pop-up -->
		<div class="modal fade" id="Modal_sale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">매출서를 선택해주세요.</h4>
					</div>

					<div class="modal-body">
						<div class="row mt">
							<div class="col-lg-12">
									<section id="no-more-tables">
										<table class="table table-bordered table-hover table-striped">
											<thead class="cf" style="background-color: #E6E6E6;">
												<tr>
													<th class="numeric"></th>
													<th class="numeric">매출코드</th>
													<th class="numeric">거래처명</th>
													<th class="numeric">담당자명</th>
													<th class="numeric">일자</th>
													<th class="numeric">비고</th>
												</tr>
											</thead>

											<?
											$sql = "select * from wine_in_out where in_out_cate = '매출' and de_sp_price = '0'";
											$conn->DBQ($sql);
											$conn->DBE();

											while($row2 = $conn->DBF()) {
											?>
											<tbody>
												<tr>
													<td data-title="선택"><a href="depositNew2.php?aNo=<?echo $row2['idx'];?>"><button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></button></a></td>
													<td data-title="매출코드"><?echo $row2['in_out_code'];?></td>
													<td data-title="거래처명"><?echo $row2['com_name'];?></td>
													<td data-title="담당자명"><?echo $row2['m_name'];?></td>
													<td data-title="일자"><?echo $row2['input_date'];?></td>
													<td data-title="비고"><?echo $row2['memo'];?></td>
												</tr>
											<? } ?>
											</tbody>
										</table>
									</section>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /pop-up -->

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

	<script>
	$("#sub").click(function() {
		if(document.getElementById('cant').value == 0)
		{
			alert("입금액이 총 금액보다 많습니다.")
			return false;
		}
		else if(document.getElementById('cant').value == 1)
		{
			return true;
		}
	});
	</script>

	<!--담당자 팝업시작-->
		<div class="modal fade" id="myModal_mname" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_com" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">담당자를 입력하세요</h4>
					</div>

					<div class="modal-body">
						<div class="row mt">
							<div class="col-lg-12">
								<div class="input-group">
									<div class="input-group-btn search-panel">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
											<span id="search_concept">검색필터</span> <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#emp_name">사원명</a></li>
											<li><a href="#emp_dept">부서명</a></li>
											<li><a href="#emp_job">직급명</a></li>
										</ul>
									</div>

									<input type="hidden" name="search_m" value="emp_name" id="search_m">
									<input type="text" class="form-control" id="search_n" placeholder="검색어를 입력하세요. . .">
									<span class="input-group-btn">

									<button class="btn btn-default" type="button" id="btn_mname">
									<span class="glyphicon glyphicon-search"></span>
									</button>
									</span>
								</div>
							</div>
							<!-- /col-lg-12 -->
						</div>

						<div id="popup_mname" ></div>

					</div>
					<!-- /modal-body -->
				</div>
				<!-- /modal-content -->
			</div>
			<!-- /modal-dialog -->
		</div>
	<!--팝업끝-->

</body>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
