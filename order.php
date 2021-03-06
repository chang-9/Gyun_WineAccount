<?
//거래처 관리
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';
	//include 'api/buy_access.php';

//검색시작

//검색 끝

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

		if(isset($_GET['search_param'])) {
		$searchColumn = $_GET['search_param'];
	}
	if(isset($_GET['search_text'])) {
		$searchText = $_GET['search_text'];
	}

	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
	} else {
		$searchSql = '';
	}

	$query = "SELECT count(*) FROM wine_order ".$searchSql;
	$conn->DBQ($query);
	$conn->DBE(); //쿼리 실행
	$cnt = $conn->DBF();

	$total_row = $cnt['count(*)'];		// db에 저장된 게시물의 레코드 총 갯수 값. 현재 값은 테스트를 위한 값
	$list = 10;							// 화면에 보여지 게시물 갯수
	$block = 8;							// 화면에 보여질 블럭 단위 값[1]~[5]
	$page = new paging($_GET['page'], $list, $block, $total_row);

	if(isset($searchColumn) or isset($searchText)){
      $page->setUrl("search_param=".$searchColumn."&search_text=".$searchText);
   }

   $limit = $page->getVar("limit");   // 가져올 레코드의 시작점을 구하기 위해 값을 가져온다. 내부로직에 의해 계산된 값


	$limit = $page->getVar("limit");	// 가져올 레코드의 시작점을 구하기 위해 값을 가져온다. 내부로직에 의해 계산된 값

	$page->setDisplay("prev_btn", "<"); // [이전]버튼을 [prev] text로 변경
	$page->setDisplay("next_btn", ">"); // 이와 같이 버튼을 이미지로 바꿀수 있음
	$page->setDisplay("end_btn", ">>");
	$page->setDisplay("start_btn", "<<");
	$page->setDisplay("class","page-item");
	$page->setDisplay("full");
	$paging = $page->showPage();

	$query ="SELECT * FROM wine_order ".$searchSql."where order_cate ='주문' ORDER BY idx DESC LIMIT $limit, $list "; //변수에 쿼리 저장
	$conn->DBQ($query);
	$conn->DBE(); //쿼리 실행

	$result = $conn->resultRow();

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">
<script>
   function validate() {
	 if(confirm("삭제 하시겠습니까?")){
         return true;
     }else{
 		 return false;
     }
   }
</script>
');?>
<?$layout->head($head);?>
<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i><a href="<?=$_SERVER['PHP_SELF']?>">주문 조회</a></h3>
		<div class="row mt">
          <div class="col-lg-12" style="">
		    <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
		      <div class="input-group">
			    <div class="input-group-btn search-panel">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span id="search_concept">검색필터</span> <span class="caret"></span>
				  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#order_name">발주서명</a></li>
                    <li><a href="#com_name">거래처명</a></li>
                    <li><a href="#m_name">담당자명</a></li>
                  </ul>
                </div>
                <input type="hidden" name="search_param" value="order_name" id="search_param">
                <input type="text" class="form-control" name="search_text" placeholder="Search term...">
                <span class="input-group-btn">
				  <button class="btn btn-default" type="submit" id="searchButton">
				    <span class="glyphicon glyphicon-search"></span>
				  </button>
                </span>
              </div>
		    </form>
          </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->

		<div class="row mt">
          <div class="col-lg-12" style="">
            <button type="button" class="btn btn-default">PDF</button>
            <button type="button" class="btn btn-default" onclick="ExportToExcel()">Excel</button>
            <button type="button" class="btn btn-default" onclick="content_print()">Print</button>
		  </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->

		<form onsubmit="return validate();" action="./api/orderReg/order_delete.php"
		method="post" name="company_form">
		<input class="form-control" name="type" type="hidden" value="company">
		<div class="row mt">
          <div class="col-lg-12" style="" id="print">
            <section id="no-more-tables">
			  <table class="table table-bordered table-hover table-striped">
                <thead class="cf" style='background-color: #BDBDBD'>
                  <tr>
					  <th>선택</th>
					  <th>발주서명</th>
					  <th class="numeric">분류</th>
					  <th class="numeric">거래처이름</th>
					  <th class="numeric">담당자명</th>
					  <th class="numeric">일자</th>
					  <th class="numeric">납기일자</th>
					  <th class="numeric">상태(종결, 진행중)</th>
					  <th class="numeric">비고</th>
                  </tr>
                </thead>
                <tbody>
				  <?if($result!= 0){while($row = $conn->DBF()){?>
                    <tr>
					  <td data-title="선택"><input type="checkbox" name="chk_info[]" value="<?echo $row['order_code'];?>"></td>
					  <td data-title="발주 코드"><a href="orderbook_form.php?no=<?echo $row ['idx'];?>"><?echo $row['order_name'];?></a></td>
					  <td class="numeric" data-title="분류"><?echo $row['order_cate'];?></td>
					  <td class="numeric" data-title="거래처이름"><?echo $row['com_name'];?></td>
					  <td class="numeric" data-title="담당자명"><?echo $row['m_name'];?></td>
					  <td class="numeric" data-title="입력시간"><?echo $row['input_date'];?></td>
					  <td class="numeric" data-title="예정일자"><?echo $row['due_date'];?></td>
					  <td class="numeric" data-title="상태(종결,진행중)"><?if($row['order_state']!=0){echo "종결";}else{echo "진행중";}?></td>
					  <td class="numeric" data-title="비고"><?echo $row['memo'];?></td>
                    </tr>
				<?}
				}else{$empty = "결과가 없습니다."?>
				<?}?>
                </tbody>
              </table>
			  <?if(isset($empty)){?>
			  <div style="text-align:center;min-height:50px"><?=$empty?></div>
			  <?}?>
            </section>
          </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->
		<div class="row" style="text-align:right">
          <div class="col-lg-12" style="">
		    <button type="button" class="btn btn-default" onclick="location.href='order_insert.php'">신규</button>
		    <button type="submit" class="btn btn-default">삭제</button>
		  </div>
		</div>
        <!-- /row -->
		</form>
		<div class="row" style="text-align:center">
          <div class="col-lg-12" style="">
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
  </script>");?>
  <?$layout->js($js);?>
</body>

</html>
