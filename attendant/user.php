<!DOCTYPE html>
<?php
	//include_once('include/config.php');
	require_once('logincheck.php');
?>
<html lang = "eng">
	<head>
		<title>EHRMS</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/customize.css" />
	</head>
<body>
	<?php include "include/header.php"; ?>
	<?php include "include/sidebar.php"; ?>
	<div id = "content">
		<br /><br /><br />
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<label>ACCOUNTS / HOSPITAL</Label>
			</div>
			<div class = "panel-body">
				<br />
				<table id = "table" class = "display" width = "100%" cellspacing = "0">
					<thead>
						<tr>
							<th>Hos. Code</th>
							<th>Name</th>
							<th>Location</th>
							<th>Type</th>
						</tr>
					</thead>
					<tbody>
					<?php
//require('include/config.php');
					$id='1';
						$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
						while($f = mysqli_fetch_array($q)){
					?>
						<tr>
							<td><?php echo $f['hos_id']?></td>
							<td><?php echo $f['name']?></td>
							<td><?php echo $f['location']?> </td>
							<td><?php echo $f['type']?></td>
						</tr>
					<?php
						}
					?>	
					</table>
			</div>
		</div>
	</div>
	<?php include "include/footer.php"; ?>
<?php
	include("script.php");
?>	
</body>
</html>