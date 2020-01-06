<?
  require_once '../dbconn.php';

  $conn = new DBC();

  if(isset($_POST['chk_info'])){
    $chk = $_POST['chk_info'];
  }
  try{
      $conn->DBI();

      if($_POST['compare'] == 10)
      {
        for($i=0; $i<count($chk); $i++)
        {
          $sql = "select in_out_code from depo_spend where de_sp_code = '".$chk[$i]."'";
          $conn->DBQ($sql);
          $conn->DBE();
          $row[$i] = $conn->DBF();

          $sql = "update wine_in_out set de_sp_price = '0' where in_out_code = '".$row[$i]['in_out_code']."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }

        for($j=0; $j<count($chk); $j++)
        {
          $sql = "delete from depo_spend_detail where de_sp_code = '".$chk[$j]."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }

        for($i=0; $i<count($chk); $i++)
        {
          $sql = "delete from depo_spend where de_sp_code = '".$chk[$i]."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }

        ?>
        <script type="text/javascript">alert("삭제 되었습니다!");
        window.location.href="../../deposit.php"</script>
        <?
      }
      else if($_POST['compare'] == 20)
      {
        for($i=0; $i<count($chk); $i++)
        {
          $sql = "select in_out_code from depo_spend where de_sp_code = '".$chk[$i]."'";
          $conn->DBQ($sql);
          $conn->DBE();
          $row[$i] = $conn->DBF();

          $sql = "update wine_in_out set de_sp_price = '0' where in_out_code = '".$row[$i]['in_out_code']."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }
        
        for($j=0; $j<count($chk); $j++)
        {
          $sql = "delete from depo_spend_detail where de_sp_code = '".$chk[$j]."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }

        for($i=0; $i<count($chk); $i++)
        {
          $sql = "delete from depo_spend where de_sp_code = '".$chk[$i]."'";
          $conn->DBQ($sql);
          $conn->DBE();
        }

        $sql = "update wine_in_out set de_sp_price = '0'";
        $conn->DBQ($sql);
        $conn->DBE();

        ?>
        <script type="text/javascript">alert("삭제 되었습니다!");
        window.location.href="../../spend.php"</script>
        <?
      }

    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }
?>
