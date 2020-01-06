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

		
		//	$complete = '<script>location.href="../../orderbook.php";</script>';//완료 후 이동페이지

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	



	try{
		
		

		if(isset($_POST['no'])){
			$no = $_REQUEST['no'];
			
			$in_out_code = $_POST['in_out_code'];
			$order_code = $_POST['order_code'];
			$in_out_cate = $_POST['in_out_cate'];
			$com_code = $_POST['com_code'];
			$com_name = $_POST['com_name'];
			$m_name = $_POST['m_name'];
			$store_name = $_POST['store_name'];
			$input_date = $_POST['input_date'];
			$due_date = $_POST['due_date'];
			$in_out_state = $_POST['in_out_state'];
			$ware_code = $_POST['ware_code'];
			$in_out_flag = $_POST['in_out_flag'];
			$memo = $_POST['memo'];
			$total_price = $_POST['total_price'];
		 

			
			$query ="UPDATE wine_in_out
					 SET in_out_code=:in_out_code, order_code  = :order_code,  in_out_cate = :in_out_cate, in_out_name=:in_out_name, com_code = :com_code, com_name = :com_name, store_name = :store_name,  m_name = :m_name, input_date = :input_date, due_date = :due_date, in_out_state = :in_out_state, ware_code = :ware_code, in_out_flag = :in_out_flag, memo = :memo, total_price = :total_price WHERE idx = $no";

			$query2 = "delete from in_out_detail where in_out_code = '".$in_out_code."'";
			$conn->DBQ($query2);
			$conn->DBE();

			 for($i=0; $i<count($r_product_code); $i++) {
				 $sql = "INSERT INTO in_out_detail(in_out_code, in_out_cate, product_code, product_name, unit_price, in_out_cnt, sup_price, surtax, sale, all_price)
						 VALUES('".$in_out_code."', '".$in_out_cate."', '".$r_product_code[$i]."', '".$r_product_name[$i]."', '".$r_unit_price[$i]."', '".$r_in_out_cnt[$i]."', '".$r_sup_price[$i]."', '".$r_surtax[$i]."', '".$r_sale[$i]."', '".$r_all_price[$i]."')";


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

			$conn->result->bindParam(':in_out_code', $in_out_code); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':in_out_name', $deTitle); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':order_code', $order_code); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':in_out_cate', $in_out_cate); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':com_code', $com_code); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':com_name', $com_name); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':store_name', $store_name); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':m_name', $m_name); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':input_date', $input_date); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':due_date', $due_date); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':in_out_state', $in_out_state); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':ware_code', $ware_code); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':in_out_flag', $in_out_flag); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':memo', $memo); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':total_price', $total_price); //바인드 변수로 들어갈 변수 지정


			$conn->DBE();

			switch ($in_out_cate) {
					case "매입":
						?>
						<script type="text/javascript">alert("수정되었습니다.");
						window.location.href="../../purchase.php"</script>
						<?

						break;
					case "매출":
						?>
						<script type="text/javascript">alert("수정되었습니다.");
					window.location.href="../../sale.php"</script>
					<?
						break;
					}
				




		}else{

			$in_out_code = 'G'.date("YmdHis");
			$order_code = $_POST['order_code'];
			$in_out_cate = $_POST['in_out_cate'];
			$com_code = $_POST['com_code'];
			$com_name = $_POST['com_name'];
			$m_name = $_POST['m_name'];
			$store_name = $_POST['store_name'];
			$input_date = $_POST['input_date'];
			$due_date = $_POST['due_date'];
			$in_out_state = $_POST['in_out_state'];
			$ware_code = $_POST['ware_code'];
			$in_out_flag = $_POST['in_out_flag'];
			$memo = $_POST['memo'];
			$total_price = $_POST['total_price'];
			
	

			$query ="INSERT INTO wine_in_out(in_out_code,order_code, in_out_cate, in_out_name, com_code, com_name, store_name, m_name, input_date,due_date, in_out_state, ware_code, in_out_flag, memo, total_price)
					 VALUES(:in_out_code,:order_code, :in_out_cate,:in_out_name, :com_code, :com_name, :store_name, :m_name, :input_date ,:due_date, :in_out_state, :ware_code, :in_out_flag, :memo,:total_price)";

			


			for($i=0; $i<count($r_product_code); $i++) {
			 $sql = "INSERT INTO in_out_detail(in_out_code, in_out_cate, product_code, product_name, unit_price, in_out_cnt, sup_price, surtax, sale, all_price)
					 VALUES('".$in_out_code."', '".$in_out_cate."', '".$r_product_code[$i]."', '".$r_product_name[$i]."', '".$r_unit_price[$i]."', '".$r_in_out_cnt[$i]."', '".$r_sup_price[$i]."', '".$r_surtax[$i]."', '".$r_sale[$i]."', '".$r_all_price[$i]."')";

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


		$conn->result->bindParam(':in_out_name', $deTitle); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':in_out_code', $in_out_code);
		$conn->result->bindParam(':order_code', $order_code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':in_out_cate', $in_out_cate); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':com_code', $com_code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':com_name', $com_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':store_name', $store_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':m_name', $m_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':input_date', $input_date); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':due_date', $due_date); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':in_out_state', $in_out_state); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':ware_code', $ware_code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':in_out_flag', $in_out_flag); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':memo', $memo); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':total_price', $total_price); //바인드 변수로 들어갈 변수 지정



		// UPDATE a row




		$conn->DBE();

		switch ($in_out_cate) {
					case "매입":
						?>
						<script type="text/javascript">alert("추가되었습니다.");
						window.location.href="../../purchase.php"</script>
						<?

						break;
					case "매출":
						?>
						<script type="text/javascript">alert("추가되었습니다.");
					window.location.href="../../sale.php"</script>
					<?
						break;
					}
				

		}

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();

	}


?>
