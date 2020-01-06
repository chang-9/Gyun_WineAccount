<?
//입금 선택
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';
  include 'api/in_out_access.php';

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
    <section id="main-content">
    <section class="wrapper">
        <div class="row mt">
          <div class="col-lg-6">
            <div class="grey-panel mt">
							<a href="stockOutputNew.php">
	              <div class="panel-body">
	                <br><br><br><br><br><br><br>
	                <address>
	                  <!-- <strong>Admin Theme, Inc.</strong><br>
	                  795 Asome Ave, Suite 850<br>
	                  New York, 94447<br>
	                  <abbr title="Phone">P:</abbr> (123) 456-7890 -->
	                  <i class="fa fa-bell"></i><br><br>
	                  매출과 연동되지 않는, 기타 출고사항을 추가할 때는<br>
	                </address>
	                  <strong><h1>Click Here</h1></strong>
	                <br><br><br><br><br><br><br>
	              </div>
							</a>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="white-panel mt">
              <a href="#" data-toggle="modal" data-target="#Modal_sale">
                <div class="panel-body">
                  <br><br><br><br><br><br><br>
                  <address>
                    <i class="fa fa-bell-o"></i><br><br>
                    매출과 연동되는 출고사항을 추가할 때는<br>
                  </address>
                    <strong><h1>Click Here</h1></strong>
                  <br><br><br><br><br><br><br>
                </div>
              </a>
            </div>
          </div>
        </div>
        <!-- /row -->

        <!-- pop-up -->
    		<div class="modal fade" id="Modal_sale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    			<div class="modal-dialog">
    				<div class="modal-content">
    					<div class="modal-header">
    						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    						<h4 class="modal-title" id="myModalLabel">매출서를 선택해주세요.</h4>
    					</div>

    					<div class="modal-body">
    						<div class="row mt">
    							<div class="col-lg-12">
    									<section id="no-more-tables">
    										<table class="table table-bordered table-hover table-striped">
    											<thead class="cf" style="background-color: #E6E6E6;">
    												<tr>
    													<th class="numeric"></th>
    													<th class="numeric">매출코드</th>
    													<th class="numeric">거래처명</th>
    													<th class="numeric">담당자명</th>
    													<th class="numeric">일자</th>
    													<th class="numeric">비고</th>
    												</tr>
    											</thead>

    											<?
    											$sql = "select * from wine_in_out where in_out_cate = '매출' and stock_cur = '0'";
    											$conn->DBQ($sql);
    											$conn->DBE();

    											while($row = $conn->DBF()) {
    											?>
    											<tbody>
    												<tr>
    													<td data-title="선택"><a href="stockOutputNew2.php?bNo=<?echo $row['idx'];?>"><button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></button></a></td>
    													<td data-title="매출코드"><?echo $row['in_out_code'];?></td>
    													<td data-title="거래처명"><?echo $row['com_name'];?></td>
    													<td data-title="담당자명"><?echo $row['m_name'];?></td>
    													<td data-title="일자"><?echo $row['input_date'];?></td>
    													<td data-title="비고"><?echo $row['memo'];?></td>
    												</tr>
    											<? } ?>
    											</tbody>
    										</table>
    									</section>
    							</div>
    						</div>
    					</div>

    					<div class="modal-footer">
    						<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
    					</div>
    				</div>
    			</div>
    		</div>
    		<!-- /pop-up -->

      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
	<?$layout->JsFile("
  <link rel='stylesheet' href='lib/xchart/xcharts.css'>

  ");?>
  <?$layout->js($js);?>

  <script>
  </script>

</body>

</html>
