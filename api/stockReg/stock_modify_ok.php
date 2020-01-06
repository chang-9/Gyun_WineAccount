<?
  require_once '../dbconn.php';

  $conn = new DBC();

  $date = date('Y-m-d H:i:s');

  $input_date = $_POST['input_date'];
  $manager = $_POST['manager'];
  $company = $_POST['company'];
  $warehouse = $_POST['warehouse'];
  $store = $_POST['store'];
  $memo = $_POST['memo'];
  $inout_code = $_POST['inout_code'];
  $sNo = $_POST['stock_no'];
  $iNo = $_POST['inout_no'];

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

  try{
    $conn->DBI();

    $sql = "delete from stock_detail where stock_code = '".$sNo."'";
    $conn->DBQ($sql);
    $conn->DBE();

    if($_POST['compare'] == '입고')
    {
      for($i=0;$i<count($r_product_code); $i++)
      {
        $sql = "insert into stock_detail(stock_cate,stock_code,product_code,product_name,in_out_price,in_out_cnt,done_cnt)
        value('입고','".$sNo."','".$r_product_code[$i]."','".$r_product_name[$i]."','".$r_in_out_price[$i]."','".$r_in_out_cnt[$i]."','".$r_done_cnt[$i]."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update in_out_detail set done_cnt = '".$r_done_cnt[$i]."' where in_out_code = '".$iNo."' and product_code = '".$r_product_code[$i]."'";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_product set count = count_last + '".$r_in_out_cnt[$i]."' where product_code = '".$r_product_code[$i]."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }

      $pname = array_shift($r_product_name);
      $cnt = count($r_product_code)-1;
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
        $sql = "select en_name from Account_entrepreneur where idx = '".$_SESSION['id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $en_name = $conn->DBF();

        $sql = "update stock set in_out_m='".$manager."',com_name='".$company."',store_name='".$store."',ware_name='".$warehouse."', memo='".$memo."',stock_name = '".$deTitle."', modify_per='".$en_name[0]."', modify_day='".$date."' where stock_code = '".$sNo."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }
      ?>
      <script type="text/javascript">alert("수정 되었습니다!");
      window.location.href="../../stockInput.php"</script>
      <?
    }
    else if($_POST['compare'] == '출고')
    {
      for($i=0;$i<count($r_product_code); $i++)
      {
        $sql = "insert into stock_detail(stock_cate,stock_code,product_code,product_name,in_out_price,in_out_cnt,done_cnt)
        value('출고','".$sNo."','".$r_product_code[$i]."','".$r_product_name[$i]."','".$r_in_out_price[$i]."','".$r_in_out_cnt[$i]."','".$r_done_cnt[$i]."')";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update in_out_detail set done_cnt = '".$r_done_cnt[$i]."' where in_out_code = '".$iNo."' and product_code = '".$r_product_code[$i]."'";
        $conn->DBQ($sql);
        $conn->DBE();

        $sql = "update wine_product set count = count_last - '".$r_in_out_cnt[$i]."' where product_code = '".$r_product_code[$i]."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }

      $pname = array_shift($r_product_name);
      $cnt = count($r_product_code)-1;
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
        $sql = "select en_name from Account_entrepreneur where idx = '".$_SESSION['id']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $en_name = $conn->DBF();

        $sql = "update stock set in_out_m='".$manager."',com_name='".$company."',store_name='".$store."',ware_name='".$warehouse."', memo='".$memo."',stock_name = '".$deTitle."', modify_per='".$en_name[0]."', modify_day='".$date."' where stock_code = '".$sNo."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }

      ?>
      <script type="text/javascript">alert("수정 되었습니다!");
      window.location.href="../../stockOutput.php"</script>
      <?
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>
