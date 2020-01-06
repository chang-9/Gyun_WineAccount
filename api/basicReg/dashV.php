<?

$Year01 = date('Y-m').'-01';
$Year06 = date('Y-m').'-06';
$Year12 = date('Y-m').'-12';
$Year18 = date('Y-m').'-18';
$Year24 = date('Y-m').'-24';

$Year28 = date('Y-m').'-28'; // 2월
$Year29 = date('Y-m').'-29'; // 윤년
$Year30 = date('Y-m').'-30'; // 한달 30일
$Year31 = date('Y-m').'-31'; // 한달 31일

$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
$conn->DBI(); //DB 접속

//입금
if(date('m') == '1' or '3' or '5' or '7' or '8' or '10' or '12')
{
  $sql = "select idx from depo_spend where de_sp_date >= '".$Year01."' and de_sp_date <= '".$Year06."' and de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Dcnt1 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year06."' and de_sp_date <= '".$Year12."' and de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Dcnt2 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year12."' and de_sp_date <= '".$Year18."' and de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Dcnt3 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year18."' and de_sp_date <= '".$Year24."' and de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Dcnt4 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year24."' and de_sp_date <= '".$Year31."' and de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Dcnt5 = $conn->resultRow();
}
else if(date('m') == '4' or '6' or '9' or '11')
{
  $sql = "select idx from depo_spend where de_sp_date >= '".$Year01."' and de_sp_date <= '".$Year06."' and de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Dcnt1 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year06."' and de_sp_date <= '".$Year12."' and de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Dcnt2 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year12."' and de_sp_date <= '".$Year18."' and de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Dcnt3 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year18."' and de_sp_date <= '".$Year24."' and de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Dcnt4 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year24."' and de_sp_date <= '".$Year30."' and de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Dcnt5 = $conn->resultRow();
}

// 윤년 계산
else if(date('m') == '2')
{
  if((date('Y')%4) == 0 && (date('Y')%100) == 0)
  {
    $sql = "select idx from depo_spend where de_sp_date >= '".$Year01."' and de_sp_date <= '".$Year06."' and de_sp_cate = '입금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Dcnt1 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year06."' and de_sp_date <= '".$Year12."' and de_sp_cate = '입금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Dcnt2 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year12."' and de_sp_date <= '".$Year18."' and de_sp_cate = '입금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Dcnt3 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year18."' and de_sp_date <= '".$Year24."' and de_sp_cate = '입금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Dcnt4 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year24."' and de_sp_date <= '".$Year28."' and de_sp_cate = '입금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Dcnt5 = $conn->resultRow();
  }
  else if((date('Y')%4) == 0 && (date('Y')%100) != 0)
  {
    $sql = "select idx from depo_spend where de_sp_date >= '".$Year01."' and de_sp_date <= '".$Year06."' and de_sp_cate = '입금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Dcnt1 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year06."' and de_sp_date <= '".$Year12."' and de_sp_cate = '입금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Dcnt2 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year12."' and de_sp_date <= '".$Year18."' and de_sp_cate = '입금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Dcnt3 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year18."' and de_sp_date <= '".$Year24."' and de_sp_cate = '입금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Dcnt4 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year24."' and de_sp_date <= '".$Year29."' and de_sp_cate = '입금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Dcnt5 = $conn->resultRow();
  }
}

//출금
if(date('m') == '1' or '3' or '5' or '7' or '8' or '10' or '12')
{
  $sql = "select idx from depo_spend where de_sp_date >= '".$Year01."' and de_sp_date <= '".$Year06."' and de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Scnt1 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year06."' and de_sp_date <= '".$Year12."' and de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Scnt2 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year12."' and de_sp_date <= '".$Year18."' and de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Scnt3 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year18."' and de_sp_date <= '".$Year24."' and de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Scnt4 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year24."' and de_sp_date <= '".$Year31."' and de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Scnt5 = $conn->resultRow();
}
else if(date('m') == '4' or '6' or '9' or '11')
{
  $sql = "select idx from depo_spend where de_sp_date >= '".$Year01."' and de_sp_date <= '".$Year06."' and de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Scnt1 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year06."' and de_sp_date <= '".$Year12."' and de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Scnt2 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year12."' and de_sp_date <= '".$Year18."' and de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Scnt3 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year18."' and de_sp_date <= '".$Year24."' and de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Scnt4 = $conn->resultRow();

  $sql = "select idx from depo_spend where de_sp_date > '".$Year24."' and de_sp_date <= '".$Year30."' and de_sp_cate = '출금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $Scnt5 = $conn->resultRow();
}

// 윤년 계산
else if(date('m') == '2')
{
  if((date('Y')%4) == 0 && (date('Y')%100) == 0)
  {
    $sql = "select idx from depo_spend where de_sp_date >= '".$Year01."' and de_sp_date <= '".$Year06."' and de_sp_cate = '출금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Scnt1 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year06."' and de_sp_date <= '".$Year12."' and de_sp_cate = '출금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Scnt2 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year12."' and de_sp_date <= '".$Year18."' and de_sp_cate = '출금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Scnt3 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year18."' and de_sp_date <= '".$Year24."' and de_sp_cate = '출금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Scnt4 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year24."' and de_sp_date <= '".$Year28."' and de_sp_cate = '출금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Scnt5 = $conn->resultRow();
  }
  else if((date('Y')%4) == 0 && (date('Y')%100) != 0)
  {
    $sql = "select idx from depo_spend where de_sp_date >= '".$Year01."' and de_sp_date <= '".$Year06."' and de_sp_cate = '출금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Scnt1 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year06."' and de_sp_date <= '".$Year12."' and de_sp_cate = '출금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Scnt2 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year12."' and de_sp_date <= '".$Year18."' and de_sp_cate = '출금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Scnt3 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year18."' and de_sp_date <= '".$Year24."' and de_sp_cate = '출금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Scnt4 = $conn->resultRow();

    $sql = "select idx from depo_spend where de_sp_date > '".$Year24."' and de_sp_date <= '".$Year29."' and de_sp_cate = '출금'";
    $conn->DBQ($sql);
    $conn->DBE();
    $Scnt5 = $conn->resultRow();
  }
}
?>
