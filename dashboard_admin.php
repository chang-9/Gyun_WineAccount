<?
//관리자페이지
   include 'layout/layout.php';
   include 'api/pageClass.php';
   include 'api/dbconn_administrator.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?//$layout->CssJsFile("<script>alert('ts');</script>");?>
<?$layout->head($head);?>

<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
    <!--main content start-->
    <section id="main-content">
	  <section class="wrapper">
        <div class="row mt">
          <div class="col-lg-6">
            <div class="border-head">
              <h3><strong><i class="fa fa-angle-right"></i> 회원 승인 테이블</strong></h3>
            </div>
            <section id="no-more-tables">
              <table class="table table-bordered table-hover table-striped">
                <thead class="cf" style='background-color: #BDBDBD'>
                  <tr>
                    <th class="numeric">사업자 코드</th>
                    <th class="numeric">사업자명</th>
                    <th class="numeric">가입일자</th>
                    <th class="numeric">승인 여부</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td class="numeric" data-title="사업자 코드"></td>
                    <td class="numeric" data-title="사업자명"></td>
                    <td class="numeric" data-title="가입일자"></td>
                    <td class="numeric" data-title="승인여부"></td>
                  </tr>
                </tbody>
              </table>
            </section>
          </div>
          <!-- /col-lg-6 -->

          <div class="col-lg-6">
            <div class="border-head">
              <h3><strong><i class="fa fa-angle-right"></i> 회원 탈퇴 테이블</strong></h3>
            </div>
            <section id="no-more-tables">
              <table class="table table-bordered table-hover table-striped">
                <thead class="cf" style='background-color: #BDBDBD'>
                  <tr>
                  </tr>
                </thead>

                <tbody>
                </tbody>
              </table>
            </section>
          </div>
          <!-- /col-lg-6 -->

        </div>
        <!-- /row mt -->
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
