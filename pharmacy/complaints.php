<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
    include_once('include/config.php');
    ?>
<html lang = "eng">
	<head>
		<title>EHRMS</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "../images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/customize.css" />
	</head>
<body>
	<?php include "include/header.php"; ?>
	<div>
		<br />
		<br />
		<br />
		<div style = "display:none;" id = "com" class = "panel panel-success">	
			<div class = "panel-heading">
				<label>PATIENT / TREATMENT</label>
				<button class = "btn btn-danger" id = "hide_com" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-remove"></span>CLOSE</button>
			</div>
			<div class = "panel-body">
			<?php
			$date = date('d/m/Y');
				$q = $conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$_SESSION[pat_no]'") or die(mysqli_error());
				$f = $q->fetch_array();
				$qq = $conn->query("SELECT * FROM `hrecold_temp` WHERE `pat_no` = '$_SESSION[pat_no]'") or die(mysqli_error());
				$ff = $qq->fetch_array();
				
				$gg = $conn->query("SELECT * FROM `patient_hrecold` WHERE `pat_no` = '$_SESSION[pat_no]' and `date`='$date'") or die(mysqli_error());
				$tt = $gg->fetch_array();
			?>
				<form method = "POST" action="add_complaints.php?id=<?php echo $f['pat_no']?>&lastname=<?php echo $f['lastname']?>" enctype = "multipart/form-data">
					<div style = "float:left;" class = "form-inline">
						<label for = "itr_no">Pat. No:</label>
						<input class = "form-control" value = "<?php echo $f['pat_no'] ?>"  disabled = "disabled" size = "3" type = "number" name = "pat_no">
					</div>
					<div style = "float:right;" class = "form-inline">
						<label for = "family_no">Huduma no:</label>
						<input class = "form-control" size = "5" value = "
							<?php 
								if($f['huduna_no'] == "0"){
									echo "";
								}else{
									echo $f['huduma_no'];
								}	
							?>" disabled = "disabled" type = "number" name = "huduma_no">
					</div>
					<br />
					<br />
					<br />
					<div class = "form-inline">
						<label for = "firstname">Firstname:</label>
						<input class = "form-control" name = "firstname" value = "<?php echo $f['firstname']?>" disabled = "disabled" type = "text" size = "22" required = "required">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "middlename">Middle Name:</label>
						<input class = "form-control" name = "middlename" value = "<?php echo $f['middlename']?>" disabled = "disabled" type = "text"  size = "22" required = "required">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Lastname:</label>
						<input class = "form-control" name = "lastname" value = "<?php echo $f['lastname']?>" disabled = "disabled" type = "text" size = "22" required = "required">
					</div>
					<br />
				
					<div class = "form-inline">
						<label for = "firstname">TEMP:</label>
						<input class = "form-control" name = "temp" value = "<?php echo $ff['TEMP']?>" disabled = "disabled" type = "text" size = "15" required = "required">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "middlename">BP:</label>
						<input class = "form-control" name = "bp" value = "<?php echo $ff['BP']?>" disabled = "disabled" type = "text"  size = "15" required = "required">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Weight:</label>
						<input class = "form-control" name = "weight" value = "<?php echo $ff['WT']?>" disabled = "disabled" type = "text" size = "15" required = "required">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Height:</label>
						<input class = "form-control" name = "height" value = "<?php echo $ff['HT']?>" disabled = "disabled" type = "text" size = "15" required = "required">
					</div>
					<br />
					<div class = "form-group">
						<label>General Remarks:</label>
						<input class = "form-control" textarea style = "resize:3" name = "remarks"  value = "<?php echo $tt['remark']?>" type = "text" ></textarea>
						<br />
						<label>Specialist Remarks:</label>
						<input class = "form-control" textarea style = "resize:3" name = "specs"  value = "<?php echo $tt['specialist_remarks']?>" type = "text" ></textarea>
						<br />
						<label>Prescription and Remarks:</label>
						<textarea style = "resize:3;" name = "prescription" class = "form-control" type = "text" required="required"></textarea>					</div>
					<div class = "form-inline">
						<button class = "btn btn-primary" name = "save_complaints"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
				</form>
			</div>	
		</div>	
		<?php
		$query =$conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$_SESSION[pat_no]'") or die(mysqli_error());
			$fetch = $query->fetch_array();
		?>
		<div class = "panel panel-info">
			<div class = "panel-heading">
				<label style = "font-size:16px;">MEDICAL HISTORY / <?php echo $fetch['firstname']." ".$fetch['lastname']?></label>
				<a style = "float:right; margin-top:-5px;" id = "add_complaints" class = "btn btn-success" href = "home.php"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
		</div>
		<button class = "btn btn-primary" id = "show_com"><i class = "glyphicon glyphicon-plus">ADD PRESCRIPTION</i></button>
		<a href = "pdfsp.php" class = "btn btn-sm btn-print"><span class = "glyphicon glyphicon-pencil"></span> Print</a>
		<div class = "panel-body">
			<?php
			   
				$q1 = $conn->query("SELECT * FROM `patient`  WHERE `pat_no` = '$_SESSION[pat_no]'") or die(mysqli_error());
				$f1 = $q1->fetch_array();

				$q = $conn->query("SELECT *,patient_hrecold.hospital as hos,concat(firstname,' ',lastname) as doctor FROM `patient_hrecold` left join doctor on doctor.user_id=patient_hrecold.doctor  WHERE `pat_no` = '$_SESSION[pat_no]' ORDER BY `date` DESC") or die(mysqli_error());	
					while($f = $q->fetch_array()){
						echo "<label style = 'color:#3399f3;'>Doctor: ".$f['doctor']."</label>"."<br />Remarks: "."<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'>".$f['remark']."</textarea>"."Specialist Remarks: "."<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'>".$f['specialist_remarks']."</textarea>"."Prescription: "."<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'>".$f['prescription']."</textarea>"."Hospital: ". "<label style = 'color:#3399f3;'>".$f['hos']."</label>"."  Date:".$f['date']."<br /><hr style = 'border:1px solid #eee;' />";
					}
				?>
		</div>
	</div>
	<?php include "include/footer.php"; ?>	
<?php include("script.php"); ?>
</body>
</html>