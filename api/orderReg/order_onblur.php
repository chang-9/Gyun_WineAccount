<?
  require_once '../dbconn.php';

  $conn = new DBC();
  $product_code =$_GET['product_code'];

  try{
    $conn->DBI();

    $query = "SELECT * FROM wine_product WHERE product_code= '".$product_code."' ";
	$conn->DBQ($query);
	$conn->DBE();
	$row = $conn->DBF();
	echo $row['product_name'];
  }
   catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
  }
?>