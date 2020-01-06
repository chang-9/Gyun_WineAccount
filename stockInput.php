<?
  // 입고 조회
  include 'layout/layout.php';
  include 'api/dbconn.php';
  include 'api/stock_access.php';

  $conn = new DBC();
  $conn->DBI();

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
        <h3><a href="stockInput.php"><i class="fa fa-angle-right"></i>입고 조회</a></h3>
		<div class="row mt">
          <div class="col-lg-12" style="">
		          <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">검색필터 </span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#상품코드">제품 코드</a></li>
                      <li><a href="#상품명">제품명</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">
                <input type="text" class="form-control" name="x" placeholder="검색어를 입력하세요. . .">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="searchButton"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
          </div>
          <!-- /col-lg-12 END -->
        </div>

       <!-- /row -->
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

        <form action="./api/stockReg/stockDelete.php" method="post">
          <input type="hidden" name="compare" value="10">
      		<div class="row mt" id="txtHint">
            <div class="col-lg-12" style="">
                <section id="no-more-tables">
                  <table class="table table-bordered table-hover table-striped">
                    <thead class="cf" style='background-color: #BDBDBD'>
                      <tr>
                        <th>선택</th>
                        <th>입고명</th>
                        <th>입고 코드</th>
                        <th>매입 코드</th>
                        <th class="numeric">입고 날짜</th>
                        <th class="numeric">비고</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?
                      $conn = new DBC();
                      $conn->DBI();
                      $query1 = "select * from stock where stock_cate ='입고' ";
                      $conn->DBQ($query1);
                      $conn->DBE();

                      while($row = $conn->DBF())
                      {
                      ?>
                      <tr>
                        <td data-title="선택"><input type="checkbox" id="chk_info[]" name="chk_info[]" value="<?echo $row['stock_code'];?>"></input></td>
                        <td data-title="입고명"><a href="./stockInputD.php?sNo=<?echo $row['stock_code'];?>&iNo=<?echo $row['in_out_code'];?>"><?echo $row['stock_name'];?></a></td>
                        <td data-title="입고 코드"><?if($row['stock_code'] != null){echo $row['stock_code'];}else if($row['stock_code'] == null){echo "/NaN";}?></td>
                        <td data-title="매입 코드"><?if($row['in_out_code'] != null){echo $row['in_out_code'];}else if($row['in_out_code'] == null){echo "/NaN";}?></td>
                        <td class="numeric" data-title="입고 날짜"><?if($row['stock_date'] != null){echo $row['stock_date'];}else if($row['stock_date'] == null){echo "/NaN";}?></td>
                        <td class="numeric" data-title="비고"><?php if($row['memo'] != null){echo $row['memo'];}else if($row['memo'] == null){echo "/NaN";}?></td>
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
          <div class="col-lg-12">
            <a href="stockInputChoice.php">
              <button type="button" class="btn btn-default">신규</button></a>
              <button type="submit" class="btn btn-default">삭제</button></a>
          </div>
        </div>
    </form>

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
		    url: 'api/stockReg/stockS.php',
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
?>
