<?
//입금 추가
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';
  include 'api/basicReg/dashV.php';
	include 'api/basicReg/dashB.php';

	$sql = "select total_price from depo_spend where de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $depo = $conn->DBP();
  $depoCnt = $conn->resultRow();

  for($i=0; $i<$depoCnt; $i++)
  {
    $de_sum += preg_replace("/[^\d]/","",$depo[$i]['total_price']);
  }

  $sql = "select total_price from depo_spend where de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $spend = $conn->DBP();
  $spendCnt = $conn->resultRow();

  for($i=0; $i<$spendCnt; $i++)
  {
    $sp_sum += preg_replace("/[^\d]/","",$spend[$i]['total_price']);
  }

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
    <section id="main-content" style="min-height:680px">
    <section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">

            <div class="border-head">
              <h3><strong><i class="fa fa-angle-right"></i> 월별 매입/매출 현황</strong> </h3>
            </div>
            <div class="mychart">
              <figure class="demo-xchart" id="chart"></figure>
              <input type="hidden" id="in_01" value="100">
            </div>
          </div>
          <!-- /col-lg-9 main-chart -->

          <div class="col-lg-3 ds">

            <div class="panel terques-chart">
              <div class="panel-body">
                <div class="chart">
                  <div class="centered">
                    <span><strong>이번달 수익</strong></span><br>
                    <h3><strong><?php echo number_format($de_sum); ?> ￦ </strong><h3>
                  </div>
                  <br>
                  <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4"
                  data-data="[<?echo $Dcnt1;?>,<?echo $Dcnt2;?>,<?echo $Dcnt3;?>,<?echo $Dcnt4;?>,<?echo $Dcnt5;?>]"></div>
                </div>
              </div>
            </div>

            <div class="panel terques-chart">
              <div class="panel-body">
                <div class="chart">
                  <div class="centered">
                    <span><strong>이번달 지출</strong></span><br>
                    <h3><strong><?php echo number_format($sp_sum); ?> ￦ </strong></h3>
                  </div>
                  <br>
                  <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4"
                  data-data="[<?echo $Scnt1;?>,<?echo $Scnt2;?>,<?echo $Scnt3;?>,<?echo $Scnt4;?>,<?echo $Scnt5;?>]"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- /col-lg-3 ds -->
        </div>
        <!-- /row -->

				<div class="row mt">

					<div class="col-lg-9">
						<form  action="./api/in_outReg/in_out_delete.php" method="post" name="company_form">
						<div class="border-head">
              <h3><strong><i class="fa fa-angle-right"></i> 거래가 완료된 매출/매입건</strong></h3>
            </div>

						<section id="no-more-tables">
							<table class="table table-bordered table-hover table-striped">
								<thead class="cf" style='background-color: #BDBDBD'>
									<?php
									$sql = "select * from wine_in_out where total_price = de_sp_price and in_out_state = '0'";
									$conn->DBQ($sql);
									$conn->DBE();
									$reCnt = $conn->resultRow();
									if($reCnt > 0)
									{
									?>
									<tr>
										<th>거래명</th>
										<th class="numeric">구분</th>
										<th class="numeirc">담당자명</th>
										<th class="numeric">종결 여부</th>
									</tr>

									<tbody>
										<?php
										while($inout = $conn->DBF()) {
										?>
										<tr>
											<td data-title="거래명"><a href="purchase_form.php?no=<?echo $inout ['idx'];?>"><?php echo $inout['in_out_name']; ?></a></td>
											<td class="nuemric" data-title="구분"><?php echo $inout['in_out_cate']; ?></td>
											<td class="nuemric" data-title="담당자명"><?php echo $inout['m_name']; ?></td>
											<td class="nuemric" data-title="종결 여부"><button type ="submit" name="end_info[]" class ="btn btn-round btn-danger" value="<?echo $inout['in_out_code'];?>">종결</button></td>
										</tr>
										<?}} else if($reCnt == 0) { echo "해당 내역이 없습니다."; }?>
									</tbody>
								</form>
								</thead>
							</table>
						</section>
					</div>
				</div>
				<!-- /row mt -->

      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
	<?$layout->JsFile("
  <link rel='stylesheet' href='lib/xchart/xcharts.css'>
  <script src='lib/sparkline-chart.js'></script>
  <script src='lib/morris-conf.js'></script>
  <script src='lib/xchart/d3.v3.min.js'></script>
  <script src='lib/xchart/xcharts.min.js'></script>
  ");?>
  <?$layout->js($js);?>
  <script>
    (function() {
      var data = [{
        "xScale": "ordinal",
        "comp": [],
        "main": [{

					//그래프 파란선
          "className": ".main.l1",
          "data": [{
            "y": '<?= $inCnt1; ?>',
            "x": "2012-02-19T00:00:00"
          }, {
            "y": '<?= $inCnt2; ?>',
            "x": "2012-04-20T00:00:00"
          }, {
            "y": '<?= $inCnt3; ?>',
            "x": "2012-06-21T00:00:00"
          }, {
            "y": '<?= $inCnt4; ?>',
            "x": "2012-08-22T00:00:00"
          }, {
            "y": '<?= $inCnt5; ?>',
            "x": "2012-10-23T00:00:00"
          }, {
            "y": '<?= $inCnt6; ?>',
            "x": "2012-12-25T00:00:00"
          }]
        }, {

					//그래프 빨간선
          "className": ".main.l2",
          "data": [{
            "y": '<?= $outCnt1; ?>',
            "x": "2012-02-19T00:00:00"
          }, {
            "y": '<?= $outCnt2; ?>',
            "x": "2012-04-20T00:00:00"
          }, {
            "y": '<?= $outCnt3; ?>',
            "x": "2012-06-21T00:00:00"
          }, {
            "y": '<?= $outCnt4; ?>',
            "x": "2012-08-22T00:00:00"
          }, {
            "y": '<?= $outCnt5; ?>',
            "x": "2012-10-23T00:00:00"
          }, {
            "y": '<?= $outCnt6; ?>',
            "x": "2012-12-25T00:00:00"
          }]
        }],
        "type": "line-dotted",
        "yScale": "linear"
      }, {


        "xScale": "ordinal",
        "comp": [],
        "main": [{
          "className": ".main.l1",
          "data": [{
            "y": 12,
            "x": "2012-02-19T00:00:00"
          }, {
            "y": 18,
            "x": "2012-04-20T00:00:00"
          }, {
            "y": 8,
            "x": "2012-06-21T00:00:00"
          }, {
            "y": 7,
            "x": "2012-08-22T00:00:00"
          }, {
            "y": 6,
            "x": "2012-10-23T00:00:00"
          }, {
            "y": 8,
            "x": "2012-12-25T00:00:00"
          }]
        }, {
          "className": ".main.l2",
          "data": [{
            "y": 29,
            "x": "2012-02-19T00:00:00"
          }, {
            "y": 33,
            "x": "2012-04-20T00:00:00"
          }, {
            "y": 13,
            "x": "2012-06-21T00:00:00"
          }, {
            "y": 16,
            "x": "2012-08-22T00:00:00"
          }, {
            "y": 7,
            "x": "2012-10-23T00:00:00"
          }, {
            "y": 8,
            "x": "2012-12-25T00:00:00"
          }]
        }],
        "type": "cumulative",
        "yScale": "linear"
      }, {

        "xScale": "ordinal",
        "comp": [],
        "main": [{

					// 막대그래프 파란선
          "className": ".main.l1",
          "data": [{
            "y": '<?= $inCnt1; ?>',
            "x": "2012-02-19T00:00:00"
          }, {
            "y": '<?= $inCnt2; ?>',
            "x": "2012-04-20T00:00:00"
          }, {
            "y": '<?= $inCnt3; ?>',
            "x": "2012-06-21T00:00:00"
          }, {
            "y": '<?= $inCnt4; ?>',
            "x": "2012-08-22T00:00:00"
          }, {
            "y": '<?= $inCnt5; ?>',
            "x": "2012-10-23T00:00:00"
          }, {
            "y": '<?= $inCnt6; ?>',
            "x": "2012-12-25T00:00:00"
          }]
        }, {

					// 막대그래프 빨간선
          "className": ".main.l2",
          "data": [{
            "y": '<?= $outCnt1; ?>',
            "x": "2012-02-19T00:00:00"
          }, {
            "y": '<?= $outCnt2; ?>',
            "x": "2012-04-20T00:00:00"
          }, {
            "y": '<?= $outCnt3; ?>',
            "x": "2012-06-21T00:00:00"
          }, {
            "y": '<?= $outCnt4; ?>',
            "x": "2012-08-22T00:00:00"
          }, {
            "y": '<?= $outCnt5; ?>',
            "x": "2012-10-23T00:00:00"
          }, {
            "y": '<?= $outCnt6; ?>',
            "x": "2012-12-25T00:00:00"
          }]
        }],
        "type": "bar",
        "yScale": "linear"
      }];
      var order = [0, 2],
        i = 0,
        xFormat = d3.time.format('%B'),
        chart = new xChart('line-dotted', data[order[i]], '#chart', {
          axisPaddingTop: 5,
          dataFormatX: function(x) {
            return new Date(x);
          },
          tickFormatX: function(x) {
            return xFormat(x);
          },
          timing: 1250
        }),
        rotateTimer,
        toggles = d3.selectAll('.multi button'),
        t = 4500;

      function updateChart(i) {
        var d = data[i];
        chart.setData(d);
        toggles.classed('toggled', function() {
          return (d3.select(this).attr('data-type') === d.type);
        });
        return d;
      }

      toggles.on('click', function(d, i) {
        clearTimeout(rotateTimer);
        updateChart(i);
      });

      function rotateChart() {
        i += 1;
        i = (i >= order.length) ? 0 : i;
        var d = updateChart(order[i]);
        rotateTimer = setTimeout(rotateChart, t);
      }
      rotateTimer = setTimeout(rotateChart, t);
    }());
  </script>

</body>

</html>
