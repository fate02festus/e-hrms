<?php
    include_once('include/config.php');
	if(ISSET($_POST['save_medicsect'])){	

		$id='7';
		$code='MS';
		//get last docno
		$qq = mysqli_query($conn, "SELECT * FROM `sys_master` where id='$id'") or die(mysqli_error());
		$ff = mysqli_fetch_array($qq);
		$lno=intval($ff['last_no'])+1;
		$ln=str_pad($lno, intval($ff['length']), "0", STR_PAD_LEFT);
		$itr_no=$code.$ln;

		$name= $_POST['name']; 
		$location = $_POST['location'];

		$q1 = $conn->query("SELECT * FROM `medicalsection` WHERE `id` = '$itr_no'") or die(mysqli_error());
		$f1 = $q1->fetch_array();
		$c1 = $q1->num_rows;
			if($c1 > 0){
				echo "<script>alert('Medical section code already taken')</script>";
			}
			else
			{
				$ins="INSERT INTO `medicalsection` VALUES('$itr_no', '$name', '$location')";
				 $conn->query("update sys_master set last_no=last_no+1 where id='$id'") or die(mysqli_error());
				if($conn->query($ins)===TRUE)
				 { 
              			 echo "<script>alert('Medical section inserted succesifully')</script>";
                
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
				//header("location:hospital.php");
				}
				
			//}
	}
		
