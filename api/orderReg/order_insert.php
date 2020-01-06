<?
	require_once '../dbconn.php';

		
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
	  if(isset($_POST['order_cnt'])) {
		$order_cnt = $_POST['order_cnt'];
		$r_order_cnt = array_values(array_filter(array_map('trim',$order_cnt)));
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

		
		//	$complete = '<script>location.href="../../orderbook.php";</script>';//완료 후 이동페이지

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	



	try{
		if(isset($_POST['no'])){
			$no = $_REQUEST['no'];
			
			$order_code = $_POST['order_code'];
			$order_cate = $_POST['order_cate'];
			$com_code = $_POST['com_code'];
			$com_name = $_POST['com_name'];
			$m_name = $_POST['m_name'];
			$store_name = $_POST['store_name'];
			$input_date = $_POST['input_date'];
			$due_date = $_POST['due_date'];
			$order_state = $_POST['order_state'];
			$ware_code = $_POST['ware_code'];
			$order_flag = $_POST['order_flag'];
			$memo = $_POST['memo'];
		 

			
			$query ="UPDATE wine_order
					 SET order_code  = :order_code,  order_cate = :order_cate, order_name=:order_name, com_code = :com_code, com_name = :com_name, store_name = :store_name,  m_name = :m_name, input_date = :input_date, due_date = :due_date, order_state = :order_state, ware_code = :ware_code, order_flag = :order_flag, memo = :memo WHERE idx = $no";

			$query2 = "delete from order_detail where order_code = '".$order_code."'";
			$conn->DBQ($query2);
			$conn->DBE();

			 for($i=0; $i<count($r_product_code); $i++) {
				 $sql = "INSERT INTO order_detail(order_code, order_cate, product_code, product_name, unit_price, order_cnt, sup_price, surtax, sale, all_price)
						 VALUES('".$order_code."', '".$order_cate."', '".$r_product_code[$i]."', '".$r_product_name[$i]."', '".$r_unit_price[$i]."', '".$r_order_cnt[$i]."', '".$r_sup_price[$i]."', '".$r_surtax[$i]."', '".$r_sale[$i]."', '".$r_all_price[$i]."')";

				$conn->DBQ($sql); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)
				$conn->DBE();
			 }
			$pname = array_shift($r_product_name);
			$cnt = count($r_product_code)-1;

		    if($cnt == 0){
			  $deTitle = $pname;
		    }

		    else if ($cnt > 0){
		   	  $deTitle = $pname . " " . "외" . " " . $cnt . "건";
		    }

			$conn->DBQ($query); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)
			$conn->result->bindParam(':order_name', $deTitle); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':order_code', $order_code); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':order_cate', $order_cate); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':com_code', $com_code); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':com_name', $com_name); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':store_name', $store_name); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':m_name', $m_name); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':input_date', $input_date); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':due_date', $due_date); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':order_state', $order_state); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':ware_code', $ware_code); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':order_flag', $order_flag); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':memo', $memo); //바인드 변수로 들어갈 변수 지정


			$conn->DBE();

			
			
			switch ($order_cate) {
				case "주문":
					?>
					<script type="text/javascript">alert("수정되었습니다.");
					window.location.href="../../order.php"</script>
					<?

					break;
				case "발주":
					?>
					<script type="text/javascript">alert("수정되었습니다.");
				window.location.href="../../orderbook.php"</script>
				<?
					break;
			}
		}else{

			$order_code = 'F'.date("YmdHis");
			$order_cate = $_POST['order_cate'];
			$com_code = $_POST['com_code'];
			$com_name = $_POST['com_name'];
			$m_name = $_POST['m_name'];
			$store_name = $_POST['store_name'];
			$input_date = $_POST['input_date'];
			$due_date = $_POST['due_date'];
			$order_state = $_POST['order_state'];
			$ware_code = $_POST['ware_code'];
			$order_flag = $_POST['order_flag'];
			$memo = $_POST['memo'];
			
	

			$query ="INSERT INTO wine_order(order_code, order_cate, order_name, com_code, com_name, store_name, m_name, input_date,due_date, order_state, ware_code, order_flag, memo)
					 VALUES(:order_code, :order_cate,:order_name, :com_code, :com_name, :store_name, :m_name, :input_date ,:due_date, :order_state, :ware_code, :order_flag, :memo)";

			


			for($i=0; $i<count($r_product_code); $i++) {
			  $sql = "INSERT INTO order_detail(order_code, order_cate, product_code, product_name, unit_price, order_cnt, sup_price, surtax, sale, all_price)
					 VALUES('".$order_code."', '".$r_order_cate."', '".$r_product_code[$i]."', '".$r_product_name[$i]."', '".$r_unit_price[$i]."', '".$r_order_cnt[$i]."', '".$r_sup_price[$i]."', '".$r_surtax[$i]."', '".$r_sale[$i]."', '".$r_all_price[$i]."')";

			  $conn->DBQ($sql); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)
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


		$conn->DBQ($query); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)


		$conn->result->bindParam(':order_name', $deTitle); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':order_code', $order_code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':order_cate', $order_cate); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':com_code', $com_code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':com_name', $com_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':store_name', $store_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':m_name', $m_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':input_date', $input_date); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':due_date', $due_date); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':order_state', $order_state); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':ware_code', $ware_code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':order_flag', $order_flag); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':memo', $memo); //바인드 변수로 들어갈 변수 지정



		// UPDATE a row




		$conn->DBE();

		switch ($order_cate) {
			case "주문":
				?>
				<script type="text/javascript">alert("추가되었습니다.");
				window.location.href="../../order.php"</script>
				<?

				break;
			case "발주":
				?>
				<script type="text/javascript">alert("추가되었습니다.");
			window.location.href="../../orderbook.php"</script>
			<?
				break;
			}
		}


	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();

	}


?>
