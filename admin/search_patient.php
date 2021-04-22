<!DOCTYPE html>
<?php
   include_once('include/config.php');
	require_once 'logincheck.php';
	$date = date("Y", strtotime("+ 8 HOURS"));
	
	$query = $conn->query("SELECT * FROM `doctor` WHERE `user_id` = '$_SESSION[user_id]'") or die(mysqli_error());
	$fetch = $query->fetch_array();
	
?>
<html lang = "eng">
	<head>
		<title>EHRMS</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/customize.css" />
		<?php require 'script.php'?>
		<script src = "../js/jquery.canvasjs.min.js"></script>
		<script type="text/javascript"> 
			window.onload = function() { 
				$("#chartContainer").CanvasJSChart({ 
					title: { 
						text: "Total Patient Population <?php echo $date?>",
						fontSize: 24
					}, 
					axisY: { 
						title: "asda" 
					}, 
					legend :{ 
						verticalAlign: "center", 
						horizontalAlign: "left" 
					}, 
					data: [ 
					{ 
						type: "pie", 
						showInLegend: true, 
						toolTipContent: "{label} <br/> {y}", 
						indexLabel: "{y}", 
						dataPoints: [ 
							
							
							
						] 
					} 
					] 
				}); 
			} 
		</script>
	</head>
<body>
	<?php include "include/header.php"; ?>
	<?php include "include/sidebar.php"; ?>
	<div id = "content">
		<br />
		<br />
		<br />
		<div class = "well">
			<div class = "form-inline">
					<input class = "form-control" name = "rr" type = "text"  required = "required">
					<button class = "btn btn-primary" name = "save_patient"><span class = "glyphicon glyphicon-search"></span> Search</button>
					<a href = "view_dental_record.php" id = "d_record" style = "float:right; margin-right:30px;" href = "" class = "btn btn-success"><span class = "glyphicon glyphicon-book"></span> PATIENTS RECORD</a>
					</div>
		<br />
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<h4>INDIVIDUAL TREATMENT RECORD</h4>
			</div>
		</div>
		<br />
		<table id = "table" class = "display" cellspacing = "0" >
			<thead>
				<tr>
					<th>Pat. No</th>
					<th>Name</th>
					<th>Birthdate</th>
					<th>Address</th>
					<th>Civil Status</th>
					<th>Gender</th>
					<th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$q = $conn->query("SELECT * FROM `Patient` ORDER BY `pat_no` DESC") or die(mysqli_error());
				while($f = $q->fetch_array()){
			?>
				<tr>
					<td><?php echo $f['pat_no']?></td>
					<td><?php echo $f['firstname']." ".$f['lastname'] ?></td>
					<td><?php echo $f['birthdate'] ?></td>
					<td><?php echo $f['address'] ?></td>
					<td><?php echo $f['civil_status'] ?></td>
					<td><?php echo $f['gender'] ?></td>
					<td>
						<center>
							<a href = "view_patient.php?pat_no=<?php echo $f['pat_no']?>"class = "btn btn-sm btn-info"><span class = "glyphicon glyphicon-search"></span> VIEW DETAILS</a> 
						</center>
					</td>
				</tr>
			<?php
				}
					$conn->close();
			?>	
			</tbody>
		</table>
			<div id="chartContainer" style="width: 100%; height: 400px"></div> 
		</div>
	</div>
	<?php include "include/footer.php"; ?>
		
</body>
</html>