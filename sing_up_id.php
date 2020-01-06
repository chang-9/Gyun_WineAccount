<?
include("mysql.php");

/*아이디 중복 확인*/
$idch=$_GET["q"];
 
//회원 정보 테이블
$membership_info2 = "SELECT * FROM membership WHERE id='$idch'";
$membership_info2_result = mysqli_query($conn,$membership_info2);
$id_count=mysqli_num_rows($membership_info2_result);





 if($id_count==0){
	echo " 
                    <div class='form-group'>
                      
                      <div class='col-lg-10'>
					  <div id='id_chk' style='color: #4caf50; text-align:  center;'><b>ID 사용 가능합니다.<b></div>
					  
					  </div>
					  </div>
					  <input type='hidden' name='hidden_id' value='가능'>
					  ";
}else if($id_count==1){
	echo "         
                    <div class='form-group'>
                      
                      <div class='col-lg-10'>
					  <div id='id_chk' style='color:red; text-align:  center;'><b>ID 사용 불가능합니다.<b></div>
					  </div>
					  </div>
					  <input type='hidden' name='hidden_id' value='불가능'>";

}



    ?>