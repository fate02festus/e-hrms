<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
    include_once('include/config.php');
    $id='1';
		$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
		$f = mysqli_fetch_array($q);
		$code=$f['hos_id'];
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

				$q = $conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
				$f = $q->fetch_array();
				$qq = $conn->query("SELECT * FROM `hrecold_temp` WHERE `pat_no` = '$_GET[id]' and `date`='$date'") or die(mysqli_error());
				$ff = $qq->fetch_array();

				$rows = mysqli_query($conn, "SELECT * FROM `medicalsection` where id<>'MS004' order by id") or die(mysqli_error());
		        $row11 = mysqli_fetch_all($rows);

		        $rs = mysqli_query($conn, "SELECT * FROM `hospital` where hos_id<>'$code' order by hos_id") or die(mysqli_error());
		        $row111 = mysqli_fetch_all($rs);

			//}else{
			//	echo "<script>alert('Patient Basic record not yet add. Kindly add them first!')</script>";
			//	$_SESSION['pat_no'] = $_GET[id];
			//	var_dump($_SESSION['pat_no']);
			//	echo "<script>window.location = 'view_patient.php'</script>";
				//?id=$f['pat_no']&lastname= $f['lastname']
			//}
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
								if($f['fuduma_no'] == "0"){
									echo "";
								}else{
									echo $f['huduma_no'];
								}	
							?>" disabled = "disabled" type = "number" name = "family_no">
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
						<label for = "firstname">Temparature:</label>
						<input class = "form-control" name = "temp" value = "<?php echo $ff['TEMP']?>" disabled = "disabled" type = "text" size = "15" required = "required">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "middlename">Blood Preasure:</label>
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
						<label>Patient Complains:</label>
						<textarea style = "resize:none;" name = "complaints" class = "form-control"></textarea>
						<br />
						<label>Remarks and Prescriptions:</label>
						<textarea style = "resize:none;" name = "remarks" class = "form-control"></textarea>
						<br />
						<label>Refer to specialist</label>
						<input type="checkbox" name="specialist" value="1">
						<select name = "medicsect" class = "form-control" required = "required">
								<?php foreach ($row11 as $p1) {?>
								<option value = "<?php echo $p1['1'];?>"><?php echo $p1['1'];?></option>
								 <?php } ?>
							</select>
							<br />
						<label>Refer to Lab</label><input type="checkbox" name="lab" value="1">
						<br />
						<label>Refer to another hospital</label>
						<input type="checkbox" name="rhos" value="1">
						<select name = "hosp" class = "form-control" required = "required">
								<?php foreach ($row111 as $p11) {?>
								<option value = "<?php echo $p11['0'];?>"><?php echo $p11['1'];?></option>
								 <?php } ?>
							</select>

					</div>
					<div class = "form-inline">
						<button class = "btn btn-primary" name = "save_complaints"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
				</form>
			</div>	
		</div>	
		<?php
		$query =$conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$_GET[id]' &&  `lastname` = '$_GET[lastname]'") or die(mysqli_error());
			$fetch = $query->fetch_array();
		?>
		<div class = "panel panel-info">
			<div class = "panel-heading">
				<label style = "font-size:16px;">MEDICAL HISTORY / <?php echo $fetch['firstname']." ".$fetch['lastname']?></label>
				<a style = "float:right; margin-top:-5px;" id = "add_complaints" class = "btn btn-success" href = "patient.php"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
		</div>
		<button class = "btn btn-primary" id = "show_com"><i class = "glyphicon glyphicon-plus">ADD</i></button>
		<a href = "pdfsp.php?id=<?php echo $_GET['id']?>" class = "btn btn-sm btn-print"><span class = "glyphicon glyphicon-pencil"></span> Print</a>
		<div class = "panel-body">
			<?php
			   
				$q1 = $conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$_GET[id]' &&  `lastname` = '$_GET[lastname]'") or die(mysqli_error());
				$f1 = $q1->fetch_array();
				$q = $conn->query("SELECT *,patient_hrecold.hospital as hos,concat(firstname,' ',lastname) as doctor FROM `patient_hrecold` join doctor on doctor.user_id=patient_hrecold.doctor WHERE `pat_no` = '$_GET[id]' ORDER BY `date` DESC") or die(mysqli_error());	
					while($f = $q->fetch_array()){
						echo "<label style = 'color:#3399f3;'>Doctor: ".$f['doctor']."</label>"."<br />Complains:<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'> ".$f['complaints']."</textarea>"."Remarks and Prescriptions: "."<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'>".$f['remark']."</textarea>"."Specialist Remarks: "."<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'>".$f['specialist_remarks']."</textarea>"."Lab Remarks: "."<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'>".$f['lab_remarks']."</textarea>"."Prescription: "."<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'>".$f['prescription']."</textarea>"."Hospital: ". "<label style = 'color:#3399f3;'>".$f['hos']."</label>"."  Date:".$f['date']."<br /><hr style = 'border:1px solid #eee;' />";
					}
				?>
		</div>
	</div>
	<?php include "include/footer.php"; ?>	
<?php include("script.php"); ?>
</body>
</html>