<!DOCTYPE html>
<?php
   include_once('include/config.php');
	require_once 'logincheck.php';
	$id='1';
		$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
		$f = mysqli_fetch_array($q);
		$code=$f['hos_id'];

	$date = date("d/m/Y");

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
				$q1 = $conn->query("SELECT * FROM `patient` WHERE `phone` = '$huno'") or die(mysqli_error());
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
	<meta charset = "utf-8" />
<link rel = "shortcut icon" href = "images/logo.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
<link rel = "stylesheet" type = "text/css" href = "css/customize.css" />
<div >
		<br />
		<br />
		<br />
		<div class = "well">
			<div id="chartContainer" style="width: 100%; height: 100px">
				<div class = "well">
					<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
					<div class = "form-inline">
						<a href = "patient.php" class = "btn btn-primary"><span class = "glyphicon glyphicon-plus"></span>ADD PATIENT</a>
							
						
					<label style = "font-size:18px;">Enter Patient No.</label>
						<input class = "form-control" name = "pno" type = "number">
						
						<button class = "btn btn-primary" name = "search_patient"><span class =  "glyphicon glyphicon-search"></span> Search</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label style = "font-size:18px;">Phone No.</label>
						<input class = "form-control" name = "huno" type = "number">
						
						<button class = "btn btn-primary" name = "search_patient"><span class =  "glyphicon glyphicon-search"></span> Search</button>
					</div>
				</form>
				<br />
			</div> 
		</div>


		<img src = "../images/ehrms.jpg" class = "background">	
		<?php include "include/footer.php"; ?>	
</body>
<?php
	include("scripts.php");
?>
</html>