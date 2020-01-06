<?
  require_once '../dbconn.php';

  $conn = new DBC();

  $idx = $_POST['c_idx'];

  $cus1 .= $_POST['txtMobile1'];
  $cus2 .= $_POST['txtMobile2'];
  $cus3 .= $_POST['txtMobile3'];
  $phone = $cus1 . "-" . $cus2 . "-" . $cus3;

  $name = $_POST['c_name'];

  $birth = $_POST['date_from'];

  try{
    $conn->DBI();

    $sql = "update wine_customer set cust_name = '".$name."', cust_age = '".$birth."', phone_num = '".$phone."' where idx='".$idx."'";
    $conn->DBQ($sql);
    $conn->DBE();


  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>

<script type="text/javascript">alert("수정 되었습니다.");

window.location.href="../../customer.php"</script>
