<!DOCTYPE html>
<?php
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
		<?php
		 include "include/config.php"; 
		    $query = $conn->query(" SELECT * FROM `labtech` WHERE `user_id` = '$_GET[id]'") or die(mysqli_error());
			$fetch = $query->fetch_array();

			$row = mysqli_query($conn, "SELECT * FROM `hospital` order by hos_id") or die(mysqli_error());
		$row1 = mysqli_fetch_all($row);
		?>
			<div class = "panel-heading">
				<label>EDIT LAB TECHNISIAN</label>
				<a href = "lab.php" class = "btn btn-sm btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<div class = "panel-body">
				<form id = "form_user" name="form_user" onsubmit="return validateForm()"  method = "POST" enctype = "multi-part/form-data">
					<div class = "panel panel-default" style = "width:60%; margin:auto;">
					<div class = "panel-heading">
					</div>
					<div class = "panel-body">
						<div class = "form-group">
							<label for = "username">Username: </label>
							<input class = "form-control" type= "email" value = "<?php echo $fetch['username']?>" name = "username" required = "required" placeholder = "">
						</div>
						<div class = "form-group">	
							<label for = "password">Password: </label>
							<input class = "form-control" name = "password" minlength = "3" value = "<?php echo $fetch['password']?>" type = "password" required = "required">
						</div>
						<div class = "form-group">
							<label for = "firstname">Firstname: </label>
							<input class = "form-control" type = "text" value = "<?php echo $fetch['firstname']?>" name = "firstname" required = "required" placeholder = ""  pattern="[A-Za-z]{1,15}" title="Enter characters only">
						</div>
						<div class = "form-group">
							<label for = "middlename">Middlename: </label>
							<input class = "form-control" type = "text" value = "<?php echo $fetch['middlename']?>" name = "middlename" placeholder = "(Optional)" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						</div>
						<div class = "form-group">
							<label for = "lastname">Lastname: </label>
							<input class = "form-control" type = "text" value = "<?php echo $fetch['lastname']?>" name = "lastname" required = "required" placeholder = "" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						<div class = "form-group">
							<label for = "lastname">Phone: </label>
							<input class = "form-control" type = "number" min="1" value = "<?php echo $fetch['contact']?>" name = "contacts" required = "required" pattern="[0-9]{9,12}" title="Enter numerics value of length between 9 and 12 characters">
						</div>
						<div class = "form-group">
							<label for = "lastname">ID No.: </label>
							<input class = "form-control" type = "number" min="1" value = "<?php echo $fetch['idno']?>" name = "idno" required = "required" pattern="[0-9]{7,8}" title="Enter numerics value of length between 7 and 8 characters"> 
						</div>
						<div class = "form-group">
							<label for = "section">Hospital: </label>
							<select name = "hospital" class = "form-control" required = "required">
								<?php foreach ($row1 as $p) {?>
								<option value = "<?php echo $p['1'];?>"><?php echo $p['1'];?></option>
								 <?php } ?>
							</select>
						</div>
							<button class = "btn btn-warning" name = "edit_labtech" type="submit" value="submit"><span class = "glyphicon glyphicon-edit"></span> SAVE</button>
							<br />
					</div>	
					<?php require 'edit_query.php'?>
					</div>
				</form>			
			</div>	
		</div>	
	</div>
	<?php include_once('include/footer.php');?>
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