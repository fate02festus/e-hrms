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
		$phone = $_POST['phone'];
		$civil_status = $_POST['civil_status'];
		$gender = $_POST['gender'];
	   $doctor = $_SESSION['user_id'];
	   $ddt = date("Y-m-d");
	   	$det = date("1900-01-01");
	   if($birthdate < $ddt && $birthdate > $det){ 
	   		$ins="UPDATE `patient` SET `huduma_no` = '$hu_no', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname', `birthdate` = '$birthdate',  `address` = '$address', `phone` = '$phone', `civil_status` = '$civil_status', `gender` = '$gender'  WHERE `pat_no` = '$_GET[id]'" or die(mysqli_error()); 
		
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
            }else{
		echo "<script>alert('Invalid date')</script>";
                        
		}
	}
	if(ISSET($_POST['edit_admin'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$conn->query("UPDATE `admin` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname' WHERE `admin_id` = '$id'") or die(mysqli_error());
			header("location: admin.php");
		}
	if(ISSET($_POST['edit_user'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$section = $_POST['section'];
			$conn = new mysqli("localhost", "root", "", "hcpms") or die(mysqli_error());
			$conn->query("UPDATE `doctor` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname', `section` = '$section' WHERE `user_id` = '$id'") or die(mysqli_error());
			header("location: user.php");
		}	
