<?
//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$sql = "select * from depo_spend where de_sp_code = '".$_GET['pNo']."'";
	$conn->DBQ($sql);
	$conn->DBE();
	$board = $conn->DBF();

	$query = "select * from depo_spend_detail where de_sp_code = '".$board['de_sp_code']."'";
	$conn->DBQ($query);
	$conn->DBE();
	$rescnt = $conn->resultRow();
	for($i=0; $i<$rescnt; $i++)
	{
		$result[$i] = $conn->DBF();
	}

	$sumArr = array();
	for($a=0; $a<$rescnt; $a++)
	{
		$sumArr[$a] = $result[$a]['all_price'];

		$sum += preg_replace("/[^\d]/","",$sumArr[$a]);
	}
	$sum2 = $sum - $board['de_sp_price'];

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">');?>
<?$layout->head($head);?>

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

	function summ()
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
				}
			}
			document.getElementById('all_price['+i+']').value = comma(uncomma(document.getElementById('all_price['+i+']').value));
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
      <h3><a href="customer_sale_detail.php?pNo=<<?php echo $_GET['pNo'];?>"><i class="fa fa-angle-right"></i> 판매 상세</a></h3>
			<form action="./api/customerReg/customer_sale.php" class="form-horizontal style-form" method="post"> <!--  name="order_form" id="order_form" -->
				<input type="hidden" name="compare" value="20">
				<input type="hidden" name="inout_code" value="<?php echo $board['in_out_code']; ?>">

				<!-- 등록자, 등록일자, 최종수정자, 최종수정일자 -->
				<div class="col-lg-4">
				</div>
				<div class="col-lg-2">
					<p><strong>등록자</strong> : <?php echo $board['insert_per']; ?></p>
				</div>
				<div class="col-lg-2">
					<p><strong>등록일자</strong> : <?php echo $board['insert_day']; ?> </p>
				</div>
				<div class="col-lg-2">
					<p><strong>수정자</strong> : <?php if($board['modify_per']) { echo $board['modify_per']; } else { echo "/NaN"; } ?> </p>
				</div>
				<div class="col-lg-2">
					<p><strong>수정일자</strong> : <?php if($board['modify_day']) { echo $board['modify_day']; } else { echo "/NaN"; } ?> </p>
				</div>

				<div class="row mt">
				  <div class="col-lg-6" style="">
		        <div class="form-panel">
						  <div class="cmxform form-horizontal style-form">

								<!-- 일자 -->
								<div class="form-group">
		              <label for="num" class="control-label col-lg-2">일자</label>
		              <div class="col-lg-10">
		                <input type="text" class="form-control dpd1" name="input_date" placeholder="등록하는 날짜를 입력해주세요." value="<?php echo $board['de_sp_date']; ?>" readonly="">
		              </div>
								</div>

								<!-- 담당자명 -->
								<div class="form-group">
		              <div class="control-label col-lg-2">
										<a href="#"  data-toggle="modal" data-target="#myModal_com">담당자명</a>
									</div>

				          <div class="col-lg-10">
				            <input class=" form-control" id="manager" name="manager" minlength="2" type="text" value="<?php echo $board['in_out_m']; ?>" required="">
				          </div>
								</div>

								<!-- 고객명 -->
								<div class="form-group">
									<div class="control-label col-lg-2">
										<a href="#"  data-toggle="modal" data-target="#myModal_com">고객명</a>
									</div>

									<div class="col-lg-10">
										<input class=" form-control" id="ccompany" name="company" minlength="2" type="text" value="<?php echo $board['com_name']; ?>" >
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
	                      <input type="text" id="cwarehouse" class="form-control dpd2" name="warehouse"  value="<?php echo $board['ware_code']; ?>">
	                    </div>
										</div>

										<div class="form-group">
	                    <div class="control-label col-lg-2">
												<a href="#"  data-toggle="modal" data-target="#myModal_stock">매장명</a>
											</div>
	                    <div class="col-lg-10">
	                      <input class=" form-control" id="cstore" name="store" minlength="2"  value="<?php echo $board['store_name']; ?>" type="text">
	                    </div>
										</div>

										<div class="form-group ">
	                    <div class="control-label col-lg-2">
												<a href="#"  data-toggle="modal" data-target="#myModal_warehouse">비고</a>
											</div>
		                    <div class="col-lg-10">
		                      <input class=" form-control" id="memo" name="memo" value="<?php echo $board['memo']; ?>" minlength="2" type="text">
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
								  <thead class="cf" style="background-color: #BDBDBD;" >
										<input type="hidden" name="detail" value="11">
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
										$sql = "select * from depo_spend_detail where de_sp_code = '".$board['de_sp_code']."' order by idx";
										$conn->DBQ($sql);
										$conn->DBE();

										$resCnt = $conn->resultRow();

										$i=0;
                    while($res = $conn->DBF()) {
		                ?>
										<tr id="myTr[<?php echo $i; ?>]">
											<td data-title="상품코드">
												<div class="input-group">
													<input type="text" class="form-control" id="product_code[<?php echo $i; ?>]" name="product_code[]" required="" <?echo 'value='.$res['product_code'];?>>
												</div>
											</td>

											<td data-title="상품명">
												<div class="input-group">
													<input type="text" class="form-control" id="product_name[<?php echo $i; ?>]" name="product_name[]" required="" <?echo 'value='.$res['product_name'];?>>
												</div>
											</td>

											<td data-title="공급가"><input type="text" class="form-control" id="sup_price[<?php echo $i; ?>]" name="sup_price[]" required="" <?echo 'value='.$res['sup_price'];?>></td>
											<td data-title="수량"><input type="text" class="form-control" id="in_out_cnt[<?php echo $i; ?>]"  name="in_out_cnt[]" required="" <?echo 'value='.$res['in_out_cnt'];?>></td>
											<td data-title="부가세">
												<select class="form-control" id="surtax[<?php echo $i; ?>]" value="" name="surtax[]" style="font-size:13px;">
													<?
														if($res['surtax'] == 1){
															echo '<option id="apply[0]" selected="selected" readonly="" value="1">부가세 적용</option>
															<option id="no_apply[0]" readonly="" value="2">부가세 미적용</option>';
														} else if ($res['surtax'] == 2) {
															echo '<option id="apply[0]" readonly="" value="1">부가세 적용</option>
															<option id="no_apply[0]" selected="selected" readonly="" value="2">부가세 미적용</option>';
														}
													?>
												</select>
											</td>
											<td data-title="할인"><input type="text" class="form-control" id="sale[<?php echo $i; ?>]" name="sale[]" value="0" required="" <?echo 'value='.$res['sale'];?>></td>
											<td data-title="총 가격"><input type="text" class="form-control" id="all_price[<?php echo $i; ?>]" name="all_price[]" readonly="readonly" required="" <?echo 'value='.$res['all_price'];?>></td>
										</tr>
									<?php $i++;}?>
									</tbody>
								</table>
							</section>
						</div>
						<!-- /col-lg-12 -->

						<?php
						if($board['in_out_code'] == null){
						?>
						<div class="col-lg-12" style="text-align:center">
							<button id="addItemBtn" type="button" class="btn btn-default"> + </button>
						</div>
					<?php } else { }?>
						</div>
						<!-- /row mt -->

						<div class="row mt" style="text-align:right">
							<div class="col-lg-12">
								<input type="hidden" name="d_code" value="<?php echo $_GET['pNo']; ?>">
								<input type="hidden" id="total_price" name="total_price" value="">
								<button class="btn btn-theme" id="sub" type="submit" onclick="check()" onmousemove="sumPrice()">수정</button>
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
			var i = <?php echo $resCnt; ?>-1;
			$('#addItemBtn').click(function() {
				i++;

				var rowItem = '<tr id="myTr['+i+']">';
				rowItem += '<td data-title=""><button id="deleteItemBtn['+i+']" type="button" value="'+i+'" class="btn btn-danger" onclick="deleteLine(this, '+i+')"> - </button></td>'
				rowItem += '<td data-title="수입 내용"> <input type="text" class="form-control" id="product_name['+i+']" name="product_name[]" value="" required=""></td>';
				rowItem += '<td data-title="금액"> <input type="text" class="form-control" id="all_price['+i+']" name="all_price[]" required="" value="" onchange="getNumber(this);" onkeyup="getNumber(this);" ></td>';
				$('#order_table > tbody:last').append(rowItem);
			})

			function deleteLine(obj, num){

				for(var a=0; a<document.getElementsByName('product_name[]').length; a++)
				{
					if(document.getElementById('deleteItemBtn['+a+']').value == num)
					{
						document.getElementById('product_name['+a+']').removeAttribute("required");
						document.getElementById('product_name['+a+']').removeAttribute("value");

						document.getElementById('all_price['+a+']').removeAttribute("required");
						document.getElementById('all_price['+a+']').removeAttribute("value");
					}
				}

				var tr = $(obj).parent().parent();
				tr.hide();
			}

			$("#sub").click(function() {

				for(var j=0; j < document.getElementsByName('product_code[]').length;j++){
					if(document.getElementById('product_code['+j+']').value==""){
						var k =0;

					}else{
						k=1;
					}
					k= k+k;

				}
				if(k==0){
					alert (k);
					return 0;


				}else{
					return true;

				}
			});

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
				var product_code = <?php echo json_encode($product_code_arr); ?>;

				$( "#product_code\\["+i+"\\]" ).autocomplete({
					source: product_code
				});
			});

			$(function() {
				var product_name = <?php echo json_encode($product_name_arr); ?>;

				$( "#product_name\\["+i+"\\]" ).autocomplete({
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
</body>
</html>
<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
