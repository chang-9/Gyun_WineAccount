<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE html>
<html lang="ko">
<?
session_start();
	
	require_once './API/dbconn.php';
	require_once 'view.php';
	$con = new DBC();//객체 생성
	$con->DBI(); //db접속
	?>

<head>
	<title>일정&특가는 우리가 관리한다!</title>
	<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<meta charset="utf-8">
	<meta name="keywords" content="Baked a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
				Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
	<link href="css/simpleLightbox.css" rel='stylesheet' type='text/css' />
	<link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Lato:100i,300,300i,400,400i,700,700i,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700" rel="stylesheet">
	<style>
		@import url(//fonts.googleapis.com/earlyaccess/nanumpenscript.css);
		@import url(//fonts.googleapis.com/earlyaccess/jejugothic.css);
		@import url(//fonts.googleapis.com/earlyaccess/jejumyeongjo.css);
		@import url(//fonts.googleapis.com/earlyaccess/kopubbatang.css);
		@import url(//fonts.googleapis.com/earlyaccess/nanumbrushscript.css);
		@import url(//fonts.googleapis.com/earlyaccess/notosanskr.css);
		@import url(//fonts.googleapis.com/earlyaccess/hanna.css);
		@import url(//fonts.googleapis.com/earlyaccess/nanumgothic.css);
		@import url(//fonts.googleapis.com/earlyaccess/nanummyeongjo.css);
		@import url(//fonts.googleapis.com/earlyaccess/jejuhallasan.css);
		@import url(//fonts.googleapis.com/earlyaccess/nanumgothiccoding.css);
		 
		.centered { display: table; margin-left: auto; margin-right: auto; }
		.np{font-family: 'Nanum Pen Script', cursive;}
		.jg{font-family: 'Jeju Gothic', sans-serif;}
		.jm{font-family: 'Jeju Myeongjo', serif;}
		.kb{font-family: 'KoPub Batang', serif;}
		.nb{font-family: 'Nanum Brush Script', cursive;}
		.ns{font-family: 'Noto Sans KR', sans-serif;}
		.hn{font-family: 'Hanna', sans-serif;}
		.ng{font-family: 'Nanum Gothic', sans-serif;}
		.nm{font-family: 'Nanum Myeongjo', serif;}
		.jh{font-family: 'Jeju Hallasan', cursive;}
		.ngc{font-family: 'Nanum Gothic Coding', monospace;}
		
	</style>
</head>

<body>

	<?$layout -> head();?>
	<!--/header-->

	<?$layout -> menu();?>
	<!--//menu-->

	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="index.php">Home</a>
		</li>
		<li class="breadcrumb-item active">Signin
		</li>
	</ol>
	<!--/main-->
	<section class="banner-bottom">
		<div class="container">
			<div class="centered">
				<h2 class="jh">회원가입</h2>
			</div>
			<div class="row inner-sec">
				<div class="login p-5 bg-dark mx-auto mw-auto">
					<form action="./API/api_register.php" name="register_form" method="post" onsubmit="return checkValue()" >
						
						<div class="form-low">
							<div for="id" class ="jh"style='color:white'>아이디</div>
							<input type="text" class="form-control" id="id" name="id" maxlength="12"  onkeydown = "inputcheck()"placeholder="5~12자의 영문 대소문자, 숫자만 사용가능 합니다." required>
							
							<button type="button" class="btn btn-primary submit mb-auto" value ="중복확인" name="" onclick="possibleid()"style="margin: 10px 20px 0 0;">중복확인</button>
							<input type = "hidden" name = "idDuplication"  class="btn btn-primary submit mb-4" value = "iduncheck">
						</div>
					
					
					
						<div class="form-low">
							<div for="nick"  class ="jh" style='color:white; margin: 20px 0 0 0;'>닉네임</div>
							<input type="text" class="form-control" id="nick"name="nick" maxlength="15" placeholder="2~15자의 영문 대소문자, 숫자만 사용가능 합니다." onkeydown = "inputcheck()" required>
							
							<button type="button" class="btn btn-primary submit mb-auto" value ="중복확인" name="" onclick="possiblenick()"style="margin: 10px 0 0 0;">중복확인</button>
							<input type = "hidden" name = "nickDuplication"  class="btn btn-primary submit mb-4" value = "nickuncheck">
						</div>
						
					
						<div class="form group">
							<label for="exampleInputPassword1 mb-2" class ="jh"style="margin: 20px 0 0 0;">비밀번호</label>
							<input type="password" class="form-control" name="pass" maxlength="12" onkeyup="check_pw_value()"  required>
							<div id="check_p1" style="margin: 0 0 15px 0;"></div>
							<label for="exampleInputPassword2 mb-2" class ="jh">비밀번호 확인</label>
							<input type="password" class="form-control" name="pass2"  maxlength="12" onkeyup="check_pw(this.value)" required>
							<div id="check" style="margin: 0 0 15px 0;"></div>
						</div>
			
						<div class="form group">
							<label for="email" class ="jh">E_mail</label>
							<input type="text" class="form-control" id="email" name="email" placeholder="이메일 형식에 맞게 작성해주세요." required>
							<button type="button" class="btn btn-primary submit mb-4" name="" onclick="possibleemail()"style="margin: 10px 0 0 0;">인증번호 보내기</button>
							<input type = "hidden" name = "emailDuplication"  class="btn btn-primary submit mb-4" >
						</div>		

						<div class = 'centered'>
							<button  class="btn btn-primary submit mb-auto" value= "회원가입"style="width:395.05px; margin : 20px 0 0 0;" >회 원 가 입  </button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</section>
	<!--//main-->
	<!--footer-->
	<?$layout->footer();?>
	<!---->
	<!-- js -->
	<script src="js/jquery-2.2.3.min.js"></script>
	<!-- //js -->
	<!-- password-script -->
	<script>
		function check_pw(val){
			var du = document.register_form;
			var ogpass = du.pass.value;
			var same = "<span style='color:green;'>비밀번호가 일치합니다.</span>";
			var diff = "<span style='color:red;'>비밀번호가 일치하지 않습니다.</span>";
			if(ogpass == val){
				document.getElementById("check").innerHTML = same;
			}else if(ogpass != val){
				document.getElementById("check").innerHTML = diff;
			}
			
		}
		function check_pw_value(){
			var du = document.register_form;
			var pass = du.pass.value;

			if(pass.length<4||pass.length>12){
				document.getElementById("check_p1").innerHTML ="<span style='color:red;'>비밀번호는 4~12자 입니다.</span>";
		
			}else{
				document.getElementById("check_p1").innerHTML ="<span style='color:green;'>비밀번호 형식이 맞습니다.</span>";
			}

		}
	</script>
	<!-- //password-script -->
    <!-- /js files -->
	<link href='css/aos.css' rel='stylesheet prefetch' type="text/css" media="all" />
	<link href='css/aos-animation.css' rel='stylesheet prefetch' type="text/css" media="all" />
	<script src='js/aos.js'></script>
	<script src="js/aosindex.js"></script>
	<!-- //js files -->
	<!--/ start-smoth-scrolling -->
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>
	
	<!--// end-smoth-scrolling -->

<script>
    function possibleid(){ 
		var du = document.register_form
		var id = du.id.value;
		var reg_exp = new RegExp("^[a-zA-Z][a-zA-Z0-9]{5,12}$","g");
		var match_id = reg_exp.exec(id);
		

		if(!id){
			alert('아이디를 입력해주세요.');
		    du.id.focus();
		    return false;
		}     
		if(id.length<5||id.length>12){
			alert("아이디는 5자 이상 12자 이하 입니다.");
			du.id.focus();
			return false;
		}
		
		if(match_id==null){
			alert("아이디의 첫글자는 영문으로 시작하면 영어와 숫자 조합만 가능합니다.");
			du.id.focus();
			return false;
		}
		var url = "./API/checkid.php?id="+id;     
		window.open(url,'아이디 중복','width=450,height=150,left=500');     
	}

	function possiblenick(){ 
		var du = document.register_form;
        var nick = du.nick.value;    
		var reg_exp = new RegExp("^[a-zA-Z][a-zA-Z0-9]{5,12}$","g");
		var match_nick = reg_exp.exec(nick);

		if(!nick){
			alert('닉네임를 입력해주세요.');
			du.nick.focus();
			return false;

		}
		if(nick.length<2||nick.length>15){
			alert("닉네임은 2자 이상 15자 이하 입니다.");
			du.nick.focus();
			return false;
		}
		
		
		var url = "./API/checknick.php?nick="+nick;     
		window.open(url,'닉네임 중복','width=450,height=150,left=500');
	}

	function possibleemail(){ 
		var du = document.register_form
		var email = du.email.value;
		var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{1,20}$/;
		var reg_exp = new RegExp(pattern,"i");
		var match_email = reg_exp.exec(email);
		

		if(!email){
			alert('이메일을 입력해주세요.');
		    du.email.focus();
		    return false;
		}     
		
		
		if(match_email==null){
			alert("이메일 형식이 맞지 않습니다.");
			du.email.focus();
			return false;
		}
			var url = "./API/email_cer.php?email="+email;
			window.open(url,'이메일 인증','width=450,height=150,left=500');
			
			
		
	}



	function checkValue(){

		var form = document.register_form;
	
		if(!form.id.value){
			alert("아이디를 입력하세요.");
			return false;
		}
		
		
		if(form.idDuplication.value != "idCheck"){
			alert("아이디 중복체크를 해주세요.");
			return false;
		}

		
		if(!form.nick.value){
			alert("닉네임을 입력하세요.");
			return false;
		}
		if(form.nickDuplication.value != "nickCheck"){
			alert("닉네임을 중복체크를 해주세요.");
			return false;
		}
		
		
	}
    
        
        // 아이디 중복체크 화면open

 
        // 아이디 입력창에 값 입력시 hidden에 idUncheck를 세팅한다.
        // 이렇게 하는 이유는 중복체크 후 다시 아이디 창이 새로운 아이디를 입력했을 때
        // 다시 중복체크를 하도록 한다.
    function inputChk(){
            document.register_form.idDuplication.value ="idUncheck";
			document.register_form.nickDuplication.value ="nickUncheck";
	}
	
	function check_pw(val){
    
		var du = document.register_form;
		var ogpass = du.pass.value;
		var same = "<span style='color:green;'>비밀번호가 일치합니다.</span>";
		var diff = "<span style='color:red;'>비밀번호가 일치하지 않습니다.</span>";
    
		if(ogpass == val){
			document.getElementById("check").innerHTML = same;
		}else if(ogpass != val){
			document.getElementById("check").innerHTML = diff;
		}      
	}
	
	
			
</script>


</body>

</html>
