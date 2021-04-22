<?php
    include_once('include/config.php');
	if(ISSET($_POST['save_user'])){	
		$id='4';
		$code='DO';
		//get last docno
		$qq = mysqli_query($conn, "SELECT * FROM `sys_master` where id='$id'") or die(mysqli_error());
		$ff = mysqli_fetch_array($qq);
		$lno=intval($ff['last_no'])+1;
		$ln=str_pad($lno, intval($ff['length']), "0", STR_PAD_LEFT);
		$itr_no=$code.$ln;

		$username = $_POST['username']; 
		$password = md5($_POST['password']); 
		$firstname = $_POST['firstname']; 
		$middlename = $_POST['middlename']; 
		$lastname = $_POST['lastname']; 
		$hospital = $_POST['hospital']; 
		$idno = $_POST['idno']; 
		$confpassword = md5($_POST['confpassword']);
		$address = $_POST['address'];
		$contacts = $_POST['contacts'];
		$medicsect = $_POST['medicsect'];
		$lv="1";
		$q1 = $conn->query("SELECT * FROM `sys_user` WHERE `username` = '$username'") or die(mysqli_error());
		$f1 = $q1->fetch_array();
		$c1 = $q1->num_rows;
			if($c1 > 0){
				echo "<script>alert('Username already taken')</script>";
			}
			else
			{
				if($password==$confpassword)
				{
					$ins="INSERT INTO `doctor` VALUES('$itr_no', '$username', '$password', '$firstname', '$middlename', '$lastname','$contacts','$address','$idno', '$hospital', '$medicsect')";
					$conn->query("INSERT into sys_user values('$itr_no','$username','$password','$lv')");
					 $conn->query("update sys_master set last_no=last_no+1 where id='$id'") or die(mysqli_error());
					if($conn->query($ins)===TRUE)
					   { ?>
                    <script type="text/javascript">
                        alert("Record added successfuly");
                    </script>
                <?php
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php
                }
				//header("location: user.php");
				}
				else
				 echo "<script>alert('Password do not match. please check....')</script>";

			}
	}
		
