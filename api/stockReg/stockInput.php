<?
  require_once '../dbconn.php';

  $conn = new DBC();

  $date = date('Y-m-d H:i:s');

  $input_code = 'L'.date("YmdHis");
  $output_code = 'M'.date("YmdHis");

  if(isset($_POST['bidx']))
  {
    $bidx = $_POST['bidx'];
  }

  $date_from = $_POST['date_from'];
  $manager = $_POST['manager'];
  $company = $_POST['company'];
  $warehouse = $_POST['warehouse'];
  $store = $_POST['store'];
  $memo = $_POST['memo'];
  $inout_code = $_POST['inout_code'];

  //상세
  if(isset($_POST['product_code']))
  {
    $product_code = $_POST['product_code'];
    $r_product_code = array_values(array_filter(array_map('trim',$product_code)));
  }
  if(isset($_POST['product_name']))
  {
    $product_name = $_POST['product_name'];
    $r_product_name = array_values(array_filter(array_map('trim',$product_name)));
  }
  if(isset($_POST['in_out_price']))
  {
    $in_out_price = $_POST['in_out_price'];
    $r_in_out_price = array_values(array_filter(array_map('trim',$in_out_price)));
  }
  if(isset($_POST['in_out_cnt']))
  {
    $in_out_cnt = $_POST['in_out_cnt'];
    $r_in_out_cnt = array_values(array_filter(array_map('trim',$in_out_cnt)));
  }
  if(isset($_POST['done_cnt']))
  {
    $done_cnt = $_POST['done_cnt'];
    $r_done_cnt = array_values(array_filter(array_map('trim',$done_cnt)));
  }
  if(isset($_POST['p_idx']))
  {
    $p_idx = $_POST['p_idx'];
    $r_p_idx = array_values(array_filter(array_map('trim',$p_idx)));
  }

  try
  {
    $conn->DBI();
    if($_POST['compare'] == 10)
    {
      for($i=0;$i<count($r_product_code); $i++)
      {
        $sql = "insert into stock_detail(stock_cate,stock_code,product_code,product_name,in_out_price,in_out_cnt)
        value('입고','".$input_code."','".$r_product_code[$i]."','".$r_product_name[$i]."','".$r_in_out_price[$i]."','".$r_in_out_cnt[$i]."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_product set count_last = count, count = count + '".$r_in_out_cnt[$i]."' where product_code = '".$r_product_code[$i]."'";
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

        $sql = "insert into stock(stock_cate,stock_name,stock_code,in_out_m,com_name,ware_name,store_name,memo_flag,stock_date,memo,insert_per,insert_day)
        values('입고','".$deTitle."','".$input_code."','".$manager."','".$company."','".$warehouse."','".$store."','1','".$date_from."','".$memo."','".$en_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      else if($_SESSION['emp_id'] != null)
      {
        $sql = "select emp_name from wine_employee where idx = '".$_SESSION['emp_id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $emp_name = $conn->DBF();

        $sql = "insert into stock(stock_cate,stock_name,stock_code,in_out_m,com_name,ware_name,store_name,memo_flag,stock_date,memo,insert_per,insert_day)
        values('입고','".$deTitle."','".$input_code."','".$manager."','".$company."','".$warehouse."','".$store."','1','".$date_from."','".$memo."','".$emp_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      ?>
      <script type="text/javascript">alert("추가 되었습니다!");
      window.location.href="../../stockInput.php"</script>
      <?
    }

    else if($_POST['compare'] == 11)
    {
      for($i=0;$i<count($r_product_code); $i++)
      {
        $sql = "insert into stock_detail(stock_cate,stock_code,product_code,product_name,in_out_price,in_out_cnt,done_cnt)
        value('입고','".$input_code."','".$r_product_code[$i]."','".$r_product_name[$i]."','".$r_in_out_price[$i]."','".$in_out_cnt[$i]."','".$r_done_cnt[$i]."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update in_out_detail set done_cnt = done_cnt + '".$r_done_cnt[$i]."' where idx = '".$r_p_idx[$i]."'";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_product set count_last = count, count = count + '".$r_in_out_cnt[$i]."' where product_code = '".$r_product_code[$i]."'";
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

        $sql = "insert into stock(in_out_cate,in_out_code,stock_cate,stock_name,stock_code,in_out_m,com_name,ware_name,store_name,memo_flag,stock_date,memo,insert_per,insert_day)
        values('매입','".$inout_code."','입고','".$deTitle."','".$input_code."','".$manager."','".$company."','".$warehouse."','".$store."','1','".$date_from."','".$memo."','".$en_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_in_out set stock_cur = '1' where in_out_code = '".$inout_code."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      else if($_SESSION['emp_id'] != null)
      {
        $sql = "select emp_name from wine_employee where idx = '".$_SESSION['emp_id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $emp_name = $conn->DBF();

        $sql = "insert into stock(in_out_cate,in_out_code,stock_cate,stock_name,stock_code,in_out_m,com_name,ware_name,store_name,memo_flag,stock_date,memo,insert_per,insert_day)
        values('매입','".$inout_code."','입고','".$deTitle."','".$input_code."','".$manager."','".$company."','".$warehouse."','".$store."','1','".$date_from."','".$memo."','".$emp_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_in_out set stock_cur = '1' where in_out_code = '".$inout_code."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      ?>
      <script type="text/javascript">alert("추가 되었습니다!");
      window.location.href="../../stockInput.php"</script>
      <?
    }

    else if($_POST['compare'] == 20)
    {
      for($i=0;$i<count($r_product_code); $i++)
      {
        $sql = "insert into stock_detail(stock_cate,stock_code,product_code,product_name,in_out_price,in_out_cnt)
        value('출고','".$output_code."','".$r_product_code[$i]."','".$r_product_name[$i]."','".$r_in_out_price[$i]."','".$r_in_out_cnt[$i]."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_product set count_last = count, count = count - '".$r_in_out_cnt[$i]."' where product_code = '".$r_product_code[$i]."'";
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

        $sql = "insert into stock(stock_cate,stock_name,stock_code,in_out_m,com_name,ware_name,store_name,memo_flag,stock_date,memo,insert_per,insert_day)
        values('출고','".$deTitle."','".$output_code."','".$manager."','".$company."','".$warehouse."','".$store."','1','".$date_from."','".$memo."','".$en_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      else if($_SESSION['emp_id'] != null)
      {
        $sql = "select emp_name from wine_employee where idx = '".$_SESSION['emp_id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $emp_name = $conn->DBF();

        $sql = "insert into stock(stock_cate,stock_name,stock_code,in_out_m,com_name,ware_name,store_name,memo_flag,stock_date,memo,insert_per,insert_day)
        values('출고','".$deTitle."','".$output_code."','".$manager."','".$company."','".$warehouse."','".$store."','1','".$date_from."','".$memo."','".$emp_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      ?>
      <script type="text/javascript">alert("추가 되었습니다!");
      window.location.href="../../stockOutput.php"</script>
      <?
    }

    else if($_POST['compare'] == 21)
    {
      for($i=0;$i<count($r_product_code); $i++)
      {
        $sql = "insert into stock_detail(stock_cate,stock_code,product_code,product_name,in_out_price,in_out_cnt,done_cnt)
        value('출고','".$output_code."','".$r_product_code[$i]."','".$r_product_name[$i]."','".$r_in_out_price[$i]."','".$r_in_out_cnt[$i]."','".$r_done_cnt[$i]."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update in_out_detail set done_cnt = done_cnt + '".$r_done_cnt[$i]."' where idx = '".$r_p_idx[$i]."'";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_product set count_last = count, count = count - '".$r_in_out_cnt[$i]."' where product_code = '".$r_product_code[$i]."'";
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

        $sql = "insert into stock(in_out_cate,in_out_code,stock_cate,stock_name,stock_code,in_out_m,com_name,ware_name,store_name,memo_flag,stock_date,memo,insert_per,insert_day)
        values('매출','".$inout_code."','출고','".$deTitle."','".$output_code."','".$manager."','".$company."','".$warehouse."','".$store."','1','".$date_from."','".$memo."','".$en_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_in_out set stock_cur = '1' where in_out_code = '".$inout_code."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      else if($_SESSION['emp_id'] != null)
      {
        $sql = "select emp_name from wine_employee where idx = '".$_SESSION['emp_id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $emp_name = $conn->DBF();

        $sql = "insert into stock(in_out_cate,in_out_code,stock_cate,stock_name,stock_code,in_out_m,com_name,ware_name,store_name,memo_flag,stock_date,memo,insert_per,insert_day)
        values('매출','".$inout_code."','출고','".$deTitle."','".$output_code."','".$manager."','".$company."','".$warehouse."','".$store."','1','".$date_from."','".$memo."','".$emp_name[0]."','".$date."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_in_out set stock_cur = '1' where in_out_code = '".$inout_code."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      ?>
      <script type="text/javascript">alert("추가 되었습니다!");
      window.location.href="../../stockOutput.php"</script>
      <?
    }

  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>
