<?
//상품 폼
	include 'layout/layout.php';
	include 'api/dbconn.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$query = "SELECT * FROM product_custom"; //커스터 마이징 메뉴
	$conn->DBQ($query);
	$conn->DBE(); //쿼리 실행
	$opt = $conn->DBF();
	//$opt['opt1'];

	if(isset($_REQUEST['no']) && $_REQUEST['no'] != null) {
		$no = $_REQUEST['no'];

		$query = "SELECT * FROM wine_product WHERE idx = $no";

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
	  <form action="./api/basicReg/productI.php" method="post" name="product_form" enctype="multipart/form-data"><!--여기 링크 설정-->
		<input class="form-control" name="type" type="hidden" value="product">
        <?if(isset($no)){?>
	    <input class=" form-control" name="no" type="hidden" value="<?echo $result['idx']?>">
		<?}?>
        <h3><i class="fa fa-angle-right"></i><?if(isset($no)){echo '상품 상세보기';}else{echo '상품 등록';}?></h3>
		<div class="row mt">
          <div class="col-lg-6" style="">
			<h4><i class="fa fa-angle-right"></i>기본 정보</h4>
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">
				<div class="form-group">
                    <label for="num" class="control-label col-lg-2"><font color="red">상품코드</font></label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="num" name="num" minlength="2" type="text" required <?if(isset($no)){echo 'value='.$result['product_code'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="name" class="control-label col-lg-2"><font color="red">상품명</font></label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="name" name="name" minlength="2" type="text" required
					  <?if(isset($no)){echo 'value='.$result['product_name'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="menu" class="control-label col-lg-2"><font color="red">제조사</font></label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="menu" name="menu" minlength="2" type="text" required <?if(isset($no)){echo 'value='.$result['manufacturer'];}?>>
                    </div>
				</div>

				<div class="form-group">
                    <label for="amount" class="control-label col-lg-2">중량</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="amount" name="amount" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['amount'];}?>>
                    </div>
				</div>
			  </div>
			</div>
		  </div>
          <!-- /col-lg-6 END -->

		  <div class="col-lg-6" style="">
			<h4><i class="fa fa-angle-right"></i>상세 정보</h4>
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">
				<div class="form-group ">
                    <label for="opt1" class="control-label col-lg-2">
					<?if(isset($opt['opt1'])&& $opt['opt1'] != null){echo $opt['opt1'];}else{echo "옵션1";}?>
					</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="opt1" name="opt1" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['opt1'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="opt2" class="control-label col-lg-2">
					<?if(isset($opt['opt2'])&& $opt['opt2'] != null){echo $opt['opt2'];}else{echo "옵션2";}?>
					</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="opt2" name="opt2" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['opt2'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="opt3" class="control-label col-lg-2">
					<?if(isset($opt['opt3'])&& $opt['opt3'] != null){echo $opt['opt3'];}else{echo "옵션3";}?>
					</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="opt3" name="opt3" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['opt3'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="opt4" class="control-label col-lg-2">
					<?if(isset($opt['opt4'])&& $opt['opt4'] != null){echo $opt['opt4'];}else{echo "옵션4";}?>
					</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="opt4" name="opt4" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['opt4'];}?>>
                    </div>
				</div>

			  </div>
			</div>
          </div>
          <!-- /col-lg-6 END -->

		  <div class="col-lg-12" style="">
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">
				<div class="form-group">
                  <label class="control-label col-md-1">상품사진</label>
                  <div class="col-md-5" style="dtext-align:center">
                    <div class="<?if(isset($result['product_photo']) && $result['product_photo'] != null)
					{echo 'fileupload fileupload-exists';}else{echo 'fileupload fileupload-new';}?>" data-provides="fileupload">

                      <div class="fileupload-new thumbnail" style="">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                      </div>

                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-height: 270px;">
					  <!--요기 들어가 <img src="<?=$result['ware_photo'];?>" style="max-height: 150px;"/> -->
					  <?if(isset($result['product_photo']) && $result['product_photo'] != null){?>
					  <img src="<?=$result['product_photo'];?>" style="max-height: 270px;"/>
					  <?}?>
					  </div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="default" name="upfile"/>
                        </span>
                      </div>
                    </div>
                  </div>

                    <label for="comment" class="control-label col-lg-1">비고</label>
                    <div class="col-lg-5">
                      <textarea class="form-control " id="comment" name="comment" style="height: 200px;"><?if(isset($no)){echo $result['memo'];}?></textarea>
                    </div>

                </div>
                <!--photo end-->

				<!--<div class="form-group last">
                    <label for="comment" class="control-label col-lg-1">비고</label>
                    <div class="col-lg-11">
                      <textarea class="form-control " id="comment" name="comment"><?if(isset($no)){echo $result['memo'];}?></textarea>
                    </div>
				</div>-->

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

      </form>
      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <?$layout->JsFile('<script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>');?>
  <?$layout->js($js);?>
</body>

</html>
