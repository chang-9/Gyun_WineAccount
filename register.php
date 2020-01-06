
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
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>에러 때문에 지워버림-->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
	/* Latest compiled and minified CSS included as External Resource*/

	/* Optional theme */

	/*@import url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css');*/
	 body {
		margin-top:30px;
	}
	.stepwizard-step p {
		margin-top: 0px;
		/*color:#666;*/
		color:black
	}
	.stepwizard-row {
		display: table-row;
	}
	.stepwizard {
		display: table;
		width: 100%;
		position: relative;
	}
	.stepwizard-step button[disabled] {
		/*opacity: 1 !important;
		filter: alpha(opacity=100) !important;*/
	}
	.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
		opacity:1 !important;
		color:#bbb;
	}
	.stepwizard-row:before {
		top: 14px;
		bottom: 0;
		position: absolute;
		content:" ";
		width: 100%;
		height: 1px;
		background-color: #ccc;
		z-index: 0;
	}
	.stepwizard-step {
		display: table-cell;
		text-align: center;
		position: relative;
	}
	.btn-circle {
		width: 30px;
		height: 30px;
		text-align: center;
		padding: 6px 0;
		font-size: 12px;
		line-height: 1.428571429;
		border-radius: 15px;
	}
  </style>
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
<div style="margin-bottom:20px"></div>
<div class="container">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-4">
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small><strong>기본정보</strong></small></p>
            </div>
            <div class="stepwizard-step col-xs-4">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small><strong>사업자정보</strong></small></p>
            </div>
            <div class="stepwizard-step col-xs-4">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small><strong>사업자등록증</strong></small></p>
            </div>
        </div>
    </div>
 <!----------------------------------------------------------------------------------------------------------------------------------------------------->
    <form role="form" action="./api/member/register_2.php" method="post" name="" enctype="multipart/form-data">
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">기본정보</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label">아이디</label>
                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="아이디를 입력해주세요." name="id"/>
				</div>

                <div class="form-group">
                    <label class="control-label">비밀번호</label>
                    <input maxlength="100" type="password" required="required" class="form-control" placeholder="비밀번호를 입력해주세요." name="pass1" id="pwd1"/>
                </div>
                <div class="form-group">
                    <label class="control-label">비밀번호 재확인</label>
                    <input maxlength="100" type="password" required="required" class="form-control" placeholder="다시 한번 입력해주세요." name="pass2" id="pwd2"/>
                </div>
				<div class="alert alert-success" id="alert-success">비밀번호가 일치합니다.</div>
				<div class="alert alert-danger" id="alert-danger">비밀번호가 일치하지 않습니다.</div>
				<br>
                <div class="form-group">
                    <label class="control-label">이름</label>
                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="이름을 입력해주세요." name="name"/>
                </div>
                <div class="form-group">
                    <label class="control-label">이메일</label>
                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="이메일을 입력해주세요." name="email"/>
                </div>
                <div class="form-group">
                    <label class="control-label">휴대폰 번호</label>
                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="휴대폰번호를 입력해주세요." name="phone"/>
                </div>
                <div class="form-group">
                    <label class="control-label">주소</label>
                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="주소를 입력해주세요." name="address"/>
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
 <!----------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">사업자정보</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label">회사이름</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="회사명을 입력해 주세요." name="Cname"/>
				</div>

                <div class="form-group">
                    <label class="control-label">사업자번호</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="사업자번호를 입력해 주새요." name="Cnum"/>
                </div>
                <div class="form-group">
                    <label class="control-label">대표자</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="대표자명을 입력해 주세요." name="Crepresent"/>
                </div>
                <div class="form-group">
                    <label class="control-label">업태</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="업태를 입력해 주세요." name="Ctype"/>
                </div>
                <div class="form-group">
                    <label class="control-label">전화번호</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="전화번호를 입력해 주새요." name="call"/>
                </div>
                <div class="form-group">
                    <label class="control-label">팩스번호</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="팩스번호를 입력해 주세요." name="fax"/>
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">사업자등록증</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">대표 홈페이지</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="대표 홈페이지를 입력해 주세요." name="Cpage"/>
                </div>
                <div class="form-group">
                    <label class="control-label">대표 이메일</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="대표 이메일을 입력해 주세요." name="Cemail"/>
                </div>

                <div class="form-group last">
                  <label class="control-label">사업자 등록증 이미지</label>
                  <!--<div class="col-md-11">-->
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <!--<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">-->
					  <div class="fileupload-new thumbnail">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                      </div>
                      <!--<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>-->
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-height: 270px;"></div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="default" name="upfile"/>
                        </span>
                      </div>
                    <!--</div>-->
                  </div>
                </div>

                <button class="btn btn-success pull-right" type="submit">Finish!</button>
            </div>
        </div>

    </form>
</div>
  <script>
	$(document).ready(function () {

		var navListItems = $('div.setup-panel div a'),
			allWells = $('.setup-content'),
			allNextBtn = $('.nextBtn');

		allWells.hide();

		navListItems.click(function (e) {
			e.preventDefault();
			var $target = $($(this).attr('href')),
				$item = $(this);

			if (!$item.hasClass('disabled')) {
				navListItems.removeClass('btn-success').addClass('btn-default');
				$item.addClass('btn-success');
				allWells.hide();
				$target.show();
				$target.find('input:eq(0)').focus();
			}
		});

		allNextBtn.click(function () {
			var curStep = $(this).closest(".setup-content"),
				curStepBtn = curStep.attr("id"),
				nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
				curInputs = curStep.find("input[type='text'],input[type='url']"),
				isValid = true;

			$(".form-group").removeClass("has-error");
			for (var i = 0; i < curInputs.length; i++) {
				if (!curInputs[i].validity.valid) {
					isValid = false;
					$(curInputs[i]).closest(".form-group").addClass("has-error");
				}
			}

			if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
		});

		$('div.setup-panel div a.btn-success').trigger('click');
	});
  </script>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>

  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script>
    //$.backstretch("img/login-bg.jpg", {
    //  speed: 500
    //});
    $.backstretch("img/login2.png", {
      speed: 1000
    });
  </script>
  <script type="text/javascript">
    $(function(){
        $("#alert-success").hide();
        $("#alert-danger").hide();
        $("input").keyup(function(){
            var pwd1=$("#pwd1").val();
            var pwd2=$("#pwd2").val();
            if(pwd1 != "" || pwd2 != ""){
                if(pwd1 == pwd2){
                    $("#alert-success").show();
                    $("#alert-danger").hide();
                    $("#submit").removeAttr("disabled");
                }else{
                    $("#alert-success").hide();
                    $("#alert-danger").show();
                    $("#submit").attr("disabled", "disabled");
                }
            }
        });
    });
  </script>

</body>

</html>
<?
//https://bootsnipp.com/snippets/RlOe3 사용된 레이아웃
//https://bootsnipp.com/snippets/j6rkb 사용된 레이아웃
//https://hongku.tistory.com/249 비밀번호 체크 오후 4:58 날짜는 컨트롤 + m
?>
