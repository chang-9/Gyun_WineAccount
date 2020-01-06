<?
	require_once '../dbconn.php';
	const PASSWORD_COST = ['cost'=>12];

	switch ($_POST['type']) {
		case "manager":
			if(isset($_POST['no'])){
				$no = $_REQUEST['no'];

				$query ="UPDATE Account_member
						 SET id = :id, password = :password, emp_name = :name, email = :email,
						     phone_num = :phone, emp_job = :job, emp_dept = :dept, memo = :memo,
							 basic_admin = :b_a, purchase_admin = :p_a, seil_admin = :s_a, in_out_admin = :i_o_a, stock_admin = :st_a, customer_admin = :c_a
						     WHERE idx = $no";

			}else{
				$query ="INSERT INTO Account_member(en_code, id, password, en_name, email, phone_num,
				                                    memo, basic_admin, purchase_admin, seil_admin, in_out_admin, stock_admin, customer_admin)
						 VALUES(:encode, :id, :pass, :name, :email, :phone, :memo, :b_a, :p_a, :s_a, :i_o_a, :st_a, :c_a)";
			}

			$complete = '<script>location.href="../../manager.php";</script>';//완료 후 이동페이지
			break;

		default:
			echo "<script>alert('잘못된 접근 입니다.');location.href='../../';</script>";
			break;
	}

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	try{

		$conn->DBQ($query); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)
		$conn->result->bindParam(':encode', $_SESSION["id"]); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':id', $id); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':pass', $pass); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':name', $name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':email', $email); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':phone', $phone); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':memo', $memo); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':b_a', $b_a); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':p_a', $p_a); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':s_a', $s_a); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':i_o_a', $i_o_a); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':st_a', $st_a); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':c_a', $c_a); //바인드 변수로 들어갈 변수 지정

		// UPDATE a row
		$phone .= $_POST['txtMobile1'];
		$phone .= $_POST['txtMobile2'];
		$phone .= $_POST['txtMobile3'];

		$id = $_POST['id'];
		$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT, PASSWORD_COST);
		$name = $_POST['name'];
		$email .= $_POST['email1'].'@';
		$email .= $_POST['email2'];
		$memo = $_POST['comment'];
		$b_a .=  $_POST['m1'];
		$p_a .=  $_POST['m2'];
		$s_a .=  $_POST['m3'];
		$i_o_a .=  $_POST['m4'];
		$st_a .=  $_POST['m5'];
		$c_a .=  $_POST['m6'];

		$conn->DBE();


        


        $query1 = "SELECT idx FROM Account_member ORDER BY idx  DESC limit 1";



		$conn->DBQ($query1);



		$conn->DBE($query1);

		$row = $conn->DBF();

		$sql = "SELECT * FROM Account_entrepreneur WHERE idx = '".$_SESSION['id']."'";
		$conn->DBQ($sql);
		$conn->DBE();
		$result = $conn->DBF();

 		
		
		
		$query2 ="INSERT INTO Account_relationship(entrepreneur_idx, member_idx, department, position)
						           VALUES(:id_a, :m_i, :dept, :job)";
		
		$conn->DBQ($query2);

		$conn->result->bindParam(':id_a', $id_a);
        $conn->result->bindParam(':m_i', $m_i); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':dept', $_POST['dept']); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':job', $_POST['job']);

		// INSERT a row
		$id_a .= $_SESSION['id'];
		$m_i = $row[0];
		


		$conn->DBE($query2);
		echo $complete;

        


	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}

	$conn->DBO(); // db객체 해제 (종료)
	

/*
echo $_POST['name']."<br/>";
echo $_POST['dept']."<br/>";

$phone .= $_POST['txtMobile1'].'-';
$phone .= $_POST['txtMobile2'].'-';
$phone .= $_POST['txtMobile3'];
echo $phone."<br/>";

echo $_POST['email']."<br/>";
echo $_POST['id']."<br/>";
echo $_POST['pass']."<br/>";
$auth .=  $_POST['m1'];
$auth .=  $_POST['m2'];
$auth .=  $_POST['m3'];
$auth .=  $_POST['m4'];
$auth .=  $_POST['m5'];
$auth .=  $_POST['m6'];
echo $auth."<br/>";
echo $_POST['comment']."<br/>";
*/
?>
