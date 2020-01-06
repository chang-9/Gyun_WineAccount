<?
  require_once '../dbconn.php';

  $conn = new DBC();

  $date = date('Y-m-d H:i:s');
  $code = 'N'.date("YmdHis");

  if(isset($_POST['date_from'])) {
    $date_from = $_POST['date_from'];
  }
  if(isset($_POST['manager'])) {
    $manager = $_POST['manager'];
  }
  if(isset($_POST['company'])) {
    $company = $_POST['company'];
  }
  if(isset($_POST['warehouse'])) {
    $warehouse = $_POST['warehouse'];
  }
  if(isset($_POST['store'])) {
    $store = $_POST['store'];
  }
  if(isset($_POST['date_to'])) {
    $store = $_POST['date_to'];
  }
  if(isset($_POST['memo'])) {
    $memo = $_POST['memo'];
  }
  if(isset($_POST['total_price'])) {
    $total_price = $_POST['total_price'];
  }

  //상세
  if(isset($_POST['product_code'])) {
    $product_code = $_POST['product_code'];
    $r_product_code = array_values(array_filter(array_map('trim',$product_code)));
  }
  if(isset($_POST['product_name'])) {
    $product_name = $_POST['product_name'];
    $r_product_name = array_values(array_filter(array_map('trim',$product_name)));
  }
  if(isset($_POST['sup_price'])) {
    $sup_price = $_POST['sup_price'];
    $r_sup_price = array_values(array_filter(array_map('trim',$sup_price)));
  }
  if(isset($_POST['in_out_cnt'])) {
    $in_out_cnt = $_POST['in_out_cnt'];
    $r_in_out_cnt = array_values(array_filter(array_map('trim',$in_out_cnt)));
  }
  if(isset($_POST['surtax'])) {
    $surtax = $_POST['surtax'];
    $r_surtax = array_values(array_filter(array_map('trim',$surtax)));
  }
  if(isset($_POST['sale'])) {
    $sale = $_POST['sale'];
    $r_sale = array_values(array_filter(array_map('trim',$sale)));
  }
  if(isset($_POST['all_price'])) {
    $all_price = $_POST['all_price'];
    $r_all_price = array_values(array_filter(array_map('trim',$all_price)));
  }

  try{
    $conn->DBI();

    if($_POST['compare'] == 10) // 등록
    {
      for($i=0; $i<count($r_product_name); $i++)
      {
        $sql = "insert into depo_spend_detail(de_sp_cate,de_sp_code,product_code,product_name,in_out_cnt,sup_price,surtax,sale,all_price)
        values('고객','".$code."','".$r_product_code[$i]."','".$r_product_name[$i]."','".$r_in_out_cnt[$i]."','".$r_sup_price[$i]."','".$r_surtax[$i]."','".$r_sale[$i]."','".$r_all_price[$i]."')";
        $conn->DBQ($sql);
        $conn->DBE();
      }

      $cnt = count($r_product_name)-1;
      $pname = array_shift($r_product_name);
      if($cnt == 0)
      {
        $deTitle = $pname;
      }
      else if ($cnt > 0)
      {
        $deTitle = $pname . " " . "외" . " " . $cnt . "건";
      }

      if($_SESSION['id'] != null )
      {
        $sql = "select en_name from Account_member where idx = '".$_SESSION['id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $en_name = $conn->DBF();

        $sql = "insert into depo_spend(de_sp_name,de_sp_cate,de_sp_code,de_sp_date,in_out_m,com_name,store_name,ware_code,total_price,de_sp_flag,memo,insert_per,insert_day)
        values('".$deTitle."','고객','".$code."','".$date_from."','".$manager."','".$company."','".$store."','".$warehouse."','".$total_price."','1','".$memo."','".$en_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      else if($_SESSION['emp_id'] != null)
      {
        $sql = "select emp_name from wine_employee where idx = '".$_SESSION['emp_id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $emp_name = $conn->DBF();

        $sql = "insert into depo_spend(de_sp_name,de_sp_cate,de_sp_code,de_sp_date,in_out_m,com_name,store_name,ware_code,total_price,de_sp_flag,memo,insert_per,insert_day)
        values('".$deTitle."','고객','".$code."','".$date_from."','".$manager."','".$company."','".$store."','".$warehouse."','".$total_price."','1','".$memo."','".$emp_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      ?>
      <script type="text/javascript">alert("추가 되었습니다!");
      window.location.href="../../customer_sale.php"</script>
      <?
    }
    else if($_POST['compare'] == 20) // 수정
    {
      $sql = "delete from depo_spend_detail where de_sp_code = '".$dNo."'";
      $conn->DBQ($sql);
      $conn->DBE();

      for($i=0; $i<count($r_product_name); $i++)
      {
        $sql = "insert into depo_spend_detail(de_sp_cate,de_sp_code,product_code,product_name,in_out_cnt,sup_price,surtax,sale,all_price)
        values('고객','".$code."','".$r_product_code[$i]."','".$r_product_name[$i]."','".$r_in_out_cnt[$i]."','".$r_sup_price[$i]."','".$r_surtax[$i]."','".$r_sale[$i]."','".$r_all_price[$i]."')";
        $conn->DBQ($sql);
        $conn->DBE();
      }

      $cnt = count($r_product_name)-1;
      $pname = array_shift($r_product_name);
      if($cnt == 0)
      {
        $deTitle = $pname;
      }
      else if ($cnt > 0)
      {
        $deTitle = $pname . " " . "외" . " " . $cnt . "건";
      }

      if($_SESSION['id'] != null)
      {
        $sql = "select en_name from Account_member where idx = '".$_SESSION['id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $en_name = $conn->DBF();

        $sql = "update depo_spend set in_out_m='".$manager."',com_name='".$company."',store_name='".$store."',ware_code='".$warehouse."',total_price = '".$total_price."', memo='".$memo."',de_sp_name = '".$deTitle."', modify_per='".$en_name[0]."', modify_day='".$date."' where de_sp_code = '".$dNo."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      else if($_SESSION['emp_id'] != null)
      {
        $sql = "select emp_name from wine_employee where idx = '".$_SESSION['emp_id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $emp_name = $conn->DBF();

        $sql = "update depo_spend set in_out_m='".$manager."',com_name='".$company."',store_name='".$store."',ware_code='".$warehouse."',total_price = '".$total_price."',memo='".$memo."',de_sp_name='".$deTitle."',modify_per='".$emp_name[0]."',modify_day='".$date."' where de_sp_code = '".$dNo."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      ?>
      <script type="text/javascript">alert("수정 되었습니다!");
      window.location.href="../../customer_sale.php"</script>
      <?
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>
