<?
//거래처 폼
	include 'layout/layout.php';
	include 'api/dbconn.php';

	if(isset($_REQUEST['no']) && $_REQUEST['no'] != null) {
		$no = $_REQUEST['no'];

		$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
		$conn->DBI(); //DB 접속
		$query = "SELECT * FROM wine_company WHERE idx = $no";

		$conn->DBQ($query);
		$conn->DBE(); //쿼리 실행
		$result = $conn->DBF();
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
    <section id="main-content" style="min-height:700px;">
	  <section class="wrapper">
	  <form action="./api/basicReg/companyI.php" method="post" name="company_form">
		<input class="form-control" name="type" type="hidden" value="company">
        <?if(isset($no)){?>
	    <input class=" form-control" name="no" type="hidden" value="<?echo $result['idx']?>">
		<?}?>
        <h3><i class="fa fa-angle-right"></i><?if(isset($no)){echo '거래처 상세보기';}else{echo '거래처 등록';}?></h3>
		<div class="row mt">
          <div class="col-lg-6" style="">
			<h4><i class="fa fa-angle-right"></i>기본 정보</h4>
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">

				<div class="form-group ">
                    <label for="num" class="control-label col-lg-2"><font color="red">사업자번호</font></label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="num" name="num" minlength="2" type="text" required
					  <?if(isset($no)){echo 'value='.$result['com_code'];}?>>
                    </div>
				</div>

				<div class="form-group">
                    <label for="name" class="control-label col-lg-2"><font color="red">거래처명</font></label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="name" name="name" minlength="2" type="text" required <?if(isset($no)){echo 'value='.$result['com_name'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="mname" class="control-label col-lg-2"><font color="red">대표자</font></label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="mname" name="mname" minlength="2" type="text" required <?if(isset($no)){echo 'value='.$result['com_m'];}?>>
                    </div>
				</div>
<?
if(isset($no)){
	$phone = $result['com_phone'];
	$frontNum = mb_substr($phone,0, $cnt1 = mb_strpos($phone,'-'));
	$midNum = mb_substr($phone, mb_strpos($phone,'-',$cnt1)+1, $cnt2 = mb_strpos($phone,'-',$cnt1)+1);
	$midNum = str_replace('-','',$midNum);
	$finalNum = mb_substr($phone,mb_strpos($phone,'-',$cnt1+$cnt2)+1);
}
?>
				<div class="form-group">
                    <label for="phone" class="control-label col-lg-2"><font color="red">휴대폰번호</font></label>
                    <div class="col-lg-10">
					  <div class="col-lg-4" style="padding-left:0px;padding-right:0px">
					  <select class="form-control" name="txtMobile1" id="phone" required>
						  <option value="">::선택::</option>
						  <option value="010"
						  <?if(isset($no)){if($frontNum == "010"){echo "selected";}}?>>010</option>
						  <option value="011"
						  <?if(isset($no)){if($frontNum == "011"){echo "selected";}}?>>011</option>
						  <option value="016"
						  <?if(isset($no)){if($frontNum == "016"){echo "selected";}}?>>016</option>
						  <option value="017"
						  <?if(isset($no)){if($frontNum == "017"){echo "selected";}}?>>017</option>
						  <option value="019"
						  <?if(isset($no)){if($frontNum == "019"){echo "selected";}}?>>019</option>
					  </select>
					  </div>
					  <div class="col-lg-4" style="padding-left:0px;padding-right:0px">
					    <input class="form-control" name="txtMobile2" size="4" required
						pattern="^[0-9]*$" title="숫자를 입력해 주세요"
						<?if(isset($midNum)){echo "value={$midNum}";}?>>
					  </div>
					  <div class="col-lg-4" style="padding-left:0px;padding-right:0px">
					    <input class="form-control" name="txtMobile3" size="4" required
						pattern="^[0-9]*$" title="숫자를 입력해 주세요"
						<?if(isset($finalNum)){echo "value={$finalNum}";}?>>
					  </div>
                    </div>
				</div>

				<div class="form-group">
                    <label for="email" class="control-label col-lg-2">이메일</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="email" name="email" minlength="2" type="email"
					  <?if(isset($no)){echo 'value='.$result['com_mail'];}?>>
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
                    <label for="address" class="control-label col-lg-2">주소</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="address" name="address" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['com_address'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="call" class="control-label col-lg-2">전화번호</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="call" name="call" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['com_call'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="fax" class="control-label col-lg-2">팩스번호</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="fax" name="fax" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['com_fax'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="bankName" class="control-label col-lg-2">은행이름</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="bankName" name="bankName" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['bank_name'];}?>>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="bankNum" class="control-label col-lg-2">대표계좌</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="bankNum" name="bankNum" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['bank_num'];}?>>
                    </div>
				</div>
			  </div>
			</div>
          </div>
          <!-- /col-lg-6 END -->
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
        </div>
        <!-- /row -->
        <!--<div style="border-top: 3px solid grey;margin-top: 10px"></div>-->

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
  <?//$layout->JsFile("<script></script>");?>
  <?$layout->js($js);?>
</body>

</html>
