<?php
    include_once('include/config.php');
	$id = $_GET['id'];
	//$last = $_GET['lastname'];
	if(ISSET($_POST['edit_admin'])){
		$last = $_GET['lastname'];
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$phone = $_POST['phone'];
			$ins="UPDATE `admin` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` ='$middlename', `lastname` = '$lastname', `phone` = '$phone' WHERE `admin_id` = '$id'" or die(mysqli_error());
			$conn->query("update sys_user set `username` = '$username', `password` = '$password' where `user_id` = '$id' ");
			if($conn->query($ins)===TRUE)
				 { 
              			 echo "<script>alert('Record updated succesifully')</script>";
                
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
			//header("location: admin.php");
		}
	if(ISSET($_POST['edit_user'])){
		$username = $_POST['username'];
			$password =  md5($_POST['password']);
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$hospital = $_POST['hospital'];
			$contact = $_POST['contacts'];
			$address = $_POST['address'];
			$medicsect = $_POST['medicsect'];
			//$conn = new mysqli("localhost", "root", "", "hcpms") or die(mysqli_error());
			$conn->query("update sys_user set `username` = '$username', `password` = '$password' where `user_id` = '$id' ");
			$ins="UPDATE `doctor` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname',`contact` = '$contact',`address` = '$address', `hospital` = '$hospital' , `medicsect` = '$medicsect' WHERE `user_id` = '$id'" or die(mysqli_error());
			if($conn->query($ins)===TRUE)
				 { 
              			 echo "<script>alert('Record updated succesifully')</script>";
                
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
			//header("location: user.php");
		}	
		if(ISSET($_POST['edit_pharmacist'])){
		$username = $_POST['username'];
			$password =  md5($_POST['password']);
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$hospital = $_POST['hospital'];
			$contact = $_POST['contacts'];
			$address = $_POST['address'];
			//$conn = new mysqli("localhost", "root", "", "hcpms") or die(mysqli_error());
			$conn->query("update sys_user set `username` = '$username', `password` = '$password' where `user_id` = '$id' ");
			$ins="UPDATE `pharmacist` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname',`contact` = '$contact',`address` = '$address', `hospital` = '$hospital' WHERE `user_id` = '$id'" or die(mysqli_error());
			if($conn->query($ins)===TRUE)
				 { 
              			 echo "<script>alert('Record updated succesifully')</script>";
                
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
			//header("location: user.php");
		}
if(ISSET($_POST['edit_attendant'])){
	$last = $_GET['lastname'];
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$hospital = $_POST['hospital'];
			$contact = $_POST['contacts'];
			$idno = $_POST['idno'];
			$conn->query("update sys_user set `username` = '$username', `password` = '$password' where `user_id` = '$id' ");
			$ins="UPDATE `attendant` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname',`contact` = '$contact',`idno` = '$idno',`hospital` = '$hospital' WHERE `user_id` = '$id'" or die(mysqli_error());
			if($conn->query($ins)===TRUE)
				 { 
              			 echo "<script>alert('Record updated succesifully')</script>";
                
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
			//header("location: attendants.php");
		}	
if(ISSET($_POST['edit_hos'])){
			$name = $_POST['name'];
			$location = $_POST['location'];
			$level= $_POST['level'];
			$ins="UPDATE `hospital` SET `name` = '$name', `location` = '$location', `type` = '$level' WHERE `hos_id` = '$id'" or die(mysqli_error());
			if($conn->query($ins)===TRUE)
				 { 
              			 echo "<script>alert('Hospital updated succesifully')</script>";
                
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
			//header("location: hospital.php");
		}	
		if(ISSET($_POST['edit_medicsect'])){
			$name = $_POST['name'];
			$location = $_POST['location'];
			$ins="UPDATE `medicalsection` SET `description` = '$name', `notes` = '$location' WHERE `id` = '$id'" or die(mysqli_error());
			if($conn->query($ins)===TRUE)
				 { 
              			 echo "<script>alert('medical section updated succesifully')</script>";
                
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
			//header("location: hospital.php");
		}	
		if(ISSET($_POST['edit_labtech'])){
	        $last = $_GET['lastname'];
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$hospital = $_POST['hospital'];
			$contact = $_POST['contacts'];
			$conn->query("update sys_user set `username` = '$username', `password` = '$password' where `user_id` = '$id' ");
			$ins="UPDATE `labtech` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname',`contact` = '$contact',`hospital` = '$hospital' WHERE `user_id` = '$id'" or die(mysqli_error());
			if($conn->query($ins)===TRUE)
				 { 
              			 echo "<script>alert('Record updated succesifully')</script>";
                
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
			//header("location: attendants.php");
		}	