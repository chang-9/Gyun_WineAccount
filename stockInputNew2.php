<?
//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$sql = "select * from wine_in_out where idx = '".$_GET['bNo']."'";
	$conn->DBQ($sql);
	$conn->DBE();
	$board = $conn->DBF();

	$layout = new Layout;

	$sql = "select * from in_out_detail where in_out_code = '".$board['in_out_code']."'";
	$conn->DBQ($sql);
	$conn->DBE();
	$rescnt = $conn->resultRow();
	$res = $conn->DBP();

	for($i=0; $i<$rescnt; $i++)
	{
		$sum += preg_replace("/[^\d]/","",$res[$i]['in_out_cnt']);
	}
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
		for(var i=0; i<document.getElementsByName('product_code[]').length; i++)
		{
			var target = document.getElementById('surtax['+i+']');

			if(document.getElementById('sup_price['+i+']').value && document.getElementById('in_out_cnt['+i+']').value && document.getElementById('sale['+i+']').value)
			{
				if(target.options[target.selectedIndex].value == 1)
				{
					var sum = parseInt(document.getElementById('sup_price['+i+']').value) * parseInt(document.getElementById('in_out_cnt['+i+']').value);

					document.getElementById('all_price['+i+']').value = sum + Math.floor(sum/10) - parseInt(document.getElementById('sale['+i+']').value);

					document.getElementById('all_price['+i+']').value = comma(uncomma(document.getElementById('all_price['+i+']').value));
				}
				else if(target.options[target.selectedIndex].value == 2)
				{
					var sum = parseInt(document.getElementById('sup_price['+i+']').value) * parseInt(document.getElementById('in_out_cnt['+i+']').value) - parseInt(document.getElementById('sale['+i+']').value);

					document.getElementById('all_price['+i+']').value = sum;
					document.getElementById('all_price['+i+']').value = comma(uncomma(document.getElementById('all_price['+i+']').value));
				}
			}
		}
	}

	function sumPrice()
	{
		var sumArr = new Array();
		var sum = 0;

		for(var i=0; i<document.getElementsByName('all_price[]').length; i++)
		{
			 sumArr.push(parseInt(uncomma(document.getElementById('all_price['+i+']').value)));
			 sum += sumArr[i];
		}
		document.getElementById('total_price').value = sum;
		document.getElementById('total_price').value = comma(uncomma(document.getElementById('total_price').value));
	}
</script>

