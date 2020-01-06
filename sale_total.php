<?
//매출 현황 . php
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';
	include 'api/sell_access.php';

//검색시작

if($_GET['date_from'] != null && $_GET['date_to'] != null && $_GET['od_ware'] && $_GET['od_com'] && $_GET['od_prod']!= null){
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
		$od_ware = $_GET['od_ware'];
		$od_com = $_GET['od_com'];
		$od_prod = $_GET['od_prod'];
		$sCase = 1; // 날짜 + 창고 + 거래처 + 제품
	}
	else if($_GET['date_from'] != null && $_GET['date_to'] != null){
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
		$sCase = 2; // 날짜
	}
	else if($_GET['od_ware'] != null){
		$od_ware = $_GET['od_ware'];
		$sCase = 3; // 창고
	}
	else if($_GET['od_com'] != null){
	    $od_com = $_GET['od_com'];
	    $sCase = 4; // 거래처
	}
	else if($_GET['od_prod'] != null){
		$od_prod = $_GET['od_prod'];
		$sCase = 5; // 제품
	}
	else if($_GET['date_from'] != null && $_GET['date_to'] != null && $_GET['od_ware'] != null){
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
		$od_ware = $_GET['od_ware'];
		$sCase = 6; // 날짜 + 창고
	}
	else if($_GET['date_from'] != null && $_GET['date_to'] != null && $_GET['od_com'] != null){
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
		$od_com = $_GET['od_com'];
		$sCase = 7; // 날짜 + 거래처
	}
	else if($_GET['date_from'] != null && $_GET['date_to'] != null && $_GET['od_prod'] != null){
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
		$od_prod = $_GET['od_prod'];
		$sCase = 8; // 날짜 + 제품
	}
	else if($_GET['od_ware'] != null && $_GET['od_com'] != null){
		$od_ware = $_GET['od_ware'];
		$od_com = $_GET['od_com'];
		$sCase = 9; // 창고  + 거래처
	}
	else if($_GET['od_ware'] != null && $_GET['od_prod'] != null){
		$od_ware = $_GET['od_ware'];
		$od_prod = $_GET['od_prod'];
		$sCase = 10; // 창고  + 제품
	}
	else if($_GET['od_com'] != null && $_GET['od_prod'] != null){
		$od_com = $_GET['od_com'];
		$od_prod = $_GET['od_prod'];
		$sCase = 11; // 거래처  + 제품
	}



	switch($sCase)
	{
	// 날짜 + 창고 + 거래처 + 제품
	case 1:
		$searchSql = ' where  order_date >= "' .$date_from. '" and order_date <= "' .$date_to. '" and ware_code like "%' .$od_ware. '%"
	 	and com_name like "%' .$od_com. '%" and product_code like "%' .$od_prod. '%"';
        break;

	//날짜
	case 2:
		$searchSql = ' where order_date >= "' .$date_from. '" and order_date <= "' .$date_to. '"';
		break;

	//창고
	case 3:
		$searchSql = ' where ware_code like "%' .$od_ware. '%"';
		break;

	//거래처
	case 4:
		$searchSql = ' where com_name like "%' .$od_com. '%"';
		break;

	//제품
	case 5:
		$searchSql = ' where product_code like "%' .$od_prod. '%"';
		break;

	//날짜 + 창고
	case 6:
		$searchSql = ' where order_date >= "' .$date_from. '" and order_date <= "' .$date_to. '" and ware_code like"%' .$od_ware. '%"';
		break;

	//날짜 + 거래처
	case 7:
		$searchSql = ' where order_date >= "' .$date_from. '" and order_date <= "' .$date_to. '" and com_name like"%' .$od_com. '%"';
		break;

	//날짜 + 제품
	case 8:
		$searchSql = ' where order_date >= "' .$date_from. '" and order_date <= "' .$date_to. '" and product_code like"%' .$od_prod. '%"';
		break;

	// 창고 + 거래처
	case 9:
		$searchSql = ' where ware_code like "%' .$od_ware. '%" and com_name like "%' .$od_com. '%"';
		break;

	// 창고 + 제품
	case 10:
		$searchSql = ' where ware_code like "%' .$od_ware. '%" and product_code like "%' .$od_prod. '%"';
		break;

	// 거래처 + 제품
	case 11:
		$searchSql = ' where com_name like "%' .$od_com. '%" and product_code like "%' .$od_prod. '%"';
		break;


   }


