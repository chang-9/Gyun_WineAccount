<?
  require_once '../dbconn.php';

  $conn = new DBC();

  $idx = $_POST['c_idx'];
  $aid = $_POST['id'];
  $name = $_POST['name'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $code = $_POST['en_code'];
  $phone = $_POST['phone'];
  $phone2= $_POST['phone2'];
  $fax = $_POST['fax'];
  $work = $_POST['work'];
  $com = $_POST['company'];


  try{


    $conn->DBI();
	$sql = "update Account_entrepreneur set id = '".$aid."', email = '".$email."', address = '".$address."', en_code ='".$code."'
	where idx='".$idx."'";
	
    $conn->DBQ($sql);
    $conn->DBE();

	$sql = "update Account_entrepreneur set en_code ='".$code."', en_call_num ='".$phone."', en_fax_num='".$fax."', en_name='".$name."', en_work_type='".$work."', en_com_name='".$com."'
	
	where idx='".$idx."'"; 
    $conn->DBQ($sql);
    $conn->DBE();




  }catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }



?>




<script type="text/javascript">alert("수정 되었습니다");

window.location.href="../../mypagef.php"</script>  