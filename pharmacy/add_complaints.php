<?php
require_once 'logincheck.php';
    include_once('include/config.php');
	if(ISSET($_POST['save_complaints'])){
		$date = date("d/m/Y");
		$complaints = $_POST['complaints'];
		$remarks = $_POST['remarks'];
		$pres = $_POST['prescription'];
		$specs= $_POST['specs'];
		$itr_no =$_SESSION[pat_no];
		
		$id='1';
		$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
		$f = mysqli_fetch_array($q);

		$query = $conn->query("SELECT * FROM `hrecold_temp` WHERE `pat_no` = '$_GET[id]' and `date`= '$date' order by date desc") or die(mysqli_error());
	    $fetch = $query->fetch_array();
        $bp = $fetch['BP'];
        $temp = $fetch['TEMP'];
		$wt = $fetch['WT'];
		$ht = $fetch['HT']; 

		$ins="update `patient_hrecold` set remark='$remarks',prescription='$pres',specialist_remarks='$specs' where pat_no ='$itr_no'and date='$date'" or die(mysqli_error());
		if($conn->query($ins)===TRUE)
					   { echo "<script>alert('Record inserted succesifully')</script>";
					$del="delete from hrecold_temp where pat_no ='$itr_no'" or die(mysqli_error());
		$conn->query($del);
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php  }
                   header("location: home.php");
			$conn->close();
			
	}	