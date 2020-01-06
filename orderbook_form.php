<?
//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	if(isset($_REQUEST['no']) && $_REQUEST['no'] != null) {
		$no = $_REQUEST['no'];

		$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
		$conn->DBI(); //DB 접속
		$query = "SELECT * FROM wine_order WHERE idx = $no";

		$conn->DBQ($query);
		$conn->DBE(); //쿼리 실행
		$result = $conn->DBF();

		$query2 = "SELECT * FROM order_detail WHERE order_code = '".$result['order_code']."'";
		$conn->DBQ($query2);
		$conn->DBE(); //쿼리 실행
		$res = $conn->DBF();
		$rescnt = $conn->resultRow();
	}
	if(isset($_REQUEST['product_code']) && $_REQUEST['product_code'] != null) {
		$product_code = $_REQUEST['product_code'];

		$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
		$conn->DBI(); //DB 접속
		$query = "SELECT * FROM wine_product WHERE product_code = '".$_REQUEST['product_code']."'";

		$conn->DBQ($query3);
		$conn->DBE(); //쿼리 실행
		$result3 = $conn->DBF();

		$query2 = "SELECT * FROM order_detail WHERE order_code = '".$result['order_code']."'";
		$conn->DBQ($query2);
		$conn->DBE(); //쿼리 실행
		$res = $conn->DBF();
		$rescnt = $conn->resultRow();
	}
	if(isset($_REQUEST['com_idx']) && $_REQUEST['com_idx'] != null) {
		$com_idx = $_REQUEST['com_idx'];

		$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
		$conn->DBI(); //DB 접속
		$query = "SELECT * FROM wine_company WHERE idx = $com_idx";

		$conn->DBQ($query);
		$conn->DBE(); //쿼리 실행
		$res_com = $conn->DBF();

	}


	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">

');?>
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

			if(document.getElementById('sup_price['+i+']').value && document.getElementById('order_cnt['+i+']').value && document.getElementById('sale['+i+']').value)
			{
				if(target.options[target.selectedIndex].value == 1)
				{
					var sum = parseInt(document.getElementById('sup_price['+i+']').value) * parseInt(document.getElementById('order_cnt['+i+']').value);

					document.getElementById('all_price['+i+']').value = sum + Math.floor(sum/10) - parseInt(document.getElementById('sale['+i+']').value);
					document.getElementById('all_price['+i+']').value = comma(uncomma(document.getElementById('all_price['+i+']').value));
				}
				else if(target.options[target.selectedIndex].value == 2)
				{
					var sum = parseInt(document.getElementById('sup_price['+i+']').value) * parseInt(document.getElementById('order_cnt['+i+']').value) - parseInt(document.getElementById('sale['+i+']').value);

					document.getElementById('all_price['+i+']').value = sum;
				}
			}
			document.getElementById('all_price['+i+']').value = comma(uncomma(document.getElementById('all_price['+i+']').value));
		}
	}

