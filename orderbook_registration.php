<?
//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/popuppaging.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	//페이징


	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://dinbror.dk/bpopup/assets/jquery.bpopup-0.11.0.min.js"></script>
<script src="http://dinbror.dk/bpopup/assets/scripting.min.js"></script>
');?>
<?$layout->head($head);?>
<script>

</script>

<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
        <h3><a href="order_registration.php"><i class="fa fa-angle-right"></i>발주 등록</a></h3>
			<form action="./api/orderReg/order_insert.php" class="form-horizontal style-form" method="post" name="order_form" id="order_form">
				 <input type="hidden" name="order_code" value="<?echo date("Y-m-d H:i:s");?>">
				 <input type="hidden" name="com_code" value="34875">
				 <input type="hidden" name="order_state" value="0">
				 <input type="hidden" name="order_cate" value="발주">
				 <input type="hidden" name="order_flag" value="1">
						<div class="row mt">
		  <div class="col-lg-6" style="">
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">


				<div class="form-group">
                    <div class="control-label col-lg-2">
						<a href="#"  data-toggle="modal" data-target="#myModal_com"><font color="red"><i class="fa fa-search"></i>거래처명</font></a>
						<!--팝업시작-->

						<!--팝업끝-->
					</div>
                    <div class="col-lg-10">
                      <input class=" form-control" id="com_name" name="com_name" minlength="2" type="text" required >
                    </div>
				</div>


			  </div>
			</div>
		  </div>
          <!-- /col-lg-6 END -->



          </div>
          <!-- /col-lg-6 END -->

        </div>
			<!-- /col-lg-12 -->
		</div>
				<!-- /row-mt -->


				</form>
	    </section>
		</section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
	<?$layout->JsFile("
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
												<li><a href="#m_name">대표자명</a></li>
												<li><a href="#com_num">휴대폰 번호</a></li>
											</ul>
										</div>
										<input type="hidden" name="search_p" value="m_name" id="search_p">
										<input type="text" class="form-control" id="search_t" placeholder="검색어를 입력하세요. . .">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button" id="sub">
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

	<script>
		$("#sub").click(function(){
			$.ajax({
				url:'./api/popup_page.php',
				type:'GET',
				data:{ search_param: $('#search_p').val(),  search_text : $('#search_t').val()},
				success:function(data){
					$('#popup').html(data);

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
