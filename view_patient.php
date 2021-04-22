<!DOCTYPE html>
<?php
	require_once'logincheck.php';
    include_once('include/config.php');
   error_reporting(0);
	$query = $conn->query("SELECT * FROM `doctor` WHERE `user_id` = '$_SESSION[user_id]'") or die(mysqli_error());
	$fetch = $query->fetch_array();

	   $id='1';
		$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
		$f = mysqli_fetch_array($q);
		$code=$f['hos_id'];

$date = date('d/m/Y');
	if(ISSET($_POST['save_patient_rec'])){
		$bp = $_POST['bp'];
		$temp = $_POST['temp'];
		$wt = $_POST['wt'];
		$ht = $_POST['ht'];
		$pno1=$_SESSION['pat_no'];
		if($pno1==null)
			$pno1=$_GET['id'];
		$ins="INSERT INTO `hrecold_temp`(`BP`, `TEMP`, `WT`, `HT`, `pat_no`, `date`, `doctor`, `hospital`) VALUES ('$bp', '$temp', '$wt','$ht','$_SESSION[pat_no]','$date','$_SESSION[user_id]','$code')" or die(mysqli_error());
		if($conn->query($ins)===TRUE)
					   { echo "<script>alert('Record inserted succesifully')</script>";
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
			
			//var_dump($date);
			if($_SESSION['pat_no']==null){
				$q = $conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$_GET[id]'") or die(mysqli_error());
				$f = $q->fetch_array();
				$q1 = $conn->query("SELECT COUNT(*) as total FROM `patient_hrecold` where `pat_no` = '$_GET[id]'") or die(mysqli_error());
				$f1 = $q1->fetch_array();

				$q11 = $conn->query("SELECT * FROM `hrecold_temp` where `pat_no` = '$_GET[id]' and `date`='$date'") or die(mysqli_error());
				$f11 = $q11->fetch_array();
				if($f11['TEMP'] == null){ 
					 echo "<script>alert('Record basic record not added!!! Kindly add...')</script>";
				}
		
			}else{
				$pno=$_SESSION['pat_no'];
				$q = $conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$pno'") or die(mysqli_error());
				$f = $q->fetch_array();
				$q1 = $conn->query("SELECT COUNT(*) as total FROM `patient_hrecold` where `pat_no` = '$pno'") or die(mysqli_error());
			    $f1 = $q1->fetch_array();

			     $q11 = $conn->query("SELECT * FROM `hrecold_temp` where `pat_no` = '$pno' and `date`='$date'") or die(mysqli_error());
				$f11 = $q11->fetch_array();
				if($f11['TEMP'] == null){ 
					 echo "<script>alert('Record basic record not added!!! Kindly add...')</script>";
				}
			}
				
			?>
				<label>Patient Vitals / <label class = "text-warning"><?php echo $f['firstname']." ".substr($f['middlename'], 0,1).". ".$f['lastname']?></label></label>
				<a style = "float:right; margin-top:-4px;" href = "patient.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>

				<?php  
				//$date = date('d/m/Y');
				$sq = $conn->query("SELECT * FROM `hrecold_temp` where `pat_no` = '$_SESSION[pat_no]' or `pat_no` = '$_GET[id]' and `date`='$date'") or die(mysqli_error());
				$sqf = $sq->fetch_array();
				if($sqf['WT'] != null){ ?>
				<a style = "float:right; margin-top:-4px; margin-right:5px;"href = "complaints.php?id=<?php echo $f['pat_no']?>&lastname=<?php echo $f['lastname']?>"class = "btn btn-info">Health Record <span class = "badge"> <?php echo $f1['total']?></span></a>
				<?php } ?>  
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
					<label style = "font-size:24px;">Enter Patient Vitals</label>
					<hr style = "border:1px dotted #d3d3d3;"/>
					<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
						<div class = "form-group" style = "width:15%; float:left;">
							<label style = "font-size:18px;" for = "bp">Blood Preasure</label>
							<br />
							<input class = "form-control" name = "bp" type = "number" max = "250" min="150" pattern="[0-9]" title="Enter numerics value between 150 and 250" value="<?php echo $f11['BP']?>" required = "required">
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div class = "form-group" style = "width:15%; float:left;">
							<label style = "font-size:18px;" for = "temp">Temparature</label>
							<br />
							<input class = "form-control" name = "temp" type = "number" max = "38" min="36" pattern="[0-9]" title="Enter numerics value between 36 and 38" value="<?php echo $f11['TEMP']?>" required = "required">
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div class = "form-group" style = "width:15%; float:left;">	
							<label style = "font-size:18px;" for = "wt">Weight</label>
							<br />
							<input class = "form-control" name = "wt" type = "number" max = "299" min="1" pattern="[0-9]" title="Enter numerics value between 1 and 299" value="<?php echo $f11['WT']?>" required = "required">
						</div>	
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div class = "form-group" style = "width:15%; float:left;">	
							<label style = "font-size:18px;" for = "ht">Height</label>
							<br />
							<input class = "form-control" name = "ht" type = "number" max = "299" min="1" pattern="[0-9]" title="Enter numerics value between 1 and 299" value="<?php echo $f11['HT']?>" required = "required">
						</div>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div class = "form-inline">
							<?php if($f11['WT'] ==null){ ?>
						<button class = "btn btn-primary" name = "save_patient_rec"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
						<?php } ?>
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