<?
//거래처 관리
	include 'layout/layout.php';
	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">

');?>
<?$layout->head($head);?>
<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i><a href="<?=$_SERVER['PHP_SELF']?>">차트시발</a></h3>	 
		<div class="row mt">

            <div class="col-lg-12">
              <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Chart Example 1</h4>
                <div class="panel-body">
                  <div id="hero-graph" class="graph"></div>
                </div>
              </div>
            </div>        
		
		</div>
		<!--
		  <h3><i class="fa fa-angle-right"></i>재고 수불부 </h3>
				<div class="row mt">
					<div class="col-lg-4">
            <h4> 제품명 : (  <?echo $row['product_code'];?>  )</h4>
					</div>
				</div>
					<!-- col-lg-4 -->

        <!-- row -->



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

						 </div>
						 <!-- col-lg-8 end -->
					 </div>
					 <!-- row end -->
				 </div>
				 <!-- morris end -->
			<div id="printArea">
        <div class="row mt">
          <div class="col-lg-12">
            <table class="table table-bordered table-hover table-striped">
              <thead class="cf" style='background-color: #BDBDBD'>
                <tr>
                  <th class="numeric">날짜</th>
                  <th class="numeric">구분</th>
                  <th class="numeric">거래처</th>
                  <th class="numeric">창고</th>
                  <th class="numeric">입/출고단가</th>
                  <th class="numeric">입고 수량</th>
                  <th class="numeric">출고 수량</th>
                  <th class="numeric">재고 수량</th>
                  <th class="numeric">합계 금액</th>
                  <th class="numeric">비고</th>
                </tr>

                <tbody>
                  <tr>
                    <td class="numeric" data-title="날짜"></td>
                    <td class="numeric" data-title="구분"></td>
                    <td class="numeric" data-title="거래처"></td>
                    <td class="numeric" data-title="창고"></td>
                    <td class="numeric" data-title="입/출고단가"></td>
                    <td class="numeric" data-title="입고 수량"></td>
                    <td class="numeric" data-title="출고 수량"></td>
                    <td class="numeric" data-title="재고 수량"></td>
                    <td class="numeric" data-title="합계 금액"></td>
                    <td class="numeric" data-title="비고"></td>
                  </tr>
                </tbody>

                <tfoot>
                  <tr>
                    <td colspan="5" style="text-align:center;">합계</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!--/col-lg-12 -->
          </div>
					<!-- /row -->
				</div>

        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <?$layout->JsFile('
  <script src="lib/morris/morris.min.js"></script>
  <script src="lib/morris-conf.js"></script>
  <script src="lib/raphael/raphael.min.js"></script>  
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  ');?>
  <?$layout->js($js);?>
</body>

</html>

<?
/*
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/raphael/raphael.min.js"></script>
  <script src="lib/morris/morris.min.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script src="lib/morris-conf.js"></script>
*/
?>