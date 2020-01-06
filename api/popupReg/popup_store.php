<?
//거래처 관리
	include '../dbconn.php';
	include './popuppaging.php';

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

	$query = "SELECT count(*) FROM wine_store ".$searchSql;
	$conn->DBQ($query);	
	$conn->DBE(); //쿼리 실행
	$cnt = $conn->DBF();

	$total_row = $cnt['count(*)'];		// db에 저장된 게시물의 레코드 총 갯수 값. 현재 값은 테스트를 위한 값
	$list = 10;							// 화면에 보여지 게시물 갯수
	$block = 8;							// 화면에 보여질 블럭 단위 값[1]~[5]
	$page = new paging($_GET['page'], $list, $block, $total_row);


	$limit = $page->getVar("limit");	// 가져올 레코드의 시작점을 구하기 위해 값을 가져온다. 내부로직에 의해 계산된 값

	$page->setDisplay("prev_btn", "<"); // [이전]버튼을 [prev] text로 변경
	$page->setDisplay("next_btn", ">"); // 이와 같이 버튼을 이미지로 바꿀수 있음
	$page->setDisplay("end_btn", ">>"); 
	$page->setDisplay("start_btn", "<<"); 
	$page->setDisplay("class","page-item");
	$page->setDisplay("full");
	$paging = $page->showPage();


	$query ="SELECT * FROM wine_store ".$searchSql." ORDER BY idx DESC LIMIT $limit, $list "; //변수에 쿼리 저장
	$conn->DBQ($query);	
	$conn->DBE(); //쿼리 실행
	
	$result = $conn->resultRow();

	
?>
<!DOCTYPE html>
<html lang="kr">
<body>
 <form action="<?=$_SERVER['PHP_SELF']?>" method="get">		      
		<div class="row mt">
          <div class="col-lg-12" style="" id="print"> 
            <section id="no-more-tables">
			  <table class="table table-bordered table-hover table-striped">
                <thead class="cf" style='background-color: #BDBDBD'>
                  <tr>
					  
					 
					  <th class="numeric">매장코드</th>
					  <th class="numeric">매장명</th>
					  <th class="numeric">매니저</th>
					  <th class="numeric">주소</th>
					  <th class="numeric">휴대폰번호</th>
					  <th class="numeric">비고</th>
                  </tr>
                </thead>
                <tbody>
				  <?if($result!= 0){while($row = $conn->DBF()){?>
                    <tr>
					  <input type = "hidden" id="store" value ="<?echo $row['store_name'];?>">
					  <td data-title="발주 코드"><a class ="dd" data-dismiss="modal" aria-hidden="true"><?echo $row['store_code'];?></a></td>
					  <td class="numeric" data-title="거래처이름"><?echo $row['store_name'];?></td>
					  <td class="numeric" data-title="거래처이름"><?echo $row['store_m'];?></td>
					  <td class="numeric" data-title="분류"><?echo $row['store_address'];?></td>
					  <td class="numeric" data-title="담당자명"><?echo $row['store_phone'];?></td>
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
		<div class="row" style="text-align:center">
          <div class="col-lg-12" style=""> 
			<ul class="pagination">
			<?echo $paging;//하단 페이징 화면 출력?> 
			</ul>
          </div>
		</div>
        <!-- /row -->
		</form>



		<script>
		$(".dd").click(function(){
			$.ajax({
				url:'./orderbook_form.php',
				type:'GET',
				data:{ },
				success:function(data){

				$("#store_name").val($("#store").val());
				

				}
			})
		});
		</script>
</body>

</html> 