

<html>
<head>
<title>www.webmadang.net</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">
var p1 = /^[0-9a-z_]*$/i; // 영문숫자 패턴
var p2 = /\s/; // 공백문자 패턴
var p3 = /(\S+)@(\S+)\.(\S+)/; //이메일 패턴

function formCheck(){
  
  var frm = document.form;
  // 아이디 체크
  if( !p1.exec(frm.uid.value) || frm.uid.value.length < 8 ){
      alert("아이디는 8자 이상의 공백없는 영문과 숫자로만 구성됩니다!!");
      frm.uid.focus();
      return;
  }

  // 이름 체크
  if( p2.exec(frm.name.value) || frm.name.value.length == 0  ){
     alert("이름을 공백없이 입력해 주세요!!");
     frm.name.focus();
     return;
  }

  //-- 이메일 체크
  if( !p3.exec(frm.email.value) ){
       alert("옳바른 이메일 주소가 아닙니다!!!이메일 주소를 확인하세요");
       frm.email.focus();
       return;
  }
  
  alert("모든 항목을 훌륭하게 입력하셨습니다.");

}
</script>
</head>
<body>
<form name="form">
<table width="300" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="70">아이디</td>
    <td width="230">
      <input type="text" name="uid" size="30">
    </td>
  </tr>
  <tr> 
    <td>이 름</td>
    <td>
     <input type="text" name="name" size="30">
    </td>
  </tr>
  <tr> 
    <td>이메일</td>
    <td>
     <input type="text" name="email" size="30">
    </td>
  </tr>
  <tr> 
    <td colspan="2" align="center">
     <input type="button" name="button" value="확인" onClick="formCheck();">
    </td>
  </tr>
</table>
</form>
</body>
</html>
