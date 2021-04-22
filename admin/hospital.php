<!DOCTYPE html>
<?php
   // include_once('include/config.php');
	require_once 'logincheck.php';
	$conn = new mysqli("localhost", "root", "", "ehrms") or die(mysqli_error());
	//get hos code
		$id='2';
		$code='HS';
		//get last docno
		$qq = mysqli_query($conn, "SELECT * FROM `sys_master` where id='$id'") or die(mysqli_error());
		$ff = mysqli_fetch_array($qq);
		$lno=intval($ff['last_no'])+1;
		$ln=str_pad($lno, intval($ff['length']), "0", STR_PAD_LEFT);
		$itr_no=$code.$ln;
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
		<div id = "add" class = "panel panel-success">	
			<div class = "panel-heading">
				<label>ADD MEDICAL CENTER ACCOUNT</label>
				<button id = "hide" class = "btn btn-sm btn-danger" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
			</div>
			<div class = "panel-body">
				<form id = "form_user" method = "POST" enctype = "multi-part/form-data">
					<div class = "panel panel-default" style = "width:60%; margin:auto;">
					<div class = "panel-heading">
					</div>
					<div class = "panel-body">
						<div class = "form-group">
							<label for = "username">Hospital Code: </label>
							<input class = "form-control" name = "hos_code" type = "text" value = "<?php echo $itr_no ?>"  required = "required" disabled = 'disabled'>
						</div>
						<div class = "form-group">
							<label for = "username">Hospital Name: </label>
							<input class = "form-control" name = "name" type = "text"  required = "required" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						</div>
						<div class = "form-group">
							<label for = "firstname">Location: </label>
							<input class = "form-control" type = "text" name = "location" required = "required" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						</div>
						<div class = "form-group">
							<label for = "section">Level: </label>
							<select name = "level" class = "form-control" required = "required">
								<option value = "">--Please select an option--</option>
								<option value = "level2">Level 2</option>
								<option value = "level3">Level 3</option>
								<option value = "level4">Level 4</option>
								<option value = "level5">Level 5</option>
								<option value = "national">National</option>
							</select>
						</div>
										
							<button class = "btn btn-primary" name = "save_hos" ><span class = "glyphicon glyphicon-save"></span> SAVE</button>
							<br />
					</div>	
					<?php require 'add_hospital.php'?>
					</div>
				</form>			
			</div>	
		</div>	
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<label>MEDICAL CENTER</Label>
			</div>
			<div class = "panel-body">
				<button id = "show" class = "btn btn-info"><span class  = "glyphicon glyphicon-plus"></span> ADD</button>
				<a href = "home.php" class = "btn btn-sm btn-warning"><span class = "glyphicon glyphicon-pencil"></span> BACK</a>
				<br />
				<br />
				<table id = "table" class = "display" width = "100%" cellspacing = "0">
					<thead>
						<tr>
							<th>Hospital Code</th>
							<th>Name</th>
							<th>Location</th>
							<th>Level</th>
							<th><center>Action</center></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = $conn->query("SELECT * FROM `hospital` ORDER BY `hos_id` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
					?>
						<tr>
							<td><?php echo $fetch['hos_id']?></td>
							<td><?php echo $fetch['name']?></td>
							<td><?php echo $fetch['location']?></td>
							<td><?php echo ($fetch['type'])?></td>
							<td><center><a href = "edit_hospital.php?id=<?php echo $fetch['hos_id']?>&name=<?php echo $fetch['name']?>"class = "btn btn-sm btn-warning"><i class = "glyphicon glyphicon-edit"></i> Update</a> <a onclick = "delete_user(this); return false;"  href = "delete_hospital.php?id=<?php echo $fetch['hos_id']?>&name=<?php echo $fetch['name']?>" class = "btn btn-sm btn-danger"><i class = "glyphicon glyphicon-remove"></i> Delete</a></center></td>
						</tr>
					<?php
						}
						$conn->close();
					?>
					</tbody>
					</table>
			</div>
		</div>
	</div>
	<?php include "include/footer.php"; ?>	
	<script type = "text/javascript">
		function delete_user(that){
			var delete_func = confirm("Are you sure you want to delete this record?")
			if(delete_func){
				window.location = anchor.attr("href");
			}
		}
	</script>
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