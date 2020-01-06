<?
//고객 상세
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$query = "select from wine_product where idx = '".$pNo."'";
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

	$query ="SELECT * FROM wine_customer ORDER BY idx DESC LIMIT $limit, $list"; //변수에 쿼리 저장
	$conn->DBQ($query);	
	$conn->DBE(); //쿼리 실행
		
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
        <h3><i class="fa fa-angle-right"></i>고객 조회</h3>	 
		<div class="row mt">
          <div class="col-lg-12" style=""> 
		    <div class="input-group">
			  <div class="input-group-btn search-panel">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span id="search_concept">검색필터</span> <span class="caret"></span>
				</button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#번호">휴대폰 번호</a></li>
                  <li><a href="#이름">이름</a></li>
				</ul>
              </div>
              <input type="hidden" name="search_param" value="all" id="search_param">         
              <input type="text" class="form-control" name="x" placeholder="Search term...">
              <span class="input-group-btn">
				<button class="btn btn-default" type="button" id="searchButton">
				  <span class="glyphicon glyphicon-search"></span>
				</button>
              </span>
            </div>
          </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->

		<form action="api/customerReg/customerDelete.php" method="get">
			<div class="row mt">
			  <div class="col-lg-12" style=""> 
				<button type="button" class="btn btn-default">PDF</button>
				<button type="button" class="btn btn-default">Excel</button>
				<button type="button" class="btn btn-default">Print</button>
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
						<th>이름</th>
						<th class="numeric">휴대폰번호</th>
						<th class="numeric">고객이름</th>
						<th class="numeric">고객나이</th>
						<th class="numeric">비고</th>
					  </tr>
					</thead>
					<tbody>
					  <?while($row = $conn->DBF()){?>
						<tr>
						  <td data-title="선택"><input type="checkbox" name="chk_info[]" value="<?echo $row ['idx'];?>"></td>
						  <td data-title="이름"><a href="./api/customerReg/customerDetail.php?pNo=<?echo $row['idx'];?>"> <?echo $row['cust_name'];?></a></td>
						  <td class="numeric" data-title="휴대폰번호"><?echo $row['phone_num'];?></td>
						  <td class="numeric" data-title="고객이름"> <?echo $row['cust_name'];?></td>
						  <td class="numeric" data-title="고객나이"><?echo $row['cust_age'];?></td>
						  <td class="numeric" data-title="비고"></td>
						</tr>
					<?}?>
					</tbody>
				  </table>
				</section>
			  </div>
			  <!-- /col-lg-12 END -->
			</div>
        <!-- /row -->

			<div class="row" style="text-align:right">
			  <div class="col-lg-12" style=""> 
				<button type="button" class="btn btn-default">신규</button>
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
		    url: 'api/basicReg/companyS.php',
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
