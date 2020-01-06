<?
  require_once '../dbconn.php';

  if(isset($_POST['chk_info'])){
    $chk = $_POST['chk_info'];
  }

  $conn = new DBC();

  try{
    $conn->DBI();

    if($_POST['compare'] == 10)
    {
      for($i=0; $i<count($chk); $i++)
      {
        $sql = "select in_out_code from stock where stock_code = '".$chk[$i]."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $row[$i] = $conn->DBF();

        $sql = "update wine_in_out set stock_cur = '0' where in_out_code = '".$row[$i]['in_out_code']."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }

      for($i=0; $i<count($row); $i++)
      {
        $sql = "select * from in_out_detail where in_out_code = '".$row[$i]['in_out_code']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $row2[$i] = $conn->DBP();

        for($j=0; $j<count($row2[$i]); $j++)
        {
          $sql = "update wine_product set count = count - '".$row2[$i][$j]['in_out_cnt']."' where product_code = '".$row2[$i][$j]['product_code']."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }
      }

      for($j=0; $j<count($chk); $j++)
      {
        $sql = "delete from stock_detail where stock_code = '".$chk[$j]."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }

      for($i=0; $i<count($chk); $i++)
      {
        $query1 = "delete from stock where stock_code = '".$chk[$i]."'";
        $conn->DBQ($query1);
        $conn->DBE();
      }
      ?>
      <script type="text/javascript">alert("삭제 되었습니다!");
      window.location.href="../../stockInput.php"</script>
      <?
    }
    else if($_POST['compare'] == 20)
    {
      for($i=0; $i<count($chk); $i++)
      {
        $sql = "select in_out_code from stock where stock_code = '".$chk[$i]."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $row[$i] = $conn->DBF();

        $sql = "update wine_in_out set stock_cur = '0' where in_out_code = '".$row[$i]['in_out_code']."'";
        $conn->DBQ($sql);
        $conn->DBE();
      }

      for($i=0; $i<count($row); $i++)
      {
        $sql = "select * from in_out_detail where in_out_code = '".$row[$i]['in_out_code']."'";
        $conn->DBQ($sql);
        $conn->DBE();
        $row2[$i] = $conn->DBP();

        for($j=0; $j<count($row2[$i]); $j++)
        {
          $sql = "update wine_product set count = count + '".$row2[$i][$j]['in_out_cnt']."' where product_code = '".$row2[$i][$j]['product_code']."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }
      }

      for($i=0; $i<count($chk); $i++)
      {
        $query1 = "delete from stock where stock_code = '".$chk[$i]."'";
        $conn->DBQ($query1);
        $conn->DBE();
      }
      ?>
      <script type="text/javascript">alert("삭제 되었습니다!");
      window.location.href="../../stockOutput.php"</script>
      <?
    }

  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>
