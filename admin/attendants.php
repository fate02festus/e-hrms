<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
	$conn = new mysqli("localhost", "root", "", "ehrms") or die(mysqli_error());
	//get hos code
		$id='5';
		$code='AT';
		//get last docno
		$qq = mysqli_query($conn, "SELECT * FROM `sys_master` where id='$id'") or die(mysqli_error());
		$ff = mysqli_fetch_array($qq);
		$lno=intval($ff['last_no'])+1;
		$ln=str_pad($lno, intval($ff['length']), "0", STR_PAD_LEFT);
		$itr_no=$code.$ln;

		$row = mysqli_query($conn, "SELECT * FROM `hospital` order by hos_id") or die(mysqli_error());
		$row1 = mysqli_fetch_all($row);

		function mysql_fetch_all($query) 
		{
		    $all = array();
		    while ($all[] = mysql_fetch_assoc($query)) {$temp=$all;}
		    return $temp;
		}
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
				<label>ADD MEDICAL ATTENDANT</label>
				<button id = "hide" class = "btn btn-sm btn-danger" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
			</div>
			<div class = "panel-body">
				<form id = "form_user" method = "POST" enctype = "multi-part/form-data">
					<div class = "panel panel-default" style = "width:60%; margin:auto;">
					<div class = "panel-heading">
					</div>
					<div class = "panel-body">
						<div class = "form-group">
							<label for = "username">Attendant Code: </label>
							<input class = "form-control" name = "unique_code" type = "text" value = "<?php echo $itr_no ?>"  required = "required" disabled = 'disabled'>
						</div>
						<div class = "form-group">
							<label for = "username">Username: </label>
							<input class = "form-control" name = "username" type = "email" required = "required">
						</div>
						<div class = "form-group">
							<label for = "firstname">Firstname: </label>
							<input class = "form-control" type = "text" name = "firstname"  required = "required" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						</div>
						<div class = "form-group">
							<label for = "middlename">Middlename: </label>
							<input class = "form-control" type = "text" placeholder = "(Optional)"  name = "middlename" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						</div>
						<div class = "form-group">
							<label for = "lastname">Lastname: </label>
							<input class = "form-control" type = "text" name = "lastname" required = "required" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						</div>
						<div class = "form-group">
							<label for = "lastname">Phone: </label>
							<input class = "form-control" type = "number" min="1" name = "contacts" required = "required" pattern="[0-9]{9,12}" title="Enter numerics value of length between 9 and 12 characters">
						</div>
						<div class = "form-group">
							<label for = "lastname">ID No.: </label>
							<input class = "form-control" type = "number" min="1" name = "idno" required = "required" pattern="[0-9]{7,8}" title="Enter numerics value of length between 7 and 8 characters">
						</div>
						<div class = "form-group">
							<label for = "lastname">Physical Address: </label>
							<input class = "form-control" type = "text" name = "address" required = "required"  pattern="[A-Za-z]{1,15}" title="Enter characters only">
						</div>
						<div class = "form-group">
							<label for = "section">Hospital: </label>
							<select name = "hospital" class = "form-control" required = "required">
								<?php foreach ($row1 as $p) {?>
								<option value = "<?php echo $p['1'];?>"><?php echo $p['1'];?></option>
								 <?php } ?>
							</select>
						</div>
						<div class = "form-group">	
							<label for = "password">Password: </label>
							<input class = "form-control" name = "password" maxlength = "12" type = "password" required = "required">
						</div>
						<div class = "form-group">	
							<label for = "password">Confirm Password: </label>
							<input class = "form-control" name = "confpassword" maxlength = "12" type = "password" required = "required">
						</div>
						
							<button class = "btn btn-primary" name = "save_attendant" ><span class = "glyphicon glyphicon-save"></span> SAVE</button>
							<br />
					</div>	
					<?php require 'add_attendant.php'?>
					</div>
				</form>			
			</div>	
		</div>	
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<label>ACCOUNTS / ATTENDANT</Label>
			</div>
			<div class = "panel-body">
				<button id = "show" class = "btn btn-info"><span class  = "glyphicon glyphicon-plus"></span> ADD</button>
				<a href = "home.php" class = "btn btn-sm btn-warning"><span class = "glyphicon glyphicon-pencil"></span> BACK</a>
				<br />
				<br />
				<table id = "table" class = "display" width = "100%" cellspacing = "0">
					<thead>
						<tr>
							<th>Username</th>
							<th>Name</th>
							<th>ID. No.</th>
							<th>Phone</th>
							<th>Hospital</th>
							<th><center>Action</center></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = $conn->query("SELECT * FROM `attendant` ORDER BY `user_id` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
					?>
						<tr>
							<td><?php echo $fetch['username']?></td>
							<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
							<td><?php echo $fetch['idno']?></td>
							<td><?php echo $fetch['contact']?></td>
							<td><?php echo ($fetch['hospital'])?></td>
							<td><center><a href = "edit_attendant.php?id=<?php echo $fetch['user_id']?>&lastname=<?php echo $fetch['lastname']?>"class = "btn btn-sm btn-warning"><i class = "glyphicon glyphicon-edit"></i> Update</a> <a onclick = "delete_user(this); return false;"  href = "delete_attendant.php?id=<?php echo $fetch['user_id']?>&lastname=<?php echo $fetch['lastname']?>" class = "btn btn-sm btn-danger"><i class = "glyphicon glyphicon-remove"></i> Archive</a></center></td>
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