</script>
<?$layout->head($head);?>
<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
        <h3><a href="orderbook_form.php"><i class="fa fa-angle-right"></i><?if(isset($no)){echo '발주 상세';}else{echo '발주 등록';}?></a></h3>
			<form action="./api/orderReg/order_insert.php"   class="form-horizontal style-form" method="post" name="order_form" id="order_form">
			<?if(isset($no)){echo '
				 <input type="hidden" name="order_code" value="'.$result['order_code'].'">
				 <input type="hidden" name="order_name" value="'.$result['order_name'].'">
				 <input type="hidden" name="no" value="'.$no.'">
				 <input type="hidden" name="com_code" value="34875">
				 <input type="hidden" name="order_state" value="0">
				 <input type="hidden" name="order_cate" value="발주">
				 <input type="hidden" name="order_flag" value="1">';
				 }else{echo '
				 <input type="hidden" name="com_code" value="34875">
				 <input type="hidden" name="order_state" value="0">
				 <input type="hidden" name="order_cate" value="발주">
				 <input type="hidden" name="order_flag" value="1">';}?>

		<div class="row mt">
		  <div class="col-lg-6" style="">
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">

				<div class="form-group ">
                    <label for="num" class="control-label col-lg-2"><font color="red">일자</font></label>
                    <div class="col-lg-10">
                      <input type="text" id="datepicker" class="form-control dpd1" name="input_date" placeholder="등록하는 날짜를 입력해주세요."  <?if(isset($no)){echo 'value='.$result['input_date'];}?> readonly>
                    </div>
				</div>
				<div class="form-group">
                    <div class="control-label col-lg-2">
						<a href="#company"  data-toggle="modal" data-target="#myModal_com"><font color="red"><i class="fa fa-search"></i>거래처명</font></a>
						</div>
                    <div class="col-lg-10">
                      <input class=" form-control" id="com_name" name="com_name" minlength="2" type="text" <?if(isset($no)){echo 'value='.$result['com_name'];}?><?if(isset($com_idx)){echo 'value='.$res_com['com_name'];}?> required >
                    </div>
				</div>

				<div class="form-group ">
                    <div class="control-label col-lg-2">
						<a href="#"  data-toggle="modal" data-target="#myModal_mname"><i class="fa fa-search" name= "mname"></i>담당자</a>
						<!--팝업시작-->

						<!--팝업끝-->
					</div>
                    <div class="col-lg-10">
                      <input class=" form-control" id="m_name" name="m_name" minlength="2" <?if(isset($no)){echo 'value='.$result['m_name'];}?> type="text" required >
                    </div>
				</div>

			  </div>
			</div>
		  </div>
          <!-- /col-lg-6 END -->
          <div class="col-lg-6" style="">
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">
				<div class="form-group ">
                    <label for="address" class="control-label col-lg-2"><font color="red">납기 일자</font></label>
                    <div class="col-lg-10">
                      <input type="text" id="datepicker1" class="form-control dpd2" name= "due_date" <?if(isset($no)){echo 'value='.$result['due_date'];}?> placeholder="납기일을 입력해주세요." readonly>
                    </div>
				</div>

				<div class="form-group ">
                    <div class="control-label col-lg-2">
						<a href="#"  data-toggle="modal" data-target="#myModal_store"><font color="red"><i class="fa fa-search"></i>매장명</font></a>
						<!--팝업시작-->

						<!--팝업끝-->
					</div>
                    <div class="col-lg-10">
                      <input class=" form-control" id="store_name" name="store_name" minlength="2" <?if(isset($no)){echo 'value='.$result['store_name'];}?> type="text">
                    </div>
				</div>

				<div class="form-group ">
                    <div class="control-label col-lg-2">
						<a href="#"  data-toggle="modal" data-target="#myModal_warehouse"><i class="fa fa-search" name= "warehouse_name"></i>창고명</a>

					</div>
                    <div class="col-lg-10">
                      <input class=" form-control" id="warehouse_name" name="ware_code" minlength="2" type="text" <?if(isset($no)){echo 'value='.$result['ware_code'];}?> >
                    </div>
				</div>


			  </div>
			</div>
          </div>
          <!-- /col-lg-6 END -->
          <div class="col-lg-12" style="">
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">
				<div class="form-group ">
                    <label for="comment" class="control-label col-lg-1">비고</label>
                    <div class="col-lg-11">
                      <textarea class="form-control " id="memo" name="memo"><?if(isset($no)){echo $result['memo'];}?></textarea>
                    </div>
				</div>
              </div>
	        </div>
          </div>
        </div>
			<!-- /col-lg-12 -->
		</div>
				<!-- /row-mt -->

				<div class="row mt" id="txtHint">
				  <div class="col-lg-12" style="">
					  <section id="no-more-tables">
						<table class="table table-bordered table-hover table-striped" id="order_table">
						  <thead class="cf" style="background-color: #BDBDBD;" >
							<tr>
							  <th class="numeric"></th>
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
							$query2 = "SELECT * FROM order_detail WHERE order_code = '".$result['order_code']."'";
							$conn->DBQ($query2);
							$conn->DBE(); //쿼리 실행
							$i=0;
							$resCnt = $conn->resultRow();



						if(isset($no)){while($res = $conn->DBF() ) {?>

								<tr id="myTr[<?php echo $i; ?>]">
											<td data-title=""><button id="deleteItemBtn[<?php echo $i; ?>]" type="button" class="btn btn-danger" value="<?php echo $i; ?>" onclick="deleteLine(this, <?php echo $i; ?>)"> - </td>
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

											<td data-title="공급가"><input type="text" class="form-control" autocomplete="off" id="sup_price[<?php echo $i; ?>]" name="sup_price[]" onchange="call()" required="" <?echo 'value='.$res['sup_price'];?>></td>
											<td data-title="수량"><input type="text" class="form-control" autocomplete="off" id="order_cnt[<?php echo $i; ?>]" name="order_cnt[]" onchange="call()" required="" <?echo 'value='.$res['order_cnt'];?>></td>
											<td data-title="부가세">
												<select class="form-control" id="surtax[<?php echo $i; ?>]" onchange="call()" value="" name="surtax[]" style="font-size:13px;">
													<?
														if($res['surtax'] == 1){
															echo '<option id="apply['.$i.']" selected="selected" value="1">부가세 적용</option>
															<option id="no_apply['.$i.']" value="2">부가세 미적용</option>';
														} else if ($res['surtax'] == 2) {
															echo '<option id="apply['.$i.']" value="1">부가세 적용</option>
															<option id="no_apply['.$i.']" selected="selected" value="2">부가세 미적용</option>';
														}
													?>
												</select>
											</td>
											<td data-title="할인"><input type="text" class="form-control" autocomplete="off" id="sale[<?php echo $i; ?>]" name="sale[]" value="0" onchange="call()" required="" <?echo 'value='.$res['sale'];?>></td>
											<td data-title="총 가격"><input type="text" class="form-control" id="all_price[<?php echo $i; ?>]" name="all_price[]" readonly="readonly" required="" <?echo 'value='.$res['all_price'];?>></td>
										</tr>
									<?php $i++;}}else{?>

								<tr id="myTr[0]">
									<td data-title=""><button id="deleteItemBtn[0]" type="button" value="0" class="btn btn-danger" onclick="deleteLine(this, 0)"> - </td>
									<td data-title="상품코드">
										<div class="input-group">
											<input type="text" class="form-control" id="product_code[0]" name="product_code[]" required="" value="">
										</div>
									</td>

									<td data-title="상품명">
										<div class="input-group">
											<input type="text" class="form-control" id="product_name[0]" name="product_name[]" required="" value="">
										</div>
									</td>

									<td data-title="공급가"><input type="text" class="form-control" autocomplete="off" id="sup_price[0]" name="sup_price[]" onchange="call()" required="" value=""></td>
									<td data-title="수량"><input type="text" class="form-control" autocomplete="off" id="order_cnt[0]" name="order_cnt[]" onchange="call()" required="" value=""></td>
									<td data-title="부가세">
										<select class="form-control" id="surtax[0]" value="" onchange="call()" name="surtax[]" style="font-size:13px; ">
											<option id="apply[0]" value="1">부가세 적용</option>
											<option id="no_apply[0]" value="2">부가세 미적용</option>
										</select>
									</td>
									<td data-title="할인"><input type="text" class="form-control" autocomplete="off" id="sale[0]" name="sale[]" value="0" onchange="call()" required="" value=""></td>
									<td data-title="총 가격"><input type="text" class="form-control" id="all_price[0]" name="all_price[]" readonly="readonly" required="" value=""></td>
								</tr>
								<?}?>
						  </tbody>
						</table>
				  </section>
			  </div>
				  <!-- /col-lg-12 END -->

					<div class="col-lg-12" style="text-align:center">
						<button id="addItemBtn" type="button" class="btn btn-default"> + </button>
					</div>
				</div>
				<!-- /row -->


			<div class="row mt" style="text-align:right">
				<div class="col-lg-12">
					<button class="btn btn-theme" id="sub" type="submit" ><?if(isset($no)){echo '수정';}else{echo '등록';}?></button>
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

				<!--팝업시작-->
<div class="modal fade" id="myModal_com" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_com" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">거래처를 입력하세요</h4>
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
									<li><a href="#com_code">거래처코드</a></li>
									<li><a href="#com_name">거래처명</a></li>
									<li><a href="#com_m">대표자명</a></li>
								</ul>
							</div>
							<input type="hidden" name="search_p" value="com_name" id="search_p">
							<input type="text" class="form-control" id="search_t" placeholder="검색어를 입력하세요. . .">
							<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="btn_com">
							<span class="glyphicon glyphicon-search"></span>
							</button>
							</span>
						</div>
					</div>
				</div>
				<div id="popup" >
				</div>
			</div>
		</div>
	</div>
  </div>

					<!--팝업끝-->
					<!--담당자팝업시작-->
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
									<li><a href="#en_name">사원명</a></li>
									<li><a href="#emp_dept">부서명</a></li>
									<li><a href="#emp_job">직급명</a></li>
								</ul>
							</div>
							<input type="hidden" name="search_m" value="en_name" id="search_m">
							<input type="text" class="form-control" id="search_n" placeholder="검색어를 입력하세요. . .">
							<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="btn_mname">
							<span class="glyphicon glyphicon-search"></span>
							</button>
							</span>
						</div>
					</div>
				</div>
				<div id="popup_mname" >
				</div>
			</div>
		</div>
	</div>
  </div>

					<!--팝업끝-->
										<!--매장팝업시작-->
<div class="modal fade" id="myModal_store" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_com" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">매장명을 입력하세요</h4>
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
									<li><a href="#store_code">매장코드</a></li>
									<li><a href="#store_name">매장명</a></li>
									<li><a href="#store_m">매장담당자</a></li>
								</ul>
							</div>
							<input type="hidden" name="search_s" value="store_name" id="search_s">
							<input type="text" class="form-control" id="search_t" placeholder="검색어를 입력하세요. . .">
							<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="btn_store">
							<span class="glyphicon glyphicon-search"></span>
							</button>
							</span>
						</div>
					</div>
				</div>
				<div id="popup_store" >
				</div>
			</div>
		</div>
	</div>
  </div>

					<!--팝업끝-->
															<!--창고팝업시작-->
<div class="modal fade" id="myModal_warehouse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_com" aria-hidden="true">
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
									<li><a href="#ware_code">창고코드</a></li>
									<li><a href="#ware_name">창고명</a></li>
									<li><a href="#ware_m">창고담당자</a></li>
								</ul>
							</div>
							<input type="hidden" name="search_w" value="ware_name" id="search_w">
							<input type="text" class="form-control" id="search_a" placeholder="검색어를 입력하세요. . .">
							<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="btn_warehouse">
							<span class="glyphicon glyphicon-search"></span>
							</button>
							</span>
						</div>
					</div>
				</div>
				<div id="popup_warehouse" >
				</div>
			</div>
		</div>
	</div>
  </div>

					<!--팝업끝-->

	<script>

	<?if(isset($no)){?>var i =<?echo $resCnt;?>-1;
	<?}else{?>
		var i = 0;
	<?}?>
		$('#addItemBtn').click(function() {
			i++;

			var rowItem = '<tr id="myTr['+i+']">';
			rowItem += '<td data-title=""><button id="deleteItemBtn['+i+']" type="button" value="'+i+'" class="btn btn-danger" onclick="deleteLine(this, '+i+')"> - </button></td>'
			rowItem += '<td data-title="상품코드"> <div class="input-group"><input type="text" class="form-control" id="product_code['+i+']" name="product_code[]" value="" required=""></div></td>';
			rowItem += '<td data-title="상품명"> <div class="input-group"><input type="text" class="form-control" id="product_name['+i+']" name="product_name[]" value="" required=""></div></td>';
			rowItem += '<td data-title="공급가"> <input type="number" class="form-control" autocomplete="off" id="sup_price['+i+']" name="sup_price[]" onchange="call()" value="" required=""></td>';
			rowItem += '<td data-title="수량"> <input type="number" class="form-control" autocomplete="off" id="order_cnt['+i+']" name="order_cnt[]" onchange="call()" value="" required=""></td>';
			rowItem += '<td data-title="부가세"> <select class="form-control" id="surtax['+i+']" name="surtax[]" style="font-size:13px;" onchange="call()" value="" required=""><option id="apply['+i+']" value="1">부가세 적용</option><option id="no_apply['+i+']" value="2">부가세 미적용</option></select></td>';
			rowItem += '<td data-title="할인"> <input type="number" class="form-control" autocomplete="off" id="sale['+i+']" name="sale[]" value="0" onchange="call()" value="" required=""></td>';
			rowItem += '<td data-title="총 가격"> <input type="text" class="form-control" id="all_price['+i+']" name="all_price[]" readonly="readonly" value=""></td>';
			$('#order_table > tbody:last').append(rowItem);

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

			$(function() {
			var code = $("#product_code\\["+i+"\\]" ).val();


			$("#product_code\\["+i+"\\]").on("blur", function() {


				$.ajax({
					url:'./api/orderReg/order_onblur.php',
					type:'GET',
					data: {product_code : $("#product_code\\["+i+"\\]" ).val()},
					success:function(data){
						$( "#product_name\\["+i+"\\]" ).val(data);

					}
				})
			});

		});
		})

		<?if(isset($no)){?>
		function deleteLine(obj, num){

					var tr = $(obj).parent().parent();
					tr.hide();

					for(var a=0; a < document.getElementsByName('product_code[]').length; a++)
					{
						if(document.getElementById('deleteItemBtn['+a+']').value == num)
						{
							document.getElementById('product_code['+a+']').removeAttribute("required");
							document.getElementById('product_code['+a+']').removeAttribute("value");

							document.getElementById('product_name['+a+']').removeAttribute("required");
							document.getElementById('product_name['+a+']').removeAttribute("value");

							document.getElementById('sup_price['+a+']').removeAttribute("required");
							document.getElementById('sup_price['+a+']').removeAttribute("value");

							document.getElementById('order_cnt['+a+']').removeAttribute("required");
							document.getElementById('order_cnt['+a+']').removeAttribute("value");

							document.getElementById('surtax['+a+']').removeAttribute("required");
							document.getElementById('surtax['+a+']').removeAttribute("value");

							document.getElementById('apply['+a+']').value = "";
							document.getElementById('no_apply['+a+']').value = "";

							document.getElementById('sale['+a+']').removeAttribute("required");
							document.getElementById('sale['+a+']').removeAttribute("value");


							document.getElementById('all_price['+a+']').removeAttribute("required");
							document.getElementById('all_price['+a+']').removeAttribute("value");
						}
					}
				}
		<?}else{?>
		function deleteLine(obj, num){
						var tr = $(obj).parent().parent();
			tr.hide();

			for(var a=0; a<document.getElementsByName('product_code[]').length; a++)
			{
				if(document.getElementById('deleteItemBtn['+a+']').value == num)
				{
					document.getElementById('product_code['+a+']').removeAttribute("required");
					document.getElementById('product_code['+a+']').removeAttribute("value");

					document.getElementById('product_name['+a+']').removeAttribute("required");
					document.getElementById('product_name['+a+']').value = "";

					document.getElementById('sup_price['+a+']').removeAttribute("required");
					document.getElementById('sup_price['+a+']').value = "";

					document.getElementById('order_cnt['+a+']').removeAttribute("required");
					document.getElementById('order_cnt['+a+']').value = "";

					document.getElementById('surtax['+a+']').removeAttribute("required");
					document.getElementById('surtax['+a+']').value = "";

					document.getElementById('apply['+a+']').value = "";
					document.getElementById('no_apply['+a+']').value = "";

					document.getElementById('sale['+a+']').removeAttribute("required");
					document.getElementById('sale['+a+']').value = "";

					document.getElementById('all_price['+a+']').value = "";
				}
			}


		}

		<?}?>

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

	$(function() {
		var product_name = <?php echo json_encode($product_name_arr); ?>;

		$( "#product_name\\[0\\]" ).autocomplete({
			source: product_name
		});

	});
	$(function() {
		var code = $('#product_code\\[0\\]' ).val();

			$("#ui-id-1").on("click", function() {


				$.ajax({
					url:'./api/orderReg/order_onblur.php',
					type:'GET',
					data: {product_code : $('#product_code\\[0\\]' ).val()},
					success:function(data){
						$( "#product_name\\[0\\]" ).val(data);

					}
				})
			});

		});



	</script>



	<script>
		$("#btn_com").click(function(){
			$.ajax({
				url:'./api/popupReg/popup_company.php',
				type:'GET',
				data:{ search_param: $('#search_p').val(),  search_text : $('#search_t').val()},
				success:function(data){
					$('#popup').html(data);

				}
			})
		});

		$("#btn_mname").click(function(){
			$.ajax({
				url:'./api/popupReg/popup_mname.php',
				type:'GET',
				data:{ search_param: $('#search_m').val(),  search_text : $('#search_n').val()},
				success:function(data){
					$('#popup_mname').html(data);

				}
			})
		});
		$("#btn_store").click(function(){
			$.ajax({
				url:'./api/popupReg/popup_store.php',
				type:'GET',
				data:{ search_param: $('#search_s').val(),  search_text : $('#search_t').val()},
				success:function(data){
					$('#popup_store').html(data);

				}
			})
		});

		$("#btn_warehouse").click(function(){
			$.ajax({
				url:'./api/popupReg/popup_warehouse.php',
				type:'GET',
				data:{ search_param: $('#search_w').val(),  search_text : $('#search_a').val()},
				success:function(data){
					$('#popup_warehouse').html(data);

				}
			})
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