//검색 끝

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$query = "SELECT count(*) FROM in_out_detail INNER JOIN wine_in_out ON in_out_detail.in_out_code = wine_in_out.in_out_code WHERE wine_in_out.in_out_cate = '매출'".$searchSql;
	$conn->DBQ($query);
	$conn->DBE(); //쿼리 실행
	$cnt = $conn->DBF();

	$total_row = $cnt['count(*)'];		// db에 저장된 게시물의 레코드 총 갯수 값. 현재 값은 테스트를 위한 값
	$list = 10;							// 화면에 보여지 게시물 갯수
	$block = 8;							// 화면에 보여질 블럭 단위 값[1]~[5]
	$page = new paging($_GET['page'], $list, $block, $total_row);

	if(isset($searchColumn) && isset($searchText)){
		// get값으로 가지고 다닐 변수가 있을시.
		$page->setUrl("search_param=".$searchColumn."&search_text=".$searchText);
	}

	$limit = $page->getVar("limit");	// 가져올 레코드의 시작점을 구하기 위해 값을 가져온다. 내부로직에 의해 계산된 값

   $page->setDisplay("prev_btn", "<"); // [이전]버튼을 [prev] text로 변경
   $page->setDisplay("next_btn", ">"); // 이와 같이 버튼을 이미지로 바꿀수 있음
   $page->setDisplay("end_btn", ">>");
   $page->setDisplay("start_btn", "<<");
   $page->setDisplay("class","page-item");

	$query ="SELECT * FROM in_out_detail INNER JOIN wine_in_out ON in_out_detail.in_out_code = wine_in_out.in_out_code WHERE wine_in_out.in_out_cate = '매출'".$searchSql." ORDER BY in_out_detail.idx DESC LIMIT $limit, $list"; //변수에 쿼리 저장
	$conn->DBQ($query);
	$conn->DBE(); //쿼리 실행

	$result = $conn->resultRow();

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
	<section id="main-content" style="min-height:1000px;">
		<section class="wrapper">
			<h3><i class="fa fa-angle-right"></i>매출 현황</h3>
			<div class="row mt">
				<div class="col-lg-12">
					 <div class="form-panel">
						<div class=" form">
							<form class="cmxform form-horizontal style-form" id="commentForm" method="get" action="<?=$_SERVER['PHP_SELF']?>">
									 <div class="form-group ">
										<label for="cname" class="control-label col-lg-2">날짜</label>
										<div class="col-lg-10">
										 <div class="input-group input-large" data-date="2014/01/01" data-date-format="yyyy/mm/dd">
											<input type="text" id="datepicker" class="form-control dpd1" name="from" name="in_out_date">
											<span class="input-group-addon"> ~ </span>
											<input type="text" id="datepicker1" class="form-control dpd2" name="to" name= "in_out_Date">
										 </div>
									 </div>
								</div>
								<div class="form-group ">
									<div class="fa-hover col-md-2 col-sm-3">
										<a href="#"  data-toggle="modal" data-target="#myModal_deposit"><i class="fa fa-search" name= "deposit_name"></i> 창고 </a>
										<!--팝업시작-->
										<div class="modal fade" id="myModal_deposit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel">창고를 선택해주세요.</h4>
													</div>
													<div class="modal-body">
														창고 테이블 넣어주세요.
														</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
													</div>
												</div>
											</div>
										</div>
										<!--팝업끝-->
									</div>
									<div class="col-lg-10">
										<input class="form-control " id="cemail" type="text" name="email" required="">
									</div>
								</div>
								<div class="form-group ">
									<div class="fa-hover col-md-2 col-sm-3">
										<a href="#"  data-toggle="modal" data-target="#myModal_com"><i class="fa fa-search" name= "com_name"></i> 거래처명 </a>
										<!--팝업시작-->
										<div class="modal fade" id="myModal_com" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_com" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel">거래처명을 선택해주세요.</h4>
													</div>
													<div class="modal-body">
														거래처 테이블 넣어주세요.
														</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
													</div>
												</div>
											</div>
										</div>
										<!--팝업끝-->
									</div>
									<div class="col-lg-10">
										<input class="form-control " id="curl" type="url" name="url">
									</div>
								</div>
								<div class="form-group ">
									<div class="fa-hover col-md-2 col-sm-3">
										<a href="#"  data-toggle="modal" data-target="#myModal_pro"><i class="fa fa-search" name= "pro_name"></i> 상품명 </a>
										<!--팝업시작-->
										<div class="modal fade" id="myModal_pro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_pro" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel1">상품명을 선택해주세요. </h4>
													</div>
													<div class="modal-body">
														상품 테이블 넣어주세요.
														</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
													</div>
												</div>
											</div>
										</div>
										<!--팝업끝-->
									</div>
									<div class="col-lg-10">
										<input class="form-control " id="curl" type="url" name="url">
									</div>
								</div>
								<div class="row" style="text-align:right">
									<div class="col-lg-12" style="">
									   <button type="submit" id="addItemBtn" class="btn btn-primary submit mb-6">검색</button>
									</div>
								</div>
							 </div>
						</form>
						<!-- /form-panel -->
					</div>
				</div>
			<!-- /col-lg-12 -->
			</div>
			<div class="row mt">
			  <div class="col-lg-12" style="">
				<button type="button" class="btn btn-default">PDF</button>
				<button type="button" class="btn btn-default" onclick="ExportToExcel()">Excel</button>
				<button type="button" class="btn btn-default" onclick="content_print()">Print</button>
			  </div>
					<!-- /col-lg-12 END -->
			</div>

			<form action="api/orderReg/order_delete.php" method="get">
		<!-- /row -->
				<div class="row mt" id="txtHint">
					<div class="col-lg-12" style="">
				<!--<div class="content-panel">-->
				<!--<h4><i class="fa fa-angle-right"></i> No More Table</h4>-->
						<section id="no-more-tables">
							<table class="table table-bordered table-hover table-striped">
								<thead class="cf" style='background-color: #BDBDBD'>
									<tr>
									  <th>선택</th>
									  <th>매출코드</th>
									  <th>주문코드</th>
									  <th>상품코드</th>
									  <th class="numeric">상품명</th>
									  <th class="numeric">출고수량</th>
									  <th class="numeric">단가</th>
									  <th class="numeric">공급가</th>
									  <th class="numeric">부가세</th>
									  <th class="numeric">할인</th>
									  <th class="numeric">총가격</th>
									</tr>
								</thead>
								<tbody>
									  <?while($row = $conn->DBF()){?>
									<tr>
									  <td data-title="선택"><input type="checkbox" name="chk_info[]" value="<?echo $row ['idx'];?>"></td>
									  <td data-title="매출 코드"><a href="#"><?echo $row['in_out_code'];?></a></td>
									  <td data-title="주문 코드"><a href="#"><?echo $row['order_code'];?></a></td>
									  <td data-title="상품 코드"><a href="#"><?echo $row['product_code'];?></a></td>
									  <td class="numeric" data-title="상품명"><?echo $row['product_name'];?></td>
									  <td class="numeric" data-title="출고수량"><?echo $row['in_out_cnt'];?><? echo "EA"?></td>
									  <td class="numeric" data-title="단가"><?echo $row['unit_price'];?><? echo "원"?></td>
									  <td class="numeric" data-title="공급가"><?echo $row['sup_price'];?><? echo "원"?></td>
									  <td class="numeric" data-title="부가세"><?echo $row['surtax'];?></td>
									  <td class="numeric" data-title="할인"><?echo $row['sale'];?><? echo "원"?></td>
									  <td class="numeric" data-title="총가격"><?echo $row['all_price'];?><? echo "원"?></td>
									</tr>
									<?}?>
								</tbody>
							</table>
						<!--<div style="text-align:center">not result</div>-->
						</section>
					</div>
				<!-- /col-lg-12 END -->
				</div>
			</form>

		<!-- /row -->
			<??>
		</section>
	</section>
	<!--main content end-->
	<?$layout->
		footer($footer);?> </section>
	<?$layout->
		JsFile("
<script>
		$(document).ready(function(e){
			$('.search-panel .dropdown-menu').find('a').click(function(e) {
				e.preventDefault();
				var param = $(this).attr('href').replace('#','');
				var concept = $(this).text();
				$('.search-panel span#search_concept').text(concept);
				$('.input-group #search_param').val(param);
			});
		});

	function content_print(){
		var initBody = document.body.innerHTML;
		window.onbeforeprint = function(){
			document.body.innerHTML = document.getElementById('print').innerHTML;
		}
		window.onafterprint = function(){
		document.body.innerHTML = initBody;
		}
		window.print();
	}
	function ExportToExcel(){
       var htmltable= document.getElementById('print');
       var html = htmltable.outerHTML;
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }
</script>
		");?> <?$layout->
	js($js);?>
	</body>
</html>
<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
