<?
$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)

   try{
      $conn->DBI(); //DB 접속
$query ="select * from Account_member where id = '{$_POST['id']}' and permission = 1"; 
$result = $conn->fetchArray($query) 
if($conn->numRows()) 
{ 
    $arrpercode = explode("/", $result[perpage]); 
    $arrcnt    = count($arrpercode) - 1; 
} 
else 
{ 
 alertBox("로그인 하세요.", "location.href='../index.php'"); 
 exit; 
} 

// 사업자 권한 체크 
if($Permission != "1") 
{ 

// 일단은 접근권한이 없음 
  $permission = 0; 

// 누구나 접근 가능한 페이지 설정 
  $anypage[0] = "register_2.php"; 
  $anypage[1] = "../index.php"; 
  $anypage[2] = "logout.php"; 

// 현재페이지가 누구나 접근가능한 페이지인지 판단 
  for($i=0; $i<=2; $i++) 
  { 
    if($anypage[$i] == $PHP_SELF) 
    { 
      $permission = 1; 
      break; 
    } 
  } 


// 누구나 접근 가능한 페이지가 아닐 경우의 권한 체크 
  if($ispermission) 
  { 
    $perpage[0] = "../company.php";              $percode[0] = "001"; 
    $perpage[1] = "../orderbook.php";            $percode[1] = "010"; 
    $perpage[2] = "../order.php";                $percode[2] = "010"; 
    $perpage[3] = "../deposit.php";              $percode[3] = "010"; 
    $perpage[4] = "../stock.php";                $percode[4] = "010"; 

// 현재페이지의 페이지코드 찾기 
    for($i=0; $i<=4; $i++) 
    { 
      if($perpage[$i] == $PHP_SELF) 
      { 
        $currpercode = $percode[$i]; 
        break; 
      } 
    } 

// 현재페이지코드와 관리자의 접근페이지코드가 일치하는지 판단 
    for($i=0; $i<$arrcnt; $i++) 
    { 
      if($arrpercode[$i] == $currpercode) 
      { 
        $permission = 1; 
        break; 
      } 
    } 
  } 

// 이 페이지에 대한 접근권한 없음 
  if(!$permission) 
  { 
    alertBox("사용권한이 없습니다", "history.back();"); 
    exit; 
  } 
} 
?>