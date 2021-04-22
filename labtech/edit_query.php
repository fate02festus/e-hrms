<?php
    include_once('include/config.php');
	$id = $_GET['id'];
	$last = $_GET['lastname'];
	if(ISSET($_POST['edit_patient'])){
		$hid='1';
		$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$hid'") or die(mysqli_error());
		$f = mysqli_fetch_array($q);
		$code=$f['hos_id'];

		$hu_no = $_POST['huduma_no'];
		$firstname = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname = $_POST['lastname'];
		$birthdate = $_POST['date'];
		$address = $_POST['address'];
		$phone= $_POST['phone'];
		$civil_status = $_POST['civil_status'];
		$gender = $_POST['gender'];
		$bp = $_POST['bp'];
		$temp = $_POST['temp'];
		$wt= $_POST['wt'];
		$ht = $_POST['ht'];
		$doctor = $_SESSION['user_id'];
		//$conn = new mysqli("localhost", "root", "", "hcpms") or die(mysqli_error());
		$ins="UPDATE `patient` SET `huduma_no` = '$hu_no', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname', `birthdate` = '$birthdate',  `address` = '$address', `phone` = '$phone',`civil_status` = '$civil_status', `gender` = '$gender', `BP` = '$bp', `TEMP` = '$temp',`WT` = '$wt', `HT` = '$ht' WHERE `pat_no` = '$_GET[id]'" or die(mysqli_error()); 
		$conn->query("update  `hrecold_temp` set `BP` = '$bp', `TEMP` = '$temp',`WT` = '$wt', `HT` = '$ht',`doctor` = '	$doctor', `hospital` = '$code' WHERE `pat_no` = '$_GET[id]'") or die(mysqli_error());
			//header("location:patient.php");
		if($conn->query($ins)===TRUE)
				 { 
              			 echo "<script>alert('Record inserted succesifully')</script>";
                //header("location: patient.php");
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
		
	}
	
