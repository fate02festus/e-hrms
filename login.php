<?php
	session_start();
	include_once('include/config.php');
	if(ISSET($_POST['login'])){
		$username = $_POST['username'];
		$password =md5($_POST['password']);
		$levl = $_POST['medicsect'];
		//determine user
		$id='1';
		$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
		$f = mysqli_fetch_array($q);
		$code=$f['name'];

       $qry = $conn->query("SELECT * FROM `sys_user` WHERE `username` = '$username' && `password` = '$password' && `level` = '$levl'") or die(mysqli_error());
      $fetch = $qry->fetch_array();                      
		$isValid = $qry->num_rows;
		$level = $fetch['level'];
        if($isValid > 0){
				
				if($level=="1"){
					$query = $conn->query("SELECT * FROM `doctor` WHERE `username` = '$username' && `password` = '$password'") or die(mysqli_error());
					$fetch = $query->fetch_array();
					if($fetch['hospital']==$code){
						$_SESSION['user_id'] = $fetch['user_id'];
						$_SESSION['specs'] = $fetch['medicsect'];
						if($fetch['medicsect']=="general"){
							header("location: home.php");
						}else{
						header("location: specialist/home.php");
						}
					}else{
						echo "<script>alert('User does not belong to this hospital')</script>";
						echo "<script>window.location = 'index.php'</script>";
					}
						
				}else if($level=="2"){
					$query = $conn->query("SELECT * FROM `attendant` WHERE `username` = '$username' && `password` = '$password'") or die(mysqli_error());
					$fetch = $query->fetch_array();
					if($fetch['hospital']==$code){
					$_SESSION['user_id'] = $fetch['user_id'];
					header("location: attendant/home.php");
				}else{
						echo "<script>alert('User does not belong to this hospital')</script>";
						echo "<script>window.location = 'index.php'</script>";
					}

				}else if($level=="3"){
						$query = $conn->query("SELECT *FROM `admin` WHERE `username` = '$username' && `password` = '$password'") or die(mysqli_error());
						
							$fetch = $query->fetch_array();
						    $valid = $query->num_rows;
							if($valid > 0){
								$id='1';
								$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
								$f = mysqli_fetch_array($q);
								$_SESSION['hospital'] =$f['name'];
								
								$_SESSION['admin_id'] = $fetch['admin_id'];
								header("location:admin/home.php");
							}else{
								echo "<script>alert('Invalid Admin username or password')</script>";
								echo "<script>window.location = '../index.php'</script>";
							}

				}else if($level=="4"){
					$query = $conn->query("SELECT * FROM `pharmacist` WHERE `username` = '$username' && `password` = '$password'") or die(mysqli_error());
					$fetch = $query->fetch_array();
					if($fetch['hospital']==$code){
					$_SESSION['user_id'] = $fetch['user_id'];
					header("location: pharmacy/home.php");
					}else{
						echo "<script>alert('User does not belong to this hospital')</script>";
						echo "<script>window.location = 'index.php'</script>";
					}

				}else if($level=="5"){
					$query = $conn->query("SELECT * FROM `labtech` WHERE `username` = '$username' && `password` = '$password'") or die(mysqli_error());
					$fetch = $query->fetch_array();
					$medicsect ='lab'; 
					if($fetch['hospital']==$code){
					$_SESSION['user_id'] = $fetch['user_id'];
					$_SESSION['specs'] = $medicsect;
					header("location: labtech/home.php");
					}else{
						echo "<script>alert('User does not belong to this hospital')</script>";
						echo "<script>window.location = 'index.php'</script>";
					}

			    }else{
					echo "<script>alert('Invalid username or password')</script>";
								echo "<script>window.location = 'index.php'</script>";
				}

			}
			else{
					echo "<script>alert('username does not exist. Kindly check')</script>";
								echo "<script>window.location = 'index.php'</script>";
				}
		}
		$conn->close();
	