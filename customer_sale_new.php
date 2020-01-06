<?
//판매 추가
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

  function call(){
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

		// sumArr.push(1);
		// sumArr.push(100);

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
        <h3><a href="customer_sale_new.php"><i class="fa fa-angle-right"></i>판매 추가</a></h3>
					<form action="./api/customerReg/customer_sale.php" class="form-horizontal style-form" method="post">
						<input type="hidden" name="compare" value="10">
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
													<input type="text" id="datepicker" name="date_from" readonly="readonly" placeholder="금액이 입금되는 날짜를 선택해주세요." value="<?php echo $cur_date; ?>" class="form-control" required="">
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

										<!-- 고객명 -->
										<div class="form-group">
											<div class="fa-hover col-md-2 col-sm-3">
												<a href="" data-toggle="modal" data-target="#myModal_com"><font color="red"><i class="fa fa-search" name= "com_name"></i> 고객명 </font></a>
										</div>

										<div class="col-lg-10">
											<input class="form-control" id="ccompany" type="text" required="" name="company">
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
									<input class="form-control" id="cwarehouse" type="text" name="warehouse">
								</div>
							</div>

							<!-- 매장명 -->
							<div class="form-group">
								<label for="date" class="control-label col-lg-2"> 매장명 </label>
								<div class="col-lg-10">
									<input class="form-control" id="cstore" type="text" name="store">
								</div>
						</div>

						<!-- 비고 -->
						<div class="form-group">
							<label for="comment" class="control-label col-lg-2">비고</label>
							<div class="col-lg-10">
								<input class="form-control" id="cmemo" type="text" name="memo">
							</div>
						</div>

							</div>
						</div>
					</div>
					<!-- /col-lg-6 -->

				</div>
				<!-- /row-mt -->

				<div class="row mt" id="txtHint">
				  <div class="col-lg-12" style="">
					  <section id="no-more-tables">
						<table class="table table-bordered table-hover table-striped" id="order_table">
						  <thead class="cf" style="background-color: #BDBDBD;" >
							<tr>
								<th></th>
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
								<tr id="myTr[0]">
									<td data-title=""><button id="deleteItemBtn[0]" type="button" value="0" class="btn btn-danger" onclick="deleteLine(this, 0)"> - </button></td>

                  <td data-title="상품코드"><input type="text" class="form-control" id="product_code[0]" name="product_code[]" value="" required=""></td>
									<td data-title="상품명"><input type="text" class="form-control" id="product_name[0]" name="product_name[]" value="" required=""></td>
                  <td data-title="공급가"><input type="number" autocomplete="off" class="form-control" id="sup_price[0]" name="sup_price[]" onchange="call()" required="" value=""></td>
                  <td data-title="수량"><input type="number" autocomplete="off" class="form-control" id="in_out_cnt[0]" name="in_out_cnt[]" onchange="call()" required="" value=""></td>
                  <td data-title="부가세"><select class="form-control" id="surtax[0]" onchange="call()" value="" name="surtax[]" style="font-size:13px;">
                    <option id="apply[0]" value="1">부가세 적용</option>
                    <option id="no_apply[0]" value="2">부가세 미적용</option>
                  </td>
                  <td data-title="할인"><input type="number" autocomplete="off" class="form-control" id="sale[0]" name="sale[]" value="0" onchange="call()" required="" value=""></td>
									<td data-title="총 가격"><input type="text" class="form-control" readonly="" id="all_price[0]" name="all_price[]" required="" value=""></td>
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
					<input type="hidden" id="total_price" name="total_price" value="">
					<button class="btn btn-theme" id="sub" type="submit" onmousemove="sumPrice()">등록</button>
					<button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
				</div>
			</div>
		</form>

		<?php
		// $sql = "select com_name from wine_company";
		// $conn->DBQ($sql);
		// $conn->DBE();
		// $cntCom = $conn->resultRow();
		// for($i=0; $i<$cntCom; $i++) { $company[$i] = $conn->DBF(); }
		// for($i=0; $i<$cntCom; $i++) { $company_arr[$i] = $company[$i]['com_name']; }
		//
		// $sql = "select ware_name from wine_warehouse";
		// $conn->DBQ($sql);
		// $conn->DBE();
		// $cntWare = $conn->resultRow();
		// for($i=0; $i<$cntWare; $i++) { $ware[$i] = $conn->DBF(); }
		// for($i=0; $i<$cntWare; $i++) { $ware_arr[$i] = $ware[$i]['ware_name']; }
		//
		// $sql = "select store_name from wine_store";
		// $conn->DBQ($sql);
		// $conn->DBE();
		// $cntStore = $conn->resultRow();
		// for($i=0; $i<$cntStore; $i++) { $store[$i] = $conn->DBF(); }
		// for($i=0; $i<$cntStore; $i++) { $store_arr[$i] = $store[$i]['store_name']; }
		//
		// $sql = "select product_code from wine_product";
		// $conn->DBQ($sql);
		// $conn->DBE();
		// $cntPro_code = $conn->resultRow();
		// for($i=0; $i<$cntPro_code; $i++) { $product_code[$i] = $conn->DBF(); }
		// for($i=0; $i<$cntPro_code; $i++) { $product_code_arr[$i] = $product_code[$i]['product_code']; }
		//
		// $sql = "select product_name from wine_product";
		// $conn->DBQ($sql);
		// $conn->DBE();
		// $cntProname = $conn->resultRow();
		// for($i=0; $i<$cntProname; $i++) { $product_name[$i] = $conn->DBF(); }
		// for($i=0; $i<$cntProname; $i++) { $product_name_arr[$i] = $product_name[$i]['product_name']; }
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

		var i = 0;
		$('#addItemBtn').click(function() {
			i++;

			var rowItem = '<tr id="myTr['+i+']">';
			rowItem += '<td data-title=""><button id="deleteItemBtn['+i+']" type="button" value="'+i+'" class="btn btn-danger" onclick="deleteLine(this, '+i+')"> - </button></td>';
      rowItem += '<td data-title="상품코드"><input type="text" class="form-control" id="product_code['+i+']" name="product_code[]" value="" required=""></td>';
			rowItem += '<td data-title="상품명"> <input type="text" class="form-control" id="product_name['+i+']" name="product_name[]" value="" required=""></td>';
      rowItem += '<td data-title="공급가"><input type="number" autocomplete="off" class="form-control" id="sup_price['+i+']" name="sup_price[]" onchange="call()" required="" value=""></td>';
      rowItem += '<td data-title="수량"><input type="number" autocomplete="off" class="form-control" id="in_out_cnt['+i+']" name="in_out_cnt[]" onchange="call()" required="" value=""></td>';
      rowItem += '<td data-title="부가세"><select class="form-control" id="surtax['+i+']" onchange="call()" value="" name="surtax[]" style="font-size:13px;"><option id="apply['+i+']" value="1">부가세 적용</option><option id="no_apply['+i+']" value="2">부가세 미적용</option></td>';
      rowItem += '<td data-title="할인"><input type="number" autocomplete="off" class="form-control" id="sale['+i+']" name="sale[]" value="0" onchange="call()" required="" value=""></td>';
			rowItem += '<td data-title="총 가격"> <input type="text" readonly="" class="form-control" id="all_price['+i+']" name="all_price[]" required="" value=""></td>';
			$('#order_table > tbody:last').append(rowItem);
		})

		function deleteLine(obj, num){

			for(var a=0; a<document.getElementsByName('product_name[]').length; a++)
			{
				if(document.getElementById('deleteItemBtn['+a+']').value == num)
				{
          document.getElementById('product_code['+a+']').removeAttribute("required");
					document.getElementById('product_code['+a+']').value = "";

					document.getElementById('product_name['+a+']').removeAttribute("required");
					document.getElementById('product_name['+a+']').value = "";

          document.getElementById('sup_price['+a+']').removeAttribute("required");
					document.getElementById('sup_price['+a+']').value = "";

          document.getElementById('in_out_cnt['+a+']').removeAttribute("required");
					document.getElementById('in_out_cnt['+a+']').value = "";

          document.getElementById('sale['+a+']').removeAttribute("required");
					document.getElementById('sale['+a+']').value = "";

					document.getElementById('all_price['+a+']').removeAttribute("required");
					document.getElementById('all_price['+a+']').value = "0";
				}
			}

			var tr = $(obj).parent().parent();
			tr.hide();
		}

		$("#sub").click(function() {
			var k =0;
			for(var j=0; j < document.getElementsByName('product_name[]').length; j++){
				if(document.getElementById('product_code['+j+']').value==""){
					k=0;

				}else{
					k=1;
				}
				k= k+k;
			}
			if(k =="0"){
				alert ("항목을 추가하세요.");
				return false;
			}else{
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
