<?php
  require_once '../dbconn.php';

  $conn = new DBC();

  $dNo = $_POST['d_code'];

  $date = date('Y-m-d H:i:s');

  //기본 정보
  $input_date = $_POST['input_date'];
  $manager = $_POST['manager'];
  $company = $_POST['company'];
  $warehouse = $_POST['warehouse'];
  $store = $_POST['store'];
  $memo = $_POST['memo'];
  $total_price = $_POST['total_price'];
  $inout_code = $_POST['inout_code'];
  $input_money = $_POST['input_money'];

  //상세 정보
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

  try {
    $conn->DBI();

    $sql = "select * from wine_in_out where in_out_code = '".$inout_code."'";
    $conn->DBQ($sql);
    $conn->DBE();
    $row = $conn->DBF();

    $inMoney = number_format(preg_replace("/[^\d]/","",$row['de_sp_price']) + $input_money);

    if($_POST['compare'] == '입금')
    {
      if($_POST['detail'] == '10')
      {
        $sql = "delete from depo_spend_detail where de_sp_code = '".$dNo."'";
        $conn->DBQ($sql);
        $conn->DBE();

        for($i=0; $i<count($r_product_name); $i++)
        {
          $sql = "insert into depo_spend_detail(de_sp_cate,de_sp_code,product_name,all_price)
          values('입금','".$dNo."','".$r_product_name[$i]."','".$r_all_price[$i]."')";
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
        window.location.href="../../deposit.php"</script>
        <?
      }
      else if($_POST['detail'] == '11')
      {
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

          $sql = "update depo_spend set in_out_m='".$manager."',com_name='".$company."',store_name='".$store."',ware_code='".$warehouse."', de_sp_price = '".$inMoney."', memo='".$memo."',de_sp_name = '".$deTitle."', modify_per='".$en_name[0]."', modify_day='".$date."' where de_sp_code = '".$dNo."'";
          $conn->DBQ($sql);
          $conn->DBE();

          $sql = "update wine_in_out set de_sp_price = '".$inMoney."' where in_out_code = '".$inout_code."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }
        else if($_SESSION['emp_id'] != null)
        {
          $sql = "select emp_name from wine_employee where idx = '".$_SESSION['emp_id']."'";
          $conn->DBQ($sql);
          $conn->DBE();
          $emp_name = $conn->DBF();

          $sql = "update depo_spend set in_out_m='".$manager."',com_name='".$company."',store_name='".$store."',ware_code='".$warehouse."', de_sp_price = '".$inMoney."', memo='".$memo."',de_sp_name = '".$deTitle."', modify_per='".$en_name[0]."', modify_day='".$date."' where de_sp_code = '".$dNo."'";
          $conn->DBQ($sql);
          $conn->DBE();

          $sql = "update wine_in_out set de_sp_price = '".$inMoney."' where in_out_code = '".$inout_code."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }
        ?>
        <script type="text/javascript">alert("수정 되었습니다!");
        window.location.href="../../deposit.php"</script>
        <?
      }
    }

    else if($_POST['compare'] == '출금')
    {
      if($_POST['detail'] == '20')
      {
        $sql = "delete from depo_spend_detail where de_sp_code = '".$dNo."'";
        $conn->DBQ($sql);
        $conn->DBE();

        for($i=0; $i<count($r_product_name); $i++)
        {
          $sql = "insert into depo_spend_detail(de_sp_cate,de_sp_code,product_name,all_price)
          values('출금','".$dNo."','".$r_product_name[$i]."','".$r_all_price[$i]."')";
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
        window.location.href="../../spend.php"</script>
        <?
      }
      else if($_POST['detail'] == '21')
      {
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

          $sql = "update depo_spend set in_out_m='".$manager."',com_name='".$company."',store_name='".$store."',ware_code='".$warehouse."', de_sp_price = '".$inMoney."', memo='".$memo."',de_sp_name = '".$deTitle."', modify_per='".$en_name[0]."', modify_day='".$date."' where de_sp_code = '".$dNo."'";
          $conn->DBQ($sql);
          $conn->DBE();

          $sql = "update wine_in_out set de_sp_price = '".$inMoney."' where in_out_code = '".$inout_code."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }
        else if($_SESSION['emp_id'] != null)
        {
          $sql = "select emp_name from wine_employee where idx = '".$_SESSION['emp_id']."'";
          $conn->DBQ($sql);
          $conn->DBE();
          $emp_name = $conn->DBF();

          $sql = "update depo_spend set in_out_m='".$manager."',com_name='".$company."',store_name='".$store."',ware_code='".$warehouse."', de_sp_price = '".$inMoney."', memo='".$memo."',de_sp_name = '".$deTitle."', modify_per='".$en_name[0]."', modify_day='".$date."' where de_sp_code = '".$dNo."'";
          $conn->DBQ($sql);
          $conn->DBE();

          $sql = "update wine_in_out set de_sp_price = '".$inMoney."' where in_out_code = '".$inout_code."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }
        ?>
        <script type="text/javascript">alert("수정 되었습니다!");
        window.location.href="../../spend.php"</script>
        <?
      }
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>
