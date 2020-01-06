<?
	//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';
	include 'api/in_out_access.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$searchSql = ' where de_sp_cate = "입금"';
	//검색
	if($_GET['date_from'] != null && $_GET['date_to'] != null && $_GET['de_com'] && $_GET['de_mana'] != null){
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
		$de_com = $_GET['de_com'];
		$de_mana = $_GET['de_mana'];
		$sCase = 7; // 날짜 + 거래처 + 담당자
	}
	else if($_GET['de_com'] != null && $_GET['de_mana'] != null){
		$de_mana = $_GET['de_mana'];
		$de_com = $_GET['de_com'];
		$sCase = 6; // 거래처  + 담당자
	}
	else if($_GET['date_from'] != null && $_GET['date_to'] != null && $_GET['de_mana'] != null){
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
		$de_mana = $_GET['de_mana'];
		$sCase = 5;; // 날짜 + 담당자
	}
	else if($_GET['date_from'] != null && $_GET['date_to'] != null && $_GET['de_com'] != null){
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
		$de_com = $_GET['de_com'];
		$sCase = 4; // 날짜 + 거래처
	}
	else if($_GET['de_mana'] != null){
		$de_mana = $_GET['de_mana'];
		$sCase = 3; // 담당자
	}
	else if($_GET['de_com'] != null){
		$de_com = $_GET['de_com'];
		$sCase = 2; // 거래처
	}
	else if($_GET['date_from'] != null && $_GET['date_to'] != null){
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
		$sCase = 1; // 날짜
	}

	switch($sCase)
	{
		//날짜
		case 1:
		$searchSql = ' where de_sp_date >= "' .$date_from. '" and de_sp_date <= "' .$date_to. '" and de_sp_cate = "입금"';
		break;

		//거래처
		case 2:
		$searchSql = ' where com_name like "%' .$de_com. '%" and de_sp_cate = "입금"';
		break;

		//담당자
		case 3:
		$searchSql = ' where in_out_m like "%' .$de_mana. '%" and de_sp_cate = "입금"';
		break;

		//날짜 + 거래처
		case 4:
		$searchSql = ' where de_sp_date >= "' .$date_from. '" and de_sp_date <= "' .$date_to. '" and com_name like"%' .$de_com. '%" and de_sp_cate = "입금"';
		break;

		// 날짜 + 담당자
		case 5:
		$searchSql = ' where de_sp_date >= "' .$date_from. '" and de_sp_date <= "' .$date_to. '" and in_out_m like"%' .$de_mana. '%" and de_sp_cate = "입금"';
		break;

		// 거래처 + 담당자
		case 6:
		$searchSql = ' where com_name like "%' .$de_com. '%" and de_sp_cate = "입금" and in_out_m like "%' .$de_mana. '%" and de_sp_cate = "입금"';
		break;

		// 날짜 + 거래처 + 담당자
		case 7:
		$searchSql = ' where de_sp_date >= "' .$date_from. '" and de_sp_date <= "' .$date_to. '" and com_name like "%' .$de_com. '%" and in_out_m like "%' .$de_mana. '%" and de_sp_cate = "입금"';
		break;
	}

	//페이징
	$query = "SELECT count(*) FROM depo_spend ".$searchSql;
	$conn->DBQ($query);
	$conn->DBE(); //쿼리 실행
	$cnt = $conn->DBF();

	$total_row = $cnt['count(*)'];		// db에 저장된 게시물의 레코드 총 갯수 값. 현재 값은 테스트를 위한 값
	$list = 10;							// 화면에 보여지 게시물 갯수
	$block = 8;							// 화면에 보여질 블럭 단위 값[1]~[5]
	$page = new paging($_GET['page'], $list, $block, $total_row);

	if(isset($date_from) or isset($date_to) or isset($de_com) or isset($de_mana)){
		$page->setUrl("date_from=".$date_from."&date_to=".$date_to."&de_com=".$de_com."&de_mana=".$de_mana);
	}

	$limit = $page->getVar("limit");	// 가져올 레코드의 시작점을 구하기 위해 값을 가져온다. 내부로직에 의해 계산된 값

	$page->setDisplay("prev_btn", "<"); // [이전]버튼을 [prev] text로 변경
	$page->setDisplay("next_btn", ">"); // 이와 같이 버튼을 이미지로 바꿀수 있음
	$page->setDisplay("end_btn", ">>");
	$page->setDisplay("start_btn", "<<");
	$page->setDisplay("class","page-item");
	$page->setDisplay("full");
	$paging = $page->showPage();

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
        <h3><a href="deposit.php"><i class="fa fa-angle-right"></i>입금 조회</a></h3>

				<div class="row mt">
					<div class="col-lg-12">

						<div class="form-panel">
							<div class="form">
								<form class="cmxform form-horizontal style-form" id="commentForm" method="get" action="<?=$_SERVER['PHP_SELF']?>">

									<div class="form-group ">
										<label for="cname" class="control-label col-lg-2">날짜</label>
										<div class="col-lg-5">
											<div class="input-group input-large" data-date="2014/01/01" data-date-format="yyyy/mm/dd">
												<input type="text" id="datepicker" class="form-control dpd1" id="date_from" name="date_from" readonly="readonyl">
												<span class="input-group-addon"> ~ </span>
												<input type="text" id="datepicker1" class="form-control dpd2" id="date_to" name="date_to" readonly="readonyl">
											</div>
										</div>
									</div>

									<div class="form-group ">
										<div class="fa-hover col-md-2 col-sm-3">
											<a href="font_awesome.html#search"><i class="fa fa-search"></i> 거래처 </a>
										</div>
										<div class="col-lg-10">
											<input class="form-control" type="text" id="de_com" name="de_com">
										</div>
									</div>

									<div class="form-group ">
										<div class="fa-hover col-md-2 col-sm-3">
											<a href="font_awesome.html#search"><i class="fa fa-search"></i> 담당자 </a>
										</div>
										<div class="col-lg-10">
											<input class="form-control" type="text" id="de_mana" name="de_mana">
										</div>
									</div>

									<div class="row" style="text-align:right">
										<div class="col-lg-12" style="">
										<button type="submit" class="btn btn-default" id="searchButton">검색</button>
										</div>
									</div>
								</form>
							</div>
							<!-- form -->
						</div>
					<!-- /form-panel -->
					</div>
				<!-- /col-lg-12 -->
				</div>
			<!-- /row -->

	  	<form action="./api/despReg/Delete.php" method="post">
				<input type="hidden" name="compare" value="10">
				<div class="row mt">
					<div class="col-lg-12" style="">
						<input type="button" class="btn btn-default" onclick="" value="PDF">
						<button type="button" class="btn btn-default" onclick="ExportToExcel()">Excel</button>
						<button type="button" class="btn btn-default" onclick="content_print()">Print</button>
					</div>
					<!-- /col-lg-12 -->
				</div>
				<!-- /row -->

				<div class="row mt">
					<div class="col-lg-12" style="" id="print">
						<section id="no-more-tables">
							<table class="table table-bordered table-hover table-striped">
								<thead class="cf" style='background-color: #BDBDBD'>
									<tr>
										<th>선택</th>
										<th>입금명</th>
										<th claa="numeric">매출코드</th>
										<th class="numeric">거래처</th>
										<th class="numeric">담당자</th>
										<th class="numeric">매장명</th>
										<th class="numeric">입금 날짜</th>
										<th class="numeric">비고</th>
									</tr>
								</thead>

								<tbody>
								<?
								$query3 = "select * from depo_spend ".$searchSql." order by idx desc LIMIT $limit, $list";
								$conn->DBQ($query3);
								$conn->DBE();

								while($row = $conn->DBF()) {
								?>
								<tr>
									<td data-title="선택"><input type="checkbox" name="chk_info[]" value="<?echo $row['de_sp_code'];?>"></td>
									<td data-title="입금명"><a href="./depositDetail.php?dNo=<?echo $row['de_sp_code'];?>"><?echo $row['de_sp_name'];?></a></td>
									<td class="numeric" data-title="매출코드"><?php if($row['in_out_code'] != null){echo $row['in_out_code'];}else if($row['in_out_code'] == null){echo "/NaN";}?></td>
									<td class="numeric" data-title="거래처"><?php if($row['com_name'] != null){echo $row['com_name'];}else if($row['com_name'] == null){echo "/NaN";}?></td>
									<td class="numeric" data-title="담당자"><?php if($row['in_out_m'] != null){echo $row['in_out_m'];}else if($row['in_out_m'] == null){echo "/NaN";}?></td>
									<td class="numeric" data-title="매장명"><?php if($row['store_name'] != null){echo $row['store_name'];}else if($row['store_name'] == null){echo "/NaN";}?></td>
									<td class="numeric" data-title="입금 날짜"><?php if($row['de_sp_date'] != null){echo $row['de_sp_date'];}else if($row['de_sp_date'] == null){echo "/NaN";}?></td>
									<td class="nuemric" data-title="비고"><?php if($row['memo'] != null){echo $row['memo'];}else if($row['memo'] == null){echo "/NaN";}?></td>
								</tr>
							<? } ?>
							</tbody>
						</table>
					</section>
				</div>
				<!-- /col-lg-12 -->
			</div>
			<!-- /row mt -->

			<div class="row" style="text-align:right">
				<div class="col-lg-12">
					<a href="depositChoice.php">
						<button type="button" class="btn btn-default">신규</button></a>
					<button type="submit" class="btn btn-default">삭제</button>
				</div>
			</div>
		</form>

		<div class="row" style="text-align:center">
			<div class="col-lg-12" style="">
				<ul class="pagination">
					<?echo $paging; ?>
				</ul>
			</div>
		</div>

    </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <?$layout->JsFile("
	<script type='text/javascript' src='lib/bootstrap-datepicker/js/bootstrap-datepicker.js'></script>

  <script>
		var param,concept,value;

		$('.search-panel .dropdown-menu').find('a').click(function() {
			param = $(this).attr('href').replace('#','');
			concept = $(this).text();
			$('.search-panel span#search_concept').text(concept);
			$('.input-group #search_param').val(param);
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

	<script>
		$( function() {
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
