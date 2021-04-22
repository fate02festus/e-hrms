<!DOCTYPE html>
<?php
   include_once('include/config.php');
	require_once 'logincheck.php';
	$id='1';
		$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
		$f = mysqli_fetch_array($q);
		$code=$f['hos_id'];

	$date = date("d-m-Y");

	if(ISSET($_POST['search_patient'])){

			$pno = $_POST['pno'];
			$huno = $_POST['huno'];
			if($pno!=null && $huno==null){
				$q1 = $conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$pno'") or die(mysqli_error());
				$c1 = $q1->num_rows;
				if($c1 > 0){
					 $f = $q1->fetch_array();
					$_SESSION['pat_no']=$f['pat_no'];
					header("location: view_patient.php");
				}else{
					echo " <script>alert('Patient does not exists. Kindly enroll...')</script>";
					//echo " <script>setTimeout(\"location.href='patient.php';\",150);</script>";
				}
			}else if($huno!=null && $pno==null ){
				$q1 = $conn->query("SELECT * FROM `patient` WHERE `huduma_no` = '$huno'") or die(mysqli_error());
				$c1 = $q1->num_rows;
				if($c1 > 0){
					 $f = $q1->fetch_array();
					$_SESSION['pat_no']=$f['pat_no'];
					header("location: view_patient.php");
				}else{
					echo " <script>alert('Patient does not exists. Kindly enroll...')</script>";
					//echo " <script>setTimeout(\"location.href='patient.php';\",150);</script>";
				}
			}
		}
	
?>
<html lang = "eng">
	<head>
		<title>EHRMS</title>
		<meta charset = "utf-8" />
		<link rel = "shortcut icon" href = "images/logo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/customize.css" />
	</head>
<?php require 'script.php'?>
<body>
	<?php include "include/header.php"; ?>
	<?php include "include/sidebar.php"; ?>
	<meta charset = "utf-8" />
<link rel = "shortcut icon" href = "images/logo.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
<link rel = "stylesheet" type = "text/css" href = "css/customize.css" />
<div id = "content">
		<br />
		<br />
		<br />
		<div id="chartContainer" style="width: 140%; height: 600px">
				<div class = "well">
					<form id = "form_dental" method = "POST" action="pdf.php" enctype = "multipart/form-data">
					<div class = "form-inline">
						<label style = "font-size:18px;">Treated Date From:</label>
						<input class = "form-control" name = "date" id= "date" type = "date" required="required">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label style = "font-size:18px;">Treated Date To:</label>
						<input class = "form-control" name = "dateto" id= "date" type = "date" required="required">
					   </div><br/>
					<div class = "form-inline">
					   <label style = "font-size:18px;">Address.</label>
						<input class = "form-control" name = "region" type = "text">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label style = "font-size:18px;">Gender:</label>
						<select style = "width:22%;" class = "form-control" name = "gender">
							<option value = "">--Please select an option--</option>
							<option value = "Male">Male</option>
							<option value = "Female">Female</option>
						</select>
						<input type="submit" value="Generate Report" class="btn btn-info" name="print_patient"/>
                         <input type="reset" value="Reset" class="btn btn-danger"/>

					</div>
				</form>
				<br />
		</div>
	</div>

		<img src = "images/ehrms.jpg" class = "background">	
		<?php include "include/footer.php"; ?>	
</body>
<?php
	include("admin/script.php");
?>
</html>