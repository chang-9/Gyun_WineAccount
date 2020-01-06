<?
// // 배열의 공백값 삭제
// $reduced_arr = array_values(array_filter(array_map('trim',$product_name)));
// // 공백값이 삭제된 배열의 갯수
// $cnt = count($reduced_arr);
// // 배열의 맨 위의 값 반환
// $rs = array_shift($reduced_arr);
//
// if($product_code != null && $product_name != null && $sup_price != null && $in_out_cnt != null && $sale != null && !=)
// {
//
// }
  require_once '../dbconn.php';

  $conn = new DBC();

  $date = date('Y-m-d H:i:s');
  $depo_code = 'J'.date("YmdHis");
  $spen_code = 'K'.date("YmdHis");

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

  // 2
  if(isset($_POST['input_money'])) {
    $input_money = number_format($_POST['input_money']);
  }
  if(isset($_POST['reamin_money'])) {
    $remain_money = $_POST['remain_money'];
  }
  if(isset($_POST['in_out_code'])) {
    $in_out_code = $_POST['in_out_code'];
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

  //CRUD 시작
  if($_POST['compare'] == 10) // depoositNew.php
  {
    try{
      $conn->DBI();

      for($i=0; $i<count($r_product_name); $i++)
      {
        $sql = "insert into depo_spend_detail(de_sp_cate,de_sp_code,product_name,all_price)
        values('입금','".$depo_code."','".$r_product_name[$i]."','".$r_all_price[$i]."')";
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
        values('".$deTitle."','입금','".$depo_code."','".$date_from."','".$manager."','".$company."','".$store."','".$warehouse."','".$total_price."','1','".$memo."','".$en_name[0]."','".$date."')";
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
        values('".$deTitle."','입금','".$depo_code."','".$date_from."','".$manager."','".$company."','".$store."','".$warehouse."','".$total_price."','1','".$memo."','".$emp_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      ?>
      <script type="text/javascript">alert("추가 되었습니다!");
      window.location.href="../../deposit.php"</script>
      <?

    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  else if($_POST['compare'] == 11) // depoositNew2.php
  {
    try
    {
      $conn->DBI();

      for($i=0; $i<count($r_product_code); $i++)
      {
        $sql = "insert into depo_spend_detail(de_sp_cate,de_sp_code,product_code,product_name,in_out_cnt,sup_price,surtax,sale,all_price)
        values('입금','".$depo_code."','".$r_product_code[$i]."','".$r_product_name[$i]."','".$r_in_out_cnt[$i]."','".$r_sup_price[$i]."','".$r_surtax[$i]."','".$r_sale[$i]."','".$r_all_price[$i]."')";
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

        $sql = "insert into depo_spend(de_sp_name,in_out_cate,in_out_code,de_sp_cate,de_sp_code,de_sp_date,in_out_m,com_name,store_name,ware_code,de_sp_price,total_price,de_sp_flag,memo,insert_per,insert_day)
        values('".$deTitle."','매출','".$in_out_code."','입금','".$depo_code."','".$date_from."','".$manager."','".$company."','".$store."','".$warehouse."','".$input_money."','".$total_price."','1','".$memo."','".$en_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_in_out set de_sp_price = '".$input_money."' where in_out_code = '".$in_out_code."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      else if($_SESSION('emp_id') != null)
      {
        $sql = "select emp_name from wine_employee where idx = '".$_SESSION['emp_id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $emp_name = $conn->DBF();

        $sql = "insert into depo_spend(de_sp_name,in_out_cate,in_out_code,de_sp_cate,de_sp_code,de_sp_date,in_out_m,com_name,store_name,ware_code,de_sp_price,total_price,de_sp_flag,memo,insert_per,insert_day)
        values('".$deTitle."','매출','".$in_out_code."','입금','".$deTitle."','".$date_from."','".$manager."','".$company."','".$store."','".$warehouse."','".$input_money."','".$total_price."','1','".$memo."','".$emp_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_in_out set de_sp_price = '".$input_money."' where in_out_code = '".$in_out_code."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }

    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    ?>
    <script type="text/javascript">alert("추가 되었습니다!");
    window.location.href="../../deposit.php"</script>
    <?
  }

  else if($_POST['compare'] == 20)
  {
    try{
      $conn->DBI();
      for($i=0; $i<count($r_product_name); $i++)
      {
        $sql = "insert into depo_spend_detail(de_sp_cate,de_sp_code,product_name,all_price)
        values('출금','".$spen_code."','".$r_product_name[$i]."','".$r_all_price[$i]."')";
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

        $sql = "insert into depo_spend(de_sp_name,de_sp_cate,de_sp_code,de_sp_date,in_out_m,com_name,store_name,ware_code,total_price,de_sp_flag,memo,insert_per,insert_day)
        values('".$deTitle."','출금','".$spen_code."','".$date_from."','".$manager."','".$company."','".$store."','".$warehouse."','".$total_price."','1','".$memo."','".$en_name[0]."','".$date."')";
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
        values('".$deTitle."','출금','".$spen_code."','".$date_from."','".$manager."','".$company."','".$store."','".$warehouse."','".$total_price."','1','".$memo."','".$emp_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();
      }

    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    ?>
    <script type="text/javascript">alert("추가 되었습니다!");
    window.location.href="../../spend.php"</script>
    <?
  }

  else if($_POST['compare'] == 21)
  {
    try{

      $conn->DBI();

      for($i=0; $i<count($r_product_code); $i++)
      {
        $sql = "insert into depo_spend_detail(de_sp_cate,de_sp_code,product_code,product_name,in_out_cnt,sup_price,surtax,sale,all_price)
        values('출금','".$spen_code."','".$r_product_code[$i]."','".$r_product_name[$i]."','".$r_in_out_cnt[$i]."','".$r_sup_price[$i]."','".$r_surtax[$i]."','".$r_sale[$i]."','".$r_all_price[$i]."')";
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

        $sql = "insert into depo_spend(de_sp_name,in_out_cate,in_out_code,de_sp_cate,de_sp_code,de_sp_date,in_out_m,com_name,store_name,ware_code,de_sp_price,total_price,de_sp_flag,memo,insert_per,insert_day)
        values('".$deTitle."','매입','".$in_out_code."','출금','".$spen_code."','".$date_from."','".$manager."','".$company."','".$store."','".$warehouse."','".$input_money."','".$total_price."','1','".$memo."','".$en_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_in_out set de_sp_price = '".$input_money."' where in_out_code = '".$in_out_code."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      else if($_SESSION['emp_id'] != null)
      {
        $sql = "select emp_name from wine_employee where idx = '".$_SESSION['emp_id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $emp_name = $conn->DBF();

        $sql = "insert into depo_spend(de_sp_name,in_out_cate,in_out_code,de_sp_cate,de_sp_code,de_sp_date,in_out_m,com_name,store_name,ware_code,de_sp_price,total_price,de_sp_flag,memo,insert_per,insert_day)
        values('".$deTitle."','매입','".$in_out_code."','출금','".$spen_code."','".$date_from."','".$manager."','".$company."','".$store."','".$warehouse."','".$input_money."','".$total_price."','1','".$memo."','".$emp_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_in_out set de_sp_price = '".$input_money."' where in_out_code = '".$in_out_code."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }

    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    ?>
    <script type="text/javascript">alert("추가 되었습니다!");
    window.location.href="../../spend.php"</script>
    <?
  }
?>
