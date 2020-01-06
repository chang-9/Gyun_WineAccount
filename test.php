<?
//�ŷ�ó ����
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

    $layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard">
	<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<title>Account</title>

	<!-- Favicons -->
	<link href="img/favicon.png" rel="icon">
	<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Bootstrap core CSS -->
	<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--external css-->
	<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
	<!--<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">-->

	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
	<link href="css/style-responsive.css" rel="stylesheet">
</head>
<body>
  <section id="container">
	<header class="header black-bg">
		<div class="sidebar-toggle-box">
			<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
		</div>
		<!--logo start-->
		<a href="./" class="logo"><b>Account<span></span></b></a>
		<!--logo end-->
	</header>
    <!--main content start-->
    <section id="main-content">
	  <section class="wrapper">
        <div class="row">
          <div class="col-lg-12 mt" style="min-height:1000px;">
            <!--CONTENT -->
<pre>
1. �ֻ��� �������� �������� ����
2. ���������� API�� ���� �ֱ� ���⺰�� �������� ���ָ� �� �����ϴ�.
3. �����̸� �� ���� ������ �ǹ� �ְ� ����
4. ���� �۾��� ��ũ�����̽��� �ڱ� ���� ����� ����
5. ���ø� ���Ҵ� Dashio������ �ִ� ���ø����� ã�� ������ ����x
6. ���̾ƿ� ������ �� ����X
7. ������ ���ܿ� �ּ��� � ���������� �ۼ�
8. http://webtesting0001.dothome.co.kr/erp_system/basic_table.html ������ ���̺� ������ ��

</pre>
			<!--CONTENT END-->
          </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <?//$layout->JsFile("<script>alert('ts');</script>");?>
  <?$layout->js($js);?>
</body>

</html>
