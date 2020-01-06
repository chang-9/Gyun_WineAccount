<?
//거래처 폼
	include 'layout/layout.php';
	include 'api/dbconn.php';


	if(isset($_REQUEST['no']) && $_REQUEST['no'] != null) {
		$no = $_REQUEST['no'];

		$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
		$conn->DBI(); //DB 접속
		$query = "SELECT * FROM wine_warehouse WHERE idx = $no";

		$conn->DBQ($query);
		$conn->DBE(); //쿼리 실행
		$result = $conn->DBF();
	}

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('
<link href="css/table-responsive.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
');?>
<?$layout->head($head);?>
<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>

    <!--main content start-->
    <section id="main-content" style="min-height:700px;">
	  <section class="wrapper">
	  <form action="./api/basicReg/wareI.php" method="post" name="ware_form" enctype="multipart/form-data"><!--여기 링크 설정-->
		<input class="form-control" name="type" type="hidden" value="ware">
        <?if(isset($no)){?>
	    <input class=" form-control" name="no" type="hidden" value="<?echo $result['idx']?>">
		<?}?>
        <h3><i class="fa fa-angle-right"></i><?if(isset($no)){echo '창고 상세보기';}else{echo '창고 등록';}?></h3>
		<div class="row mt">
          <div class="col-lg-12" style="">
			<h4><i class="fa fa-angle-right"></i>기본 정보</h4>
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">
				<div class="form-group">
                  <label for="num" class="control-label col-lg-2"><font color="red">창고코드</font></label>
                  <div class="col-lg-10">
                    <input class=" form-control" id="num" name="num" minlength="2" type="text" required <?if(isset($no)){echo 'value='.$result['ware_code'];}?>>
                  </div>
				</div>

				<div class="form-group ">
                    <label for="name" class="control-label col-lg-2"><font color="red">창고명</font></label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="name" name="name" minlength="2" type="text" required
					  <?if(isset($no)){echo 'value='.$result['ware_name'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="mname" class="control-label col-lg-2"><font color="red">담당자</font></label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="mname" name="mname" minlength="2" type="text" required <?if(isset($no)){echo 'value='.$result['ware_m'];}?>>
                    </div>
				</div>
<!--<img src="<?=$result['ware_photo'];?>" />-->
				<div class="form-group last">
                  <label class="control-label col-md-2">창고 사진</label>
                  <div class="col-md-10">
                    <div class="<?if(isset($result['ware_photo']) && $result['ware_photo'] != null)
					{echo 'fileupload fileupload-exists';}else{echo 'fileupload fileupload-new';}?>" data-provides="fileupload">

                      <div class="fileupload-new thumbnail" style="">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                      </div>

                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-height: 270px;">
					  <!--요기 들어가 <img src="<?=$result['ware_photo'];?>" style="max-height: 150px;"/> -->
					  <?if(isset($result['ware_photo']) && $result['ware_photo'] != null){?>
					  <img src="<?=$result['ware_photo'];?>" style="max-height: 270px;"/>
					  <?}?>
					  </div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="default" name="upfile"/>
                        </span>
                        <!--<a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i>Remove</a>-->
                      </div>
                    </div>
                  </div>
                </div>
                <!--photo end-->
			  </div>
			</div>
		  </div>
          <!-- /col-lg-12 END -->

		  <div class="col-lg-12" style="">
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">
				<div class="form-group ">
                  <label for="comment" class="control-label col-lg-1">비고</label>
                  <div class="col-lg-11">
                    <textarea class="form-control " id="comment" name="comment"><?if(isset($no)){echo $result['memo'];}?></textarea>
                  </div>
				</div>
              </div>
	        </div>
          </div>
		  <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->

		<div class="row mt" style="text-align:center">
          <div class="col-lg-12" style="">
		    <button class="btn btn-theme" type="submit">
			<?if(isset($no)){echo '수정';}else{echo '등록';}?>
			</button>
		    <button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
		  </div>
		</div>

        <!-- /row -->
		<div class="row" style="text-align:center">
          <div class="col-lg-12" style="">
          </div>
		</div>
      </form>
      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <?$layout->JsFile('
  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  ');?>
  <?$layout->js($js);?>
</body>

</html>
