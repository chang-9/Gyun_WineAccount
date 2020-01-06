<?
//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$query = "SELECT count(*) FROM wine_in_out WHERE in_out_cate = 1"; // 추후 수정
	$conn->DBQ($query);
	$conn->DBE(); //쿼리 실행
	$cnt = $conn->DBF();

	$total_row = $cnt['count(*)'];		// db에 저장된 게시물의 레코드 총 갯수 값. 현재 값은 테스트를 위한 값
	$list = 7;							// 화면에 보여지 게시물 갯수
	$block = 8;							// 화면에 보여질 블럭 단위 값[1]~[5]
	$page = new paging($_GET['page'], $list, $block, $total_row);
	$page->setUrl("content=forum");		// get값으로 가지고 다닐 변수가 있을시.
	$limit = $page->getVar("limit");	// 가져올 레코드의 시작점을 구하기 위해 값을 가져온다. 내부로직에 의해 계산된 값

	$page->setDisplay("prev_btn", "[이전]"); // [이전]버튼을 [prev] text로 변경
	$page->setDisplay("next_btn", "[다음]"); // 이와 같이 버튼을 이미지로 바꿀수 있음
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
        <h3><i class="fa fa-angle-right"></i>입금 조회</h3>


				<div class="row mt">
					<div class="col-lg-12">

						<div class="form-panel">
							<div class=" form">
								<form class="cmxform form-horizontal style-form" id="commentForm" method="get" action="./depositSearch.php">
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
											<a href="font_awesome.html#search"><i class="fa fa-search"></i> 제품명 </a>
										</div>
										<div class="col-lg-10">
											<input class="form-control" type="text" id="de_prod" name="de_prod">
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

		<form action="./api/depositReg/depositDelete.php" method="get">

		<div class="row mt">
          <div class="col-lg-12" style="">
						<input type="button" class="btn btn-default" onclick="" value="PDF"></input>
						<input type="button" class="btn btn-default" onclick="" value="Excel"></input>
						<input type="button" class="btn btn-default" onclick="print(document.getElementById('printArea').innerHTML)"
						value="Print"></input>
		  </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->

		<div class="row mt" id="txtHint">
          <div class="col-lg-12" style="">
            <section id="no-more-tables">
			  			<table class="table table-bordered table-hover table-striped">
                <thead class="cf" style='background-color: #BDBDBD'>
                  <tr>
				            <th>선택</th>
                    <th>입금번호</th>
                    <th>거래처</th>
                    <th class="numeric">제품 코드</th>
                    <th class="numeric">제품명</th>
										<th class="numeric">금액</th>
										<th class="numeric">날짜</th>
                    <th class="numeric">비고</th>
                  </tr>
                </thead>

                <?
                $query2 ="SELECT * FROM wine_in_out ORDER BY idx DESC LIMIT $limit, $list"; //변수에 쿼리 저장
                $conn->DBQ($query2);
                $conn->DBE(); //쿼리 실행

                while($row = $conn->DBF()) {
                ?>
                <tbody>
                  <tr>
										<td data-title="선택">
												<input type="checkbox" id="chk_info[]" name="chk_info[]" value="<?echo $row['idx'];?>"></input>
										</td>
                      <td data-title="입금번호"><a href="./depositDetail.php?dNo=<?echo $row['in_out_code']?>"></a></td>
                      <td class="numeric" data-title="거래처"></td>
                      <td class="numeric" data-title="제품 코드"></td>
                      <td class="numeric" data-title="제품명"></td>
											<td class="numeric" data-title="금액"></td>
											<td class="numeric" data-title="날짜"></td> <!--해당 금액이 입금된 날짜. 버튼 누를때 date로-->
                      <td class="numeric" data-title="비고"></td>
                  </tr>
                <? } ?>
                </tbody>
              </table>
            </section>
          </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->

		<div class="row" style="text-align:right">
      <div class="col-lg-12" style="">
        <a href="depositNew.php">
		        <button type="button" class="btn btn-default">신규</button>
					</a>
  		    <button type="submit" class="btn btn-default">삭제</button>
		  </div>
		</div>
	</form>
        <!-- /row -->

		<div class="row" style="text-align:center">
          <div class="col-lg-12" style="">
			<!--<ul class="pagination">
			  <li class="page-item">
				<a class="page-link" href="#" aria-label="Previous">
			      <span aria-hidden="true">&laquo;</span>
				  <span class="sr-only">Previous</span>
			    </a>
			  </li>
			  <li class="page-item"><a class="page-link" href="#">1</a></li>
			  <li class="page-item"><a class="page-link" href="#">2</a></li>
			  <li class="page-item"><a class="page-link" href="#">3</a></li>
			  <li class="page-item"><a class="page-link" href="#">4</a></li>
			  <li class="page-item"><a class="page-link" href="#">5</a></li>
			  <li class="page-item"><a class="page-link" href="#">6</a></li>
			  <li class="page-item"><a class="page-link" href="#">7</a></li>
			  <li class="page-item">
			    <a class="page-link" href="#" aria-label="Next">
				  <span aria-hidden="true">&raquo;</span>
				  <span class="sr-only">Next</span>
			    </a>
		      </li>
		    </ul>-->
			<ul class="pagination">
			<?echo $paging;//하단 페이징 화면 출력?>
			</ul>
          </div>
		</div>
        <!-- /row -->

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

		$( '#searchButton' ).click(function() {
		  value = $('input[name=x]').val();
		  $.ajax({
		    type: 'POST',
		    url: 'api/moneyReg/depositS.php',
		    data:{
			    category: param,
                searchT: value
		    },
		    //async: false,
		    success: function(result){
			    document.getElementById('txtHint').innerHTML = result;
		    },
		    error: function(result){
			    alert('접속이 원할하지 않습니다.');
		    }
		  });
		});
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
