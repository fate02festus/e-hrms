<!DOCTYPE html>
<?php
include_once('include/config.php');
	require_once 'logincheck.php';
?>
<html lang = "eng">
	<head>
		<title>EHRMS</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "../images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/customize.css" />
	</head>
<body>
	<?php include "include/header.php"; ?>
	<?php include "include/sidebar.php"; ?>
	<div id = "content">
		<br />
		<br />
		<br />
		<div class = "panel panel-success">	
			<div class = "panel-heading">
				<label>PATIENT INFORMATION / EDIT</label>
				<a style = "float:right; margin-top:-4px;" href = "patient.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<div class = "panel-body">
			<?php
			   //$conn = new mysqli("localhost", "root", "", "ehrms") or die(mysqli_error());
			$q = $conn->query("SELECT * FROM `patient` WHERE `pat_no` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
				$f = $q->fetch_array();
			
			?>
				<form method = "POST" enctype = "multipart/form-data">
					<div style = "float:left;" class = "form-inline">
						<label for = "itr_no">Pat. No:</label>
						<input class = "form-control" value = "<?php echo $f['pat_no'] ?>" disabled = "disabled" size = "3" type = "number" name = "itr_no">
					</div>
					<div style = "float:right;" class = "form-inline">
						<label for = "family_no">Huduma no:</label>
						<input class = "form-control" size = "3" value = "<?php echo $f['huduma_no']?>" type = "number" name = "huduma_no">
					</div>
					<br />
					<br />
					<br />
					<div class = "form-inline">
						<label for = "firstname">Firstname:</label>
						<input class = "form-control" value = "<?php echo $f['firstname'] ?>" name = "firstname" type = "text"  required = "required" pattern="/^[A-Za-z]+$/">
						&nbsp;&nbsp;&nbsp;
						<label for = "middlename">Middle Name:</label>
						<input class = "form-control" value = "<?php echo $f['middlename'] ?>" name = "middlename" placeholder = "(Optional)" type = "text" pattern="/^[A-Za-z]+$/">
						&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Lastname:</label>
						<input class = "form-control" value = "<?php echo $f['lastname'] ?>" name = "lastname" type = "text" required = "required" pattern="/^[A-Za-z]+$/">
					</div>
					<br />
					<div class ="form-inline">
						<label for = "birthdate">Birthdate:</label>
						<input class = "form-control" value = "<?php echo $f['birthdate'] ?>"  name = "date" id= "date" type = "date" required = "required">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "address">Phone:</label>
						<input class = "form-control" value = "<?php echo $f['phone'] ?>" name = "phone" type = "number" min="10000000" required = "required">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "address">Address:</label>
						<input class = "form-control" value = "<?php echo $f['address'] ?>" name = "address" type = "text" required = "required" pattern="/^[A-Za-z]+$/">
						
					</div>
					<br />
					<div class ="form-inline">
						<label for = "civil_status">Civil Status:</label>
						<select style = "width:22%;" class = "form-control" value = "<?php echo $f['civil_status'] ?>" name = "civil_status" required = "required">
							<option value = "">--Please select an option--</option>
							<option value = "Single">Single</option>
							<option value = "Married">Married</option>
						</select>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "gender">Gender:</label>
						<select style = "width:22%;" class = "form-control" value = "<?php echo $f['gender'] ?>" name = "gender" required = "required">
							<option value = "">--Please select an option--</option>
							<option value = "Male">Male</option>
							<option value = "Female">Female</option>
						</select>
					</div>
					<br />
					<div class = "form-inline">
						<label for = "bp">BP:</label>
						<input class = "form-control" value = "<?php echo $f['BP'] ?>"  name = "bp" type = "text" min="0" max="200" required = "required">
						&nbsp;&nbsp;&nbsp;
						<label for = "temp">TEMP:</label>
						<input class = "form-control" value = "<?php echo $f['TEMP'] ?>" name = "temp" type = "number" max = "999" min = "0" size = "15" required = "required"><label>&deg;C</label>
						&nbsp;&nbsp;&nbsp;
							<label for = "wt">WT :</label>
							<input class = "form-control" name = "wt"type = "text" value = "<?php echo $f['WT']?>" min="0" max="300" required = "required">
						<label>kg</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "ht">HT :</label>
						<input class = "form-control" name = "ht"type = "text" value = "<?php echo htmlspecialchars($f['HT'])?>" min="0" max="300" required = "required">
					</div>
					<br />
					<div class = "form-inline">
					<button class = "btn btn-warning" name = "edit_patient"><span class = "glyphicon glyphicon-pencil"></span> SAVE</button>
				</div>
					<?php require_once 'edit_query.php' ?>
				</form>
			</div>	
		</div>	
	</div>
	<?php include "include/footer.php"; ?>	
<?php include("script.php"); ?>
<script type = "text/javascript">
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
</script>	
</body>
</html>