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
		    $query = $conn->query(" SELECT * FROM `hospital` WHERE `hos_id` = '$_GET[id]'") or die(mysqli_error());
			$fetch = $query->fetch_array();
		?>
			<div class = "panel-heading">
				<label>UPDATE MEDICAL CENTER</label>
				<a href = "user.php" class = "btn btn-sm btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<div class = "panel-body">
				<form id = "form_user" method = "POST" enctype = "multi-part/form-data">
					<div class = "panel panel-default" style = "width:60%; margin:auto;">
					<div class = "panel-heading">
					</div>
					<div class = "panel-body">
						<div class = "form-group">
							<label for = "firstname">Name: </label>
							<input class = "form-control" type = "text" value = "<?php echo $fetch['name']?>" name = "name"  required = "required" onkeydown="this.value=this.value.replace(/[^a-zA-Z]/,'')"
						</div>
						<div class = "form-group">
							<label for = "middlename">Location: </label>
							<input class = "form-control" type = "text" value = "<?php echo $fetch['location']?>" name = "location" required = "required" onkeydown="this.value=this.value.replace(/[^a-zA-Z]/,'')"
						</div>
						<div class = "form-group">
							<label for = "section">Level: </label>
							<select name = "level" value = "<?php echo $fetch['type']?>" class = "form-control" required = "required">
								<option value = "">--Please select an option--</option>
								<option value = "level2">Level 2</option>
								<option value = "level3">Level 3</option>
								<option value = "level4">Level 4</option>
								<option value = "level5">Level 5</option>
								<option value = "national">National</option>
							</select>
						</div>
							<button class = "btn btn-warning" name = "edit_hos" ><span class = "glyphicon glyphicon-edit"></span> SAVE</button>
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