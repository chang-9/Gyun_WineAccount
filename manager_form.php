<?
//거래처 폼
	include 'layout/layout.php';
	include 'api/dbconn.php';

	if(isset($_REQUEST['no']) && $_REQUEST['no'] != null) {
		$no = $_REQUEST['no'];

		$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
		$conn->DBI(); //DB 접속
		$query = "SELECT * FROM Account_member INNER JOIN Account_relationship ON $no = Account_relationship.member_idx AND $no = Account_member.idx";

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
	  <form action="./api/basicReg/managerI.php" method="post" name="manager_form">
		<input class="form-control" name="type" type="hidden" value="manager">
        <?if(isset($no)){?>
	    <input class=" form-control" name="no" type="hidden" value="<?echo $result['idx']?>">
		<?}?>
        <h3><i class="fa fa-angle-right"></i><?if(isset($no)){echo '직원 상세보기';}else{echo '직원 등록';}?></h3>
		<div class="row mt">
          <div class="col-lg-6" style="">
			<h4><i class="fa fa-angle-right"></i>직원 정보</h4>
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">

				<div class="form-group ">
                    <label for="name" class="control-label col-lg-2"><font color="red">사원명</font></label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="name" name="name" minlength="2" type="text" required <?if(isset($no)){echo 'value='.$result['en_name'];}?>>
                    </div>
				</div>

				<div class="form-group">
                    <label for="job" class="control-label col-lg-2">직급</label>
                    <div class="col-lg-4">
                      <select class=" form-control" id="job" name="job" minlength="2" required>
					  <option value="">::선택::</option>
						  <option value="직원"
						  <?if(isset($no)){if($result['position'] == "직원"){echo "selected";}}?>>직원</option>
						  <option value="대표"
						  <?if(isset($no)){if($result['position'] == "대표"){echo "selected";}}?>>대표</option>
					  </select>
                    </div>
                    <label for="dept" class="control-label col-lg-2">부서</label>
                    <div class="col-lg-4">
                      <input class=" form-control" id="dept" name="dept" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['department'];}?>>
                    </div>
				</div>
<?
if(isset($no)){
	$phone = $result['phone_num'];
	$frontNum = mb_substr($phone,0, 3);
	$midNum = mb_substr($phone, 4, 4);
	$finalNum = mb_substr($phone,7);

	$email = $result['email'];
	$front_email = mb_substr($email,0,  mb_strpos($email,'@'));
	$next_email = mb_substr($email,mb_strpos($email,'@'));
	$next_email = str_replace('@','',$next_email);
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
                    <label for="email" class="control-label col-lg-2"><font color="red">이메일</font></label>
                    <div class="col-lg-10">
					 <div class="col-lg-5" style="padding-left:0px;padding-right:0px">
					    <input class="form-control" name="email1" id="email1" size="4"<?if(isset($no)){echo 'value='.$front_email;}?> required>

					 </div>
					 <div class="col-lg-1" style="text-align: center;"><span style = "font-size : 20px">@</span></div>
                        <div class="col-lg-6" style="padding-left:0px;padding-right:0px">
					  <select class="form-control" name="email2" id="email2" required>
						  <option value="">::선택::</option>
						  <option value="naver.com"
						  <?if(isset($no)){if($next_email == "naver.com"){echo "selected";}}?>>naver.com</option>
						  <option value="gmail.com"
						  <?if(isset($no)){if($next_email == "gmail.com"){echo "selected";}}?>>gmail.com</option>
						  <option value="hanmail.net"
						  <?if(isset($no)){if($next_email == "hanmail.net"){echo "selected";}}?>>hanmail.net</option>
						  <option value="hotmail.com"
						  <?if(isset($no)){if($next_email == "hotmail.com"){echo "selected";}}?>>hotmail.com</option>
						  <option value="yahoo.co.kr"
						  <?if(isset($no)){if($next_email == "yahoo.co.kr"){echo "selected";}}?>>yahoo.co.kr</option>
					  </select>
					  
					  </div>
                    </div>
				</div>
			  </div>
			</div>
		  </div>
          <!-- /col-lg-6 END -->
          <div class="col-lg-6" style="">
			<h4><i class="fa fa-angle-right"></i>권한 설정</h4>
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">

				<div class="form-group">
										<label for="job" class="control-label col-lg-2"><font color="blue">아이디</font></label>
										<div class="col-lg-4">
											<input class=" form-control" id="id" name="id" minlength="2" type="text"
						<?if(isset($no)){echo 'value='.$result['id'];}?>>
										</div>
										<label for="dept" class="control-label col-lg-2"><font color="blue">패스워드</font></label>
										<div class="col-lg-4">
											<input class=" form-control" id="pass" name="pass" minlength="2" type="password"
						<?if(isset($no)){echo 'value='.$result['password'];}?>>
										</div>
				</div>





				<div class="form-group ">
                    <label for="m1" class="control-label col-lg-2">기초관리</label>
                    <div class="col-lg-4">
					  <select class="form-control" name="m1" id="m1" required>
						  <option value="">::선택::</option>
						  <option value="1">허용</option>
						  <option value="0">불가</option>
					  </select>
                    </div>
                    <label for="m2" class="control-label col-lg-2">구매관리</label>
                    <div class="col-lg-4">
					  <select class="form-control" name="m2" id="m2" required>
						  <option value="">::선택::</option>
						  <option value="1">허용</option>
						  <option value="0">불가</option>
					  </select>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="m3" class="control-label col-lg-2">판매관리</label>
                    <div class="col-lg-4">
					  <select class="form-control" name="m3" id="m3" required>
						  <option value="">::선택::</option>
						  <option value="1">허용</option>
						  <option value="0">불가</option>
					  </select>
                    </div>
                    <label for="m4" class="control-label col-lg-2">입/출금관리</label>
                    <div class="col-lg-4">
					  <select class="form-control" name="m4" id="m4" required>
						  <option value="">::선택::</option>
						  <option value="1">허용</option>
						  <option value="0">불가</option>
					  </select>
                    </div>
				</div>

				<div class="form-group ">
                    <label for="m5" class="control-label col-lg-2">재고관리</label>
                    <div class="col-lg-4">
					  <select class="form-control" name="m5" id="m5" required>
						  <option value="">::선택::</option>
						  <option value="1">허용</option>
						  <option value="0">불가</option>
					  </select>
                    </div>
                    <label for="m6" class="control-label col-lg-2">고객관리</label>
                    <div class="col-lg-4">
					  <select class="form-control" name="m6" id="m6" required>
						  <option value="">::선택::</option>
						  <option value="1">허용</option>
						  <option value="0">불가</option>
					  </select>
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
		    <button class="btn btn-theme" name ="type" value ="manager" type="submit">
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
