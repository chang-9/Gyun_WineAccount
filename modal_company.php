<?
  include 'layout/layout.php';
  include 'api/dbconn.php';
  include 'api/pageClass.php';

  $conn = new DBC();
  $conn->DBI();
?>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">');?>
<?$layout->head($head);?>
<body>
  <section id="container">
    <?$layout->headerF($headerF);?>
  	<?$layout->sideMenu($sideMenu);?>
    <section id="main-content" style="min-height:800px;">
      <section class="wrapper">
        <div class="row mt">
          <div class="col-lg-12">
            <section id="no-more-tables">
              <table class="table table-bordered table-hover table-striped">
                <thead class="cf" style="background-color: #F2F2F2">
                  <tr>
                    <th></th>
                    <th>거래처명</th>
                    <th class="numeric">대표자명</th>
                    <th class="numeric">전화번호</th>
                    <th class="numeric">핸드폰번호</th>
                    <th class="numeric">이메일</th>
                  </tr>
                </thead>

                <tbody>
                  <?
                  $query = "select * from wine_company order by idx desc limit $limit, $list";
                  $conn->DBQ($query);
                  $conn->DBE();

                  while($row = $conn->DBF()) {
                  ?>
                  <tr>
                    <td date-title="선택"><input type="checkbox" id="chk_info[]" name="chk_info[]" value="<?echo $row['idx'];?>"></td>
                    <td date-title="거래처명"><?echo $row['com_name']?></td>
                    <td date-title="대표자명"><?echo $row['com_m']?></td>
                    <td date-title="전화번호"><?echo $row['com_call']?></td>
                    <td date-title="핸드폰번호"><?echo $row['com_phone']?></td>
                    <td date-title="이메일"><?echo $row['com_mail']?></td>
                  </tr>
                  <? } ?>
                </tbody>
              </table>
            </section>
          </div>
        </div>

        <div class="row" style="text-align:center">
          <div class="col-lg-12">
            <ul class="pagination">
              <?echo $paging;?>
            </ul>
          </div>
        </div>
      </section>
    </section>
  </section>
</body>

<div class="row mt">
  <div class="col-lg-12">
    <section id="no-more-tables">
      <table class="table table-bordered table-hover table-striped">
        <thead class="cf" style="background-color: #F2F2F2">
          <tr>
            <th></th>
            <th>거래처명</th>
            <th class="numeric">대표자명</th>
            <th class="numeric">전화번호</th>
            <th class="numeric">핸드폰번호</th>
            <th class="numeric">이메일</th>
          </tr>
        </thead>

        <tbody>
          <?
          $query = "select * from wine_company order by idx desc limit $limit, $list";
          $conn->DBQ($query);
          $conn->DBE();

          while($row = $conn->DBF()) {
          ?>
          <tr>
            <td date-title="선택"><input type="checkbox" id="chk_info[]" name="chk_info[]" value="<?echo $row['idx'];?>"></td>
            <td date-title="거래처명"><?echo $row['com_name']?></td>
            <td date-title="대표자명"><?echo $row['com_m']?></td>
            <td date-title="전화번호"><?echo $row['com_call']?></td>
            <td date-title="핸드폰번호"><?echo $row['com_phone']?></td>
            <td date-title="이메일"><?echo $row['com_mail']?></td>
          </tr>
          <? } ?>
        </tbody>
      </table>
    </section>
  </div>
</div>

<div class="row" style="text-align:center">
  <div class="col-lg-12">
    <ul class="pagination">
      <?echo $paging;?>
    </ul>
  </div>
</div>
