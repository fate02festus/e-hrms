<?php
require_once 'logincheck.php';
    include_once('include/config.php');
	if(ISSET($_POST['save_complaints'])){
		$date = date('d/m/Y');
		$complaints = $_POST['complaints'];
		$remarks = $_POST['remarks'];
		$addspec = $_POST['specialist'];

		if(isset($addspec))
		{ 
		  $addspec = "1";
		   $spectype = $_POST['medicsect'];
		}else{
			$addspec = "0";
		   $spectype = '';
		}
		$lab = $_POST['lab'];
		if(!isset($lab))$lab = "0";
	    $rhos = $_POST['rhos'];
		if(isset($rhos))
		{ 
		   $rhos = "1";
		   $hosp = $_POST['hosp'];
		   $conn->query("update`hrecold_temp` set hospital='$hosp' where pat_no= '$_GET[id]' ");
		}else{
			$rhos = "0";
		   $hosp = '';

		}
		$id='1';
		$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
		$f = mysqli_fetch_array($q);

		$query = $conn->query("SELECT * FROM `hrecold_temp` WHERE `pat_no` = '$_GET[id]' and `date`= '$date' order by date desc") or die(mysqli_error());
	    $fetch = $query->fetch_array();
        $bp = $fetch['BP'];
        $temp = $fetch['TEMP'];
		$wt = $fetch['WT'];
		$ht = $fetch['HT']; 

		$ins="INSERT INTO `patient_hrecold` VALUES('', '$date', '$complaints', '$remarks','','', '$_GET[id]','$_SESSION[user_id]','$f[name]','$bp','$temp','$wt','$ht','$addspec','$spectype','','','$lab','$rhos','$hosp')" or die(mysqli_error());
			
         if($conn->query($ins)===TRUE)
					   { 

					   	echo "<script>alert('Record inserted succesifully')</script>";
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php  }
                    header("location: patient.php");
			$conn->close();
			
	}	