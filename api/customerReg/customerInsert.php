<?
  require_once '../dbconn.php';

  $conn = new DBC();


 if(isset($_POST['cusname'])){
	$name=$_POST['cusname'];
 }

if(isset($_POST['txtMobile1'])){
	$cus1=$_POST['txtMobile1'];
}

if(isset($_POST['txtMobile2'])){
	$cus2=$_POST['txtMobile2'];

}

if(isset($_POST['txtMobile3'])){
	$cus3=$_POST['txtMobile3'];

}


if(isset($_POST['date_from'])){
	$cusage=$_POST['date_from'];
}

if(isset($_POST['bgo'])){
	$memo=$_POST['bgo'];

}

$phone = $cus1 . "-" . $cus2 . "-" . $cus3;




  try{
      $conn->DBI();

      $query = "insert into wine_customer(cust_name, phone_num, cust_age, memo) 
    	values('".$name."','".$phone."','".$cusage."','".$memo."')";
    	$conn->DBQ($query);
    	$conn->DBE();


  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  $conn->DBO(); // db객체 해제 (종료)
?>

<script type="text/javascript">alert("고객이 추가 되었습니다.");
window.location.href="../../customer.php"</script>
