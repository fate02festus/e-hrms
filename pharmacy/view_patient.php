<!DOCTYPE html>
<?php
	require_once'logincheck.php';
    include_once('include/config.php');
	$query = $conn->query("SELECT * FROM `doctor` WHERE `user_id` = '$_SESSION[user_id]'") or die(mysqli_error());
	$fetch = $query->fetch_array();

	if(ISSET($_POST['save_patient_rec'])){
		$bp = $_POST['bp'];
		$temp = $_POST['temp'];
		$wt = $_POST['wt'];
		$ht = $_POST['ht'];
		$date = date("d/m/Y");
		$ins="INSERT INTO `hrecold_temp`(`BP`, `TEMP`, `WT`, `HT`, `pat_no`, `date`, `doctor`) VALUES ('$bp', '$temp', '$wt','$ht','$_SESSION[pat_no]','$date','$_SESSION[user_id]')" or die(mysqli_error());
					   { 
					   	echo "<script>alert('Record inserted succesifully')</script>";
					   //header("location:search_patient.php");
                }else{
                    ?>
                        <script type="text/javascript">
                            alert("Error inserting record");
                        </script>
                    <?php }
	}	
?>
<html lang = "en">
	<head>	
		<title>EHRMS</title>
		<meta charset = "UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/customize.css" />
	</head>
	<body>
	<?php include_once('include/header.php');?>
	<br />
	<br />
	<br />
	
		<div class = "panel panel-success">	
			<div class = "panel-heading">
			<?php
			 $q = $conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$_GET[pat_no]'") or die(mysqli_error());
				$f = $q->fetch_array();
				$q1 = $conn->query("SELECT * FROM `hrecold_temp` where `pat_no` = '$_GET[pat_no]'") or die(mysqli_error());
				$f1 = $q1->fetch_array();
			
			?>
				<label>Patient Information / <label class = "text-warning"><?php echo $f['firstname']." ".substr($f['middlename'], 0,1).". ".$f['lastname']?></label></label>
				<a style = "float:right; margin-top:-4px;" href = "patient.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
				
				<label style = "margin-top:5px; margin-right:5px; float:right;">Pat. No: <label class = "text-warning"><?php echo $f['pat_no']?></label></label>
			</div>
			<div class = "panel-body">
					<div style = "float:left; width:15%;">
						<label style = "font-size:18px;">Birthdate</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['birthdate']?></label>
					</div>
					<div style = "float:left; width:15%;">
						<label style = "font-size:18px;">Gender</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['gender']?></label>
					</div>
					<div style = "float:left; width:15%;">
						<label style = "font-size:18px;">Civil Status</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['civil_status']?></label>
					</div>
					<div style = "float:left; width:15%;">
						<label for = "family_no" style = "font-size:18px;">Huduma no</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['huduma_no']?></label>
					</div>	
					<div>
						<label style = "font-size:18px;">Address</label>
						<br />
						<label style = "font-size:18px;" class = "text-muted"><?php echo $f['address']?></label>
					</div>
					<br style = "clear:both;" />
					<label style = "font-size:24px;">Enter Patient information</label>
					<hr style = "border:1px dotted #d3d3d3;"/>
					<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
						<div class = "form-group" style = "width:15%; float:left;">
							<label style = "font-size:18px;" for = "bp">BP</label>
							<br />
							<input class = "form-control" name = "bp" type = "number" value="<?php echo $f1['BP']?>" required = "required">
						</div>
						&nbsp;&nbsp;&nbsp;
						<div class = "form-group" style = "width:15%; float:left;">
							<label style = "font-size:18px;" for = "temp">TEMP</label>
							<br />
							<input class = "form-control" name = "temp" type = "number" value="<?php echo $f1['temp']?>" required = "required">
						</div>
						&nbsp;&nbsp;&nbsp;
						<div class = "form-group" style = "width:15%; float:left;">	
							<label style = "font-size:18px;" for = "wt">WT</label>
							<br />
							<input class = "form-control" name = "wt" type = "number" value="<?php echo $f1['WT']?>" required = "required">
						</div>	
						<div class = "form-group" style = "width:15%; float:left;">	
							<label style = "font-size:18px;" for = "ht">HT</label>
							<br />
							<input class = "form-control" name = "ht" type = "number" value="<?php echo $f1['HT']?>" required = "required">
						</div>
						<div class = "form-inline">
						<button class = "btn btn-primary" name = "save_patient_rec"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
					</form>
					<br />
			</div>	
		</div>	
		 
	</div>
	<?php include_once('include/footer.php');?>
	</body>
		<?php require "script.php" ?>
</html>