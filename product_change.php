<?
//상품 관리
	include 'layout/layout.php';
	include 'api/dbconn.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$query = "SELECT * FROM product_custom"; //커스터 마이징 메뉴
	$conn->DBQ($query);
	$conn->DBE(); //쿼리 실행
	$opt = $conn->DBF();
	//$opt['opt1'];
	$result = $conn->resultRow();
    //echo $result;

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">
<script>
   function validate() {
	 if(confirm("삭제 하시겠습니까?")){
         return true;
     }else{
 		 return false;
     }
   }
</script>
');?>
<?$layout->head($head);?>
<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
	  <form action="./api/basicReg/pro_chage.php" method="post" name="custom">

	  <div class="row">
		<div class="col-lg-6">
			<h3><i class="fa fa-angle-right"></i><a href="<?=$_SERVER['PHP_SELF']?>">상품 커스터마이징</a></h3>
		</div>
	  </div>

		<div class="row mt">
          <div class="col-lg-12" style="">

		    <h4><i class="fa fa-angle-right"></i>기본 설정(옵션)</h4>
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">

			  <div class="form-group ">
                <label for="op1" class="control-label col-lg-2"><font color="red">옵션1</font></label>
                <div class="col-lg-10">
                  <input class=" form-control" id="op1" name="op1" type="text"
					<?if($opt['opt1'] != null){echo 'value='.$opt['opt1'];}?>>
                </div>
			  </div>

			  <div class="form-group">
                 <label for="op2" class="control-label col-lg-2"><font color="red">옵션2</font></label>
                 <div class="col-lg-10">
                   <input class=" form-control" id="op2" name="op2" type="text"
				   <?if($opt['opt2'] != null){echo 'value='.$opt['opt2'];}?>>
                 </div>
			  </div>

			  <div class="form-group ">
                <label for="op3" class="control-label col-lg-2"><font color="red">옵션3</font></label>
                <div class="col-lg-10">
                  <input class=" form-control" id="op3" name="op3" type="text"
				  <?if($opt['opt3'] != null){echo 'value='.$opt['opt3'];}?>>
                </div>
			  </div>

			  <div class="form-group ">
                <label for="op4" class="control-label col-lg-2"><font color="red">옵션4</font></label>
                <div class="col-lg-10">
                  <input class=" form-control" id="op4" name="op4" type="text"
				  <?if($opt['opt4'] != null){echo 'value='.$opt['opt4'];}?>>
                </div>
			  </div>

            </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->

		<div class="row mt" style="text-align:center">
          <div class="col-lg-12" style="">
		    <button class="btn btn-theme" type="submit">등록</button>
		    <button class="btn btn-warning" type="button" onclick="history.back(-1);">초기화</button>
		    <button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
		  </div>
		</div>

        <!-- /row -->
      </form>
	  </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <?$layout->JsFile("");?>
  <?$layout->js($js);?>
</body>

</html>
