<?
//입금 추가
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';
  include 'api/basicReg/dashV.php';

  // $sql = "select date(curdate() - interval weekday(curdate()) day)";
  // $conn->DBQ($sql);
  // $conn->DBE();
  // $row = $conn->DBF();

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
    <section id="main-content">
    <section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">

            <div class="border-head">
              <h3><strong><i class="fa fa-angle-right"></i>  월별 매입/매출 현황</strong></h3>
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
          "className": ".main.l1",
          "data": [{
            "y": 15,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 11,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 10,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 1,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 6,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }, {
          "className": ".main.l2",
          "data": [{
            "y": 29,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 33,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 13,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 16,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
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
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 6,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 12,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }, {
          "className": ".main.l2",
          "data": [{
            "y": 29,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 33,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 13,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 16,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }],
        "type": "cumulative",
        "yScale": "linear"
      }, {
        "xScale": "ordinal",
        "comp": [],
        "main": [{
          "className": ".main.l1",
          "data": [{
            "y": 12,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 6,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 12,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }, {
          "className": ".main.l2",
          "data": [{
            "y": 29,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 33,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 13,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 16,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }],
        "type": "bar",
        "yScale": "linear"
      }];
      var order = [0, 2],
        i = 0,
        xFormat = d3.time.format('%A'),
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
        t = 3500;

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
