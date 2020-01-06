<?
  require_once '../dbconn.php';

  $conn = new DBC();

  try{
    $conn->DBI();

    $query = "SELECT * FROM wine_order";
	$conn->DBQ($query);
	$conn->DBE();
	$result = $conn->DBP();
	print_r ( $result);
  }
   catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
  }
?>