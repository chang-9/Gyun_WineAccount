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
<script>
</script>

<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
  	  <section class="wrapper">
				<h3><a href="stockInputNew.php"><i class="fa fa-angle-right"></i>출고 추가</a></h3>
				<form action="./api/stockReg/stockInput.php" class="form-horizontal style-form" method="post">
					<input type="hidden" name="compare" value="20">
					<div class="row mt">
						<div class="col-lg-6">
							<div class="form-panel">
								<div class="cmxform form-horizontal style-form">
									<!-- 일자 -->
									<div class="form-group">
										<label for="date" class="control-label col-lg-2"><font color="red"> 일자 </font></label>
										<div class="col-lg-10">
											<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-append date dpYears">
												<?php $cur_date = date('Y/m/d'); ?>
												<input type="text" id="datepicker" name="date_from" readonly="readonly" placeholder="물품이 출고되는 날짜를 선택해주세요." value="<?php echo $cur_date; ?>" class="form-control" required="">
											</div>
										</div>
								</div>

									<!-- 담당자 -->
									<div class="form-group">
										<label for="date" class="control-label col-lg-2"><font color="red">담당자</font></label>
										<div class="col-lg-10">
											<input class="form-control" id="cmanager" type="text" name="manager" required="">
										</div>
								</div>

									<!-- 거래처 -->
									<div class="form-group">
										<div class="fa-hover col-md-2 col-sm-3">
											<a href="" data-toggle="modal" data-target="#myModal_com"><i class="fa fa-search" name= "com_name"></i> 거래처 </a>
									</div>

									<div class="col-lg-10">
										<input class="form-control" id="ccompany" type="text" name="company" required="">
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
									<a href="#" data-toggle="modal" data-target="#myModal_deposit"><i class="fa fa-search" name= "deposit_name"></i> 출고 창고 </a>

									<!-- pop-up -->
									<div class="modal fade" id="myModal_deposit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel">창고를 선택해주세요.</h4>
												</div>
												<div class="modal-body">
													창고 테이블을 넣어주세요.
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
												</div>
											</div>
										</div>
									</div>
									<!-- /pop-up -->
							</div>

							<div class="col-lg-10">
								<input class="form-control" id="cwarehouse" type="text" name="warehouse" required="" placeholder="재고가 출고될 창고를 선택해주세요.">
							</div>
						</div>

						<!-- 매장명 -->
						<div class="form-group">
							<label for="date" class="control-label col-lg-2"> 매장명 </label>
							<div class="col-lg-10">
								<input class="form-control" id="cwarehouse" type="text" name="store" required="" placeholder="재고가 소속될 매장을 선택해주세요.">
							</div>
					</div>

					<!-- 비고 -->
					<div class="form-group">
						<label for="comment" class="control-label col-lg-2">비고</label>
						<div class="col-lg-10">
							<input class="form-control" id="cwarehouse" type="text" name="memo">
						</div>
					</div>

						</div>
					</div>
				</div>
				<!-- /col-lg-6 -->
			</div>
			<!-- /row mt -->

			<div class="row mt" id="txtHint">
				<div class="col-lg-12" style="">
					<section id="no-more-tables">
						<table class="table table-bordered table-hover table-striped" id="order_table">
							<thead class="cf" style="background-color: #BDBDBD;">
								<tr>
									<th></th>
									<th class="numeric">상품코드</th>
									<th class="numeric">상품명</th>
									<th class="numeric">단가</th>
									<th class="numeric">출고 수량</th>
									<th class="numeric" style="display:none;">합계 금액</th>
								</tr>

								<tbody>
									<tr id="myTr[0]">
										<td data-title=""><button id="deleteItemBtn[0]" type="button" value="0" class="btn btn-danger" onclick="deleteLine(this, 0)"> - </button></td>
										<td data-title="상품코드">
											<div class="input-group">
												<input type="text" class="form-control" id="product_code[0]" name="product_code[]" value="" required="">
												<span class="input-group-addon info"><a href="#" data-toggle="modal" data-target="#myModal_deposit"><span class="glyphicon glyphicon-asterisk"></span></a></span>
											</div>
										</td>

										<td data-title="상품명">
											<div class="input-group">
												<input type="text" class="form-control" id="product_name[0]" name="product_name[]" value="" required="">
												<span class="input-group-addon info"><a href="#" data-toggle="modal" data-target="#myModal_deposit"><span class="glyphicon glyphicon-asterisk"></span></a></span>
											</div>
										</td>

										<td data-title="단가"><input type="number" class="form-control" id="in_out_price[0]" autocomplete="off" name="in_out_price[]" value=""></td>
										<td data-title="출고 수량"><input type="number" class="form-control" id="in_out_cnt[0]" autocomplete="off" name="in_out_cnt[]" value=""></td>
										<td data-title="합계 금액" style="display:none;"><input type="text" class="form-control" id="all_price[0]" name="all_price[]" value=""></td>
									</tr>
								</tbody>
							</table>
						</section>
					</div>
					<!-- /col-lg-12 END -->

					<div class="col-lg-12" style="text-align:center">
						<button id="addItemBtn" type="button" class="btn btn-default"> + </button>
					</div>
				</div>
				<!-- /row mt -->

				<div class="row mt" style="text-align:right">
					<div class="col-lg-12">
						<button class="btn btn-theme" id="sub" type="submit">등록</button>
						<button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
					</div>
				</div>
			</form>

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
		var i=0;
		$("#addItemBtn").click(function() {
			i++;

			var rowItem = '<tr id="myTr['+i+']">';
			rowItem += '<td data-title=""><button id="deleteItemBtn['+i+']" type="button" value="'+i+'" class="btn btn-danger" onclick="deleteLine(this, '+i+')"> - </button></td>'
			rowItem += '<td data-title="상품코드"><div class="input-group"><input type="text" class="form-control" id="product_code['+i+']" name="product_code[]" value="" required=""><span class="input-group-addon info"><a href="#" data-toggle="modal" data-target="#myModal_deposit"><span class="glyphicon glyphicon-asterisk"></span></a></span></div></td>'
			rowItem += '<td data-title="상품명"><div class="input-group"><input type="text" class="form-control" id="product_name['+i+']" name="product_name[]" value="" required=""><span class="input-group-addon info"><a href="#" data-toggle="modal" data-target="#myModal_deposit"><span class="glyphicon glyphicon-asterisk"></span></a></span></div></td>'
			rowItem += '<td data-title="단가"><input type="number" class="form-control" autocomplete="off" id="in_out_price['+i+']" name="in_out_price[]" value=""></td>'
			rowItem += '<td data-title="출고 수량"><input type="number" class="form-control" autocomplete="off" id="in_out_cnt['+i+']" name="in_out_cnt[]" value=""></td>'
			rowItem += '<td data-title="합계 금액" style="display:none;"><input type="text" class="form-control" id="all_price['+i+']" name="all_price[]" value=""></td>'
			$('#order_table > tbody:last').append(rowItem);
		})

		function deleteLine(obj){

			var tr = $(obj).parent().parent();
			tr.hide();

			for(var a=0; a<document.getElementsByName('product_code[]').length; a++)
			{
				if(document.getElementById('deleteItemBtn['+a+']').value == num)
				{
					document.getElementById('product_code['+a+']').removeAttribute("required");
					document.getElementById('product_code['+a+']').value = "";

					document.getElementById('product_name['+a+']').removeAttribute("required");
					document.getElementById('product_name['+a+']').value = "";

					document.getElementById('in_out_price['+a+']').removeAttribute("required");
					document.getElementById('in_out_price['+a+']').value = "";

					document.getElementById('in_out_cnt['+a+']').removeAttribute("required");
					document.getElementById('in_out_cnt['+a+']').value = "";

					document.getElementById('all_price['+a+']').value = "";
				}
			}
		}

		$("#sub").click(function() {
			var k =0;
			for(var j=0; j < document.getElementsByName('product_code[]').length; j++){
				if(document.getElementById('product_code['+j+']').value==""){
					k=0;

				}else{
					k=1;
				}
				k= k+k;
			}
			if(k =="0"){
				alert ("상품 항목을 추가하세요.");
				return false;

			}else{
				return true;
			}
		});
	</script>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
