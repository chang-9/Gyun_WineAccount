<?

$conn = new DBC();
$conn->DBI();

$Y02 = date('Y').'-02-31';
$Y04 = date('Y').'-04-31';
$Y06 = date('Y').'-06-31';
$Y08 = date('Y').'-08-31';
$Y10 = date('Y').'-10-31';
$Y12 = date('Y').'-12-31';
$Y12_2 = date('Y')-1 .'-12-31';

//매입
$sql = "select idx from wine_in_out where input_date > '".$Y12_2."' and input_date <= '".$Y02."' and in_out_cate='매입'";
$conn->DBQ($sql);
$conn->DBE();
$inCnt1 = $conn->resultRow();

$sql = "select idx from wine_in_out where input_date > '".$Y02."' and input_date <= '".$Y04."' and in_out_cate='매입'";
$conn->DBQ($sql);
$conn->DBE();
$inCnt2 = $conn->resultRow();

$sql = "select idx from wine_in_out where input_date > '".$Y04."' and input_date <= '".$Y06."' and in_out_cate='매입'";
$conn->DBQ($sql);
$conn->DBE();
$inCnt3 = $conn->resultRow();

$sql = "select idx from wine_in_out where input_date > '".$Y06."' and input_date <= '".$Y08."' and in_out_cate='매입'";
$conn->DBQ($sql);
$conn->DBE();
$inCnt4 = $conn->resultRow();

$sql = "select idx from wine_in_out where input_date > '".$Y08."' and input_date <= '".$Y10."' and in_out_cate='매입'";
$conn->DBQ($sql);
$conn->DBE();
$inCnt5 = $conn->resultRow();

$sql = "select idx from wine_in_out where input_date > '".$Y10."' and input_date <= '".$Y12."' and in_out_cate='매입'";
$conn->DBQ($sql);
$conn->DBE();
$inCnt6 = $conn->resultRow();


// 매출
$sql = "select idx from wine_in_out where input_date > '".$Y12_2."' and input_date <= '".$Y02."' and in_out_cate='매출'";
$conn->DBQ($sql);
$conn->DBE();
$outCnt1 = $conn->resultRow();

$sql = "select idx from wine_in_out where input_date > '".$Y02."' and input_date <= '".$Y04."' and in_out_cate='매출'";
$conn->DBQ($sql);
$conn->DBE();
$outCnt2 = $conn->resultRow();

$sql = "select idx from wine_in_out where input_date > '".$Y04."' and input_date <= '".$Y06."' and in_out_cate='매출'";
$conn->DBQ($sql);
$conn->DBE();
$outCnt3 = $conn->resultRow();

$sql = "select idx from wine_in_out where input_date > '".$Y06."' and input_date <= '".$Y08."' and in_out_cate='매출'";
$conn->DBQ($sql);
$conn->DBE();
$outCnt4 = $conn->resultRow();

$sql = "select idx from wine_in_out where input_date > '".$Y08."' and input_date <= '".$Y10."' and in_out_cate='매출'";
$conn->DBQ($sql);
$conn->DBE();
$outCnt5 = $conn->resultRow();

$sql = "select idx from wine_in_out where input_date > '".$Y10."' and input_date <= '".$Y12."' and in_out_cate='매출'";
$conn->DBQ($sql);
$conn->DBE();
$outCnt6 = $conn->resultRow();
?>
