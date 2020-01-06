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

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <form class="form-login" action="api/member/login_2.php" method="post">
        <h2 class="form-login-heading">Account</h2>
        <div class="login-wrap">
          <input type="text" class="form-control" placeholder="User ID" autofocus="" name="id" >
          <br>
          <input type="password" class="form-control" placeholder="Password" name="pass">
		  <br>
          <!--<label class="checkbox">-->
            <span class="pull-right">
            <a data-toggle="modal" href="login.html#myModal"> 비밀번호를 잊으셨나요?</a>
            </span>
          <!--</label>-->
		  <br><br>

		  <button class="btn btn-theme btn-block" href="#" type="submit" ><i class="fa fa-lock"></i> 로그인 </button>

          <hr>
          <div class="registration">
            아직 회원이 아니신가요?<br/>
            <a class="" href="register_2.php">
              회원가입
              </a>
          </div>
        </div>
      </form>

      <!-- Modal -->
      <form action="./api/member/pass_mail.php" method="post">
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">비밀번호를 찾기위해 아이디, 이름, 이메일이 필요합니다!</h4>
              </div>
              <div class="modal-body">
                <label><strong>가입시 기재한 이름을 입력해주세요!</strong></label>
                <input type="text" name="per_name" placeholder="이름을 입력해주세요 . . ." autocomplete="off" required="" class="form-control placeholder-no-fix"><br><br>

                <label><strong>가입시 기재한 ID를 입력해주세요!</strong></label>
                <input type="text" name="per_id" id="per_id" placeholder="ID를 입력해주세요 . . ." autocomplete="off" required="" onkeyup="duplicationCheck()" class="form-control placeholder-no-fix"><br><br>

                <label><strong>가입시 기재한 이메일을 입력해주세요! 임시 비밀번호가 전송됩니다.</strong></label>
                <input type="text" name="email" placeholder="이메일을 입력해주세요 . . ." autocomplete="off" required="" class="form-control placeholder-no-fix">
              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">취소</button>
                <button class="btn btn-theme" type="submit">제출</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- modal -->

    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    //$.backstretch("img/login-bg.jpg", {
    //  speed: 500
    //});
    $.backstretch("img/login2.png", {
      speed: 1000
    });
	//alert("임시 id&password = 1")
  function duplicationCheck()
  {
    var chkid = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
    if(chkid.test($("input[name=per_id]").val())) {
      document.getElementById("per_id").value = "";
    }
  }
  </script>
</body>

</html>