<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
      <h3><a href="stockInputNew2.php?bNo=<<?php echo $_GET['bNo'];?>"><i class="fa fa-angle-right"></i> 입고 추가</a></h3>
			<form action="./api/stockReg/stockInput.php" class="form-horizontal style-form" method="post"> <!--  name="order_form" id="order_form" -->
				<input type="hidden" name="compare" value="11">

				<div class="row mt">
				  <div class="col-lg-6" style="">
		        <div class="form-panel">
						  <div class="cmxform form-horizontal style-form">

								<!-- 일자 -->
								<div class="form-group">
		              <label for="num" class="control-label col-lg-2">일자</label>
		              <div class="col-lg-10">
		                <input type="text" class="form-control dpd1" readonly="" placeholder="등록하는 날짜를 입력해주세요." value="<?php echo $board['input_date']; ?>" readonly="">
		              </div>
								</div>

								<!-- 거래처명 -->
								<div class="form-group">
		              <div class="control-label col-lg-2">
										<a href="#"  data-toggle="modal" data-target="#myModal_com">담당자명</a>
									</div>

				          <div class="col-lg-10">
				            <input class=" form-control" id="manager" readonly="" minlength="2" type="text" value="<?php echo $board['m_name']; ?>" required="">
				          </div>
								</div>

								<!-- 거래처명 -->
								<div class="form-group">
									<div class="control-label col-lg-2">
										<a href="#"  data-toggle="modal" data-target="#myModal_com">거래처명</a>
									</div>

									<div class="col-lg-10">
										<input class=" form-control" id="ccompany" readonly="" name="company" minlength="2" type="text" value="<?php echo $board['com_name']; ?>" required="" >
									</div>
								</div>

						  </div>
						</div>
				  </div>
	        <!-- /col-lg-6 END -->

		          <div class="col-lg-6" style="">
		            <div class="form-panel">
								  <div class="cmxform form-horizontal style-form">
										<div class="form-group">
	                    <label for="address" class="control-label col-lg-2">출하 창고</label>
	                    <div class="col-lg-10">
	                      <input type="text" id="cwarehouse" class="form-control dpd2" name="warehouse" readonly=""  value="<?php echo $board['ware_code']; ?>">
	                    </div>
										</div>

										<div class="form-group">
											<label for="address" class="control-label col-lg-2">매장명</label>
	                    <div class="col-lg-10">
	                      <input class=" form-control" id="cstore" readonly="" name="store" minlength="2"  value="<?php echo $board['store_name']; ?>" type="text">
	                    </div>
										</div>

										<div class="form-group ">
											<label for="address" class="control-label col-lg-2">비고</label>
		                    <div class="col-lg-10">
		                      <input class=" form-control" id="memo" readonly="" value="<?php echo $board['memo']; ?>" minlength="2" type="text">
		                    </div>
										</div>

								  </div>
								</div>
		          </div>
		          <!-- /col-lg-6 END -->
		        </div>
						<!-- /row-mt -->

						<div class="row mt" id="txtHint">
							<div class="col-lg-12" style="">
								<section id="no-more-tables">
								<table class="table table-bordered table-hover table-striped" id="order_table">
									<thead class="cf" style="background-color: #BDBDBD;">
										<tr>
											<th style="display: none;"></th>
											<th class="numeric">상품코드</th>
											<th class="numeric">상품명</th>
											<th class="numeric">단가</th>
											<th class="numeric">수량</th>
										</tr>
									</thead>

									<tbody>
										<?php
											$bNo = $_GET['bNo'];
											$sql = "select * from wine_in_out where idx = '".$bNo."'";
											$conn->DBQ($sql);
											$conn->DBE();
											$row = $conn->DBF();


											$sql = "select * from in_out_detail where in_out_code = '".$row['in_out_code']."'";
											$conn->DBQ($sql);
											$conn->DBE();

											$i=0;
											while($res = $conn->DBF()) {
										 ?>
										<tr>
											<td style="display: none">
												<input type="hidden" name="p_idx[]" value="<?php echo $res['idx']; ?>">
											</td>
											<td data-title="상품 코드">
												<input type="text" class="form-control" id="product_code[<?php echo $i; ?>]" required="" readonly="" <?echo 'value='.$res['product_code'];?>>
											</td>

											<td data-title="상품명">
												<input type="text" class="form-control" id="product_name[<?php echo $i; ?>]" required="" readonly="" <?echo 'value='.$res['product_name'];?>>
											</td>

											<td data-title="단가">
												<input type="number" class="form-control" id="in_out_price[<?php echo $i; ?>]" autocomplete="off" name="in_out_price[]" required="" readonly="" <?echo 'value='.$res['sup_price'];?>>
											</td>
											<td data-title="수량">
												<input type="text" class="form-control" id="in_out_cnt[<?php echo $i; ?>]" autocomplete="off" required="" readonly="" value="<?php echo $res['in_out_cnt'];?>">
											</td>
										</tr>
										<?php $i++;} ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="3" style="text-align:right;">합계</td>
											<td><input type=text class="form-control" readonly="" id="total_cnt" value="<?php echo number_format($sum); ?>"></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>

						<div id="bo_line"></div>

				<div class="row mt">
				  <div class="col-lg-6" style="">
		        <div class="form-panel">
						  <div class="cmxform form-horizontal style-form">

								<!-- 일자 -->
								<div class="form-group">
		              <label for="num" class="control-label col-lg-2">일자</label>
		              <div class="col-lg-10">
										<?php $cur_date = date('Y/m/d'); ?>
		                <input type="text" class="form-control dpd1" name="date_from" id="datepicker" placeholder="등록하는 날짜를 입력해주세요." value="<?php echo $cur_date; ?>" readonly="">
		              </div>
								</div>

								<!-- 담당자명 -->
								<div class="form-group">
		              <div class="control-label col-lg-2">
										<a href="#"  data-toggle="modal" data-target="#myModal_com">담당자명</a>
									</div>

				          <div class="col-lg-10">
				            <input class=" form-control" id="manager" placeholder="입고건에 대한 담당자를 입력해주세요. . ." name="manager" minlength="2" type="text" value="" required="">
				          </div>
								</div>

								<!-- 비고 -->
								<div class="form-group ">
									<div class="control-label col-lg-2">
										<a href="#"  data-toggle="modal" data-target="#myModal_warehouse">비고</a>
									</div>
										<div class="col-lg-10">
											<input class=" form-control" id="memo" name="memo" value="" minlength="2" type="text">
										</div>
								</div>

						  </div>
						</div>
				  </div>
	        <!-- /col-lg-6 END -->
					<div class="col-lg-6">
						<section id="no-more-tables">
							<table class="table table-bordered table-hover table-striped" id="order_table">
								<thead class="cf" style="background-color: #BDBDBD;">
									<tr>
										<th class="numeric">상품코드</th>
										<th class="numeric">상품명</th>
										<th class="numeric">수량</th>
										<th class="numeric">입고 수량</th>
									</tr>
								</thead>

								<tbody>
									<?php
										$bNo = $_GET['bNo'];
										$sql = "select * from wine_in_out where idx = '".$bNo."'";
										$conn->DBQ($sql);
										$conn->DBE();
										$row = $conn->DBF();


										$sql = "select * from in_out_detail where in_out_code = '".$row['in_out_code']."'";
										$conn->DBQ($sql);
										$conn->DBE();

										$i=0;
										while($res = $conn->DBF()) {
									 ?>
									<tr>
										<td style="display: none">
											<input type="hidden" name="p_idx[]" value="<?php echo $res['idx']; ?>">
										</td>
										<td data-title="상품 코드">
											<input type="text" class="form-control" id="product_code[<?php echo $i; ?>]" name="product_code[]" required="" readonly="" <?echo 'value='.$res['product_code'];?>>
										</td>

										<td data-title="상품명">
											<input type="text" class="form-control" id="product_name[<?php echo $i; ?>]" name="product_name[]" required="" readonly="" <?echo 'value='.$res['product_name'];?>>
										</td>
										<td data-title="수량">
											<input type="text" class="form-control" id="in_out_cnt[<?php echo $i; ?>]" name="in_out_cnt[]" autocomplete="off" required="" readonly="" value="<?php echo $res['in_out_cnt'];?>">
										</td>
										<td data-title="입고 수량">
											<input type="number" class="form-control" id="done_cnt[<?php echo $i; ?>]" name="done_cnt[]" autocomplete="off" required="" value="">
										</td>
									</tr>
									<?php $i++;} ?>
								</tbody>
							</table>
						</section>
					</div>
        </div>
				<!-- /row-mt -->


						<div class="row mt" style="text-align:right">
							<div class="col-lg-12">
								<input type="hidden" name="bidx" value="<?php echo $_GET['bNo']; ?>">
								<input type="hidden" name="inout_code" value="<?php echo $row['in_out_code']; ?>">
                <a href="#" data-toggle="modal" data-target="#Modal_sale"><button class="btn btn-theme02" type="button">매입서 불러오기</button></a>
								<button class="btn btn-theme" id="sub" type="submit" onmousemove="sumPrice()">등록</button>
								<button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
							</div>
						</div>

					</form>

          <!-- pop-up -->
          <div class="modal fade" id="Modal_sale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">매입서를 선택해주세요.</h4>
                </div>

                <div class="modal-body">
                  <div class="row mt">
                    <div class="col-lg-12">
                        <section id="no-more-tables">
                          <table class="table table-bordered table-hover table-striped">
                            <thead class="cf" style="background-color: #E6E6E6;">
                              <tr>
                                <th class="numeric"></th>
                                <th class="numeric">매입코드</th>
                                <th class="numeric">거래처명</th>
                                <th class="numeric">담당자명</th>
                                <th class="numeric">일자</th>
                                <th class="numeric">비고</th>
                              </tr>
                            </thead>

                            <?
                            $sql = "select * from wine_in_out where in_out_cate = '매입' and stock_cur = '0'";
                            $conn->DBQ($sql);
                            $conn->DBE();

                            while($row2 = $conn->DBF()) {
                            ?>
                            <tbody>
                              <tr>
                                <td data-title="선택"><a href="stockInputNew2.php?bNo=<?echo $row2['idx'];?>"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></button></a></td>
                                <td data-title="매입코드"><?echo $row2['in_out_code'];?></td>
                                <td data-title="거래처명"><?echo $row2['com_name'];?></td>
                                <td data-title="담당자명"><?echo $row2['m_name'];?></td>
                                <td data-title="일자"><?echo $row2['due_date'];?></td>
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

					<?php
					$sql = "select com_name from wine_company";
					$conn->DBQ($sql);
					$conn->DBE();
					$cntCom = $conn->resultRow();
					for($i=0; $i<$cntCom; $i++) { $company[$i] = $conn->DBF(); }
					for($i=0; $i<$cntCom; $i++) { $company_arr[$i] = $company[$i]['com_name']; }


					$sql = "select ware_name from wine_warehouse";
					$conn->DBQ($sql);
					$conn->DBE();
					$cntWare = $conn->resultRow();
					for($i=0; $i<$cntWare; $i++) { $ware[$i] = $conn->DBF(); }
					for($i=0; $i<$cntWare; $i++) { $ware_arr[$i] = $ware[$i]['ware_name']; }

					$sql = "select store_name from wine_store";
					$conn->DBQ($sql);
					$conn->DBE();
					$cntStore = $conn->resultRow();
					for($i=0; $i<$cntStore; $i++) { $store[$i] = $conn->DBF(); }
					for($i=0; $i<$cntStore; $i++) { $store_arr[$i] = $store[$i]['store_name']; }

					$sql = "select product_code from wine_product";
					$conn->DBQ($sql);
					$conn->DBE();
					$cntPro_code = $conn->resultRow();
					for($i=0; $i<$cntPro_code; $i++) { $product_code[$i] = $conn->DBF(); }
					for($i=0; $i<$cntPro_code; $i++) { $product_code_arr[$i] = $product_code[$i]['product_code']; }

					$sql = "select product_name from wine_product";
					$conn->DBQ($sql);
					$conn->DBE();
					$cntProname = $conn->resultRow();
					for($i=0; $i<$cntProname; $i++) { $product_name[$i] = $conn->DBF(); }
					for($i=0; $i<$cntProname; $i++) { $product_name_arr[$i] = $product_name[$i]['product_name']; }
					?>

				</section>
			</section>
			<!--main content end-->
	    <?$layout->footer($footer);?>
			</section>

			<?$layout->JsFile("
				<link rel='stylesheet' href='//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'>
			<script src='//code.jquery.com/ui/1.11.4/jquery-ui.min.js'></script>
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
			$(function() {
				var company = <?php echo json_encode($company_arr); ?>;

				$( "#ccompany" ).autocomplete({
					source: company
				});
			});

			$(function() {
				var warehouse = <?php echo json_encode($ware_arr); ?>;

				$( "#cwarehouse" ).autocomplete({
					source: warehouse
				});
			});

			$(function() {
				var store = <?php echo json_encode($store_arr); ?>;

				$( "#cstore" ).autocomplete({
					source: store
				});
			});

			$(function() {
				var product_code = <?php echo json_encode($product_code_arr); ?>;

				$( "#product_code\\[0\\]" ).autocomplete({
					source: product_code
				});
			});

			$(function() {
				var product_name = <?php echo json_encode($product_name_arr); ?>;

				$( "#product_name\\[0\\]" ).autocomplete({
					source: product_name
				});
			});
			</script>

			<script>
			$(function() {
				var company = <?php echo json_encode($company_arr); ?>;

				$( "#ccompany" ).autocomplete({
					source: company
				});
			});

			$(function() {
				var warehouse = <?php echo json_encode($ware_arr); ?>;

				$( "#cwarehouse" ).autocomplete({
					source: warehouse
				});
			});

			$(function() {
				var store = <?php echo json_encode($store_arr); ?>;

				$( "#cstore" ).autocomplete({
					source: store
				});
			});

			$(function() {
				var product_code = <?php echo json_encode($product_code_arr); ?>;

				$( "#product_code\\[0\\]" ).autocomplete({
					source: product_code
				});
			});
			</script>
</body>
</html>
<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
