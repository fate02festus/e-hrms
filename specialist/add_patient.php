<?php
	if(ISSET($_POST['save_patient'])){

		$id='1';
		$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
		$f = mysqli_fetch_array($q);
		$code=$f['hos_id'];
		//get last docno
		$qq = mysqli_query($conn, "SELECT * FROM `sys_master` where id='$id'") or die(mysqli_error());
		$ff = mysqli_fetch_array($qq);
		$lno=intval($ff['last_no'])+1;
		$ln=str_pad($lno, intval($ff['length']), "0", STR_PAD_LEFT);
		$itr_no=$code.$ln;

		$hu_no = $_POST['hu_no'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$birthdate = $_POST['date'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$civil_status = $_POST['civil_status'];
		$gender = $_POST['gender'];
		$bp = $_POST['bp'];
		$temp = $_POST['temp']."&deg;C";
		$wt= $_POST['wt']."kg";
		$ht = $_POST['ht'];
		$date = date("d/m/Y");
		$doctor = $_SESSION['user_id'];
		
		$q1 = $conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$itr_no'") or die(mysqli_error());
		$c1 = $q1->num_rows;
		if($c1 > 0){
				echo "<script>alert('Pat No. must not be the same!')</script>";
		}else{
			$ins="INSERT INTO `patient` VALUES('$itr_no', '	$hu_no','$firstname', '$middlename', '$lastname', '$birthdate', '$address', '$phone','$civil_status', '$gender', '$bp', '$temp', '$wt', '".addslashes($ht)."')" or die(mysqli_error());
			//header("location: patient.php");	
			$conn->query("INSERT INTO `hrecold_temp` VALUES('$bp', '$temp', '$wt', '".addslashes($ht)."','$itr_no','$date', '$doctor', '$code')") or die(mysqli_error());
			$id='1';
		    $conn->query("update sys_master set last_no=last_no+1 where id='$id'") or die(mysqli_error());
			if($conn->query($ins)===TRUE)
					   { echo "<script>alert('Record inserted succesifully')</script>";
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
               //header("location: patient.php");
		}
	
	}
