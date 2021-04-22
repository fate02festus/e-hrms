<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
	include_once('include/config.php');
	//get hos code
		$id='1';
		$q = mysqli_query($conn, "SELECT * FROM `hospital` where is_current_hos='$id'") or die(mysqli_error());
		$f = mysqli_fetch_array($q);
		$code=$f['hos_id'];
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
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/customize.css" />
	</head>
<body>
	<?php include "include/header.php"; ?>
	
	<div >
		<br />
		<br />
		<br />
		<div style = "display:none;" id = "add_itr" class = "panel panel-success">	
			<div class = "panel-heading">
				<label>ADD PATIENT INFORMATION</label>
				<button id = "hide_itr" style = "float:right; margin-top:-4px;" class = "btn btn-sm btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
			</div>
			<div class = "panel-body">
				<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
					<div style = "float:left;" class = "form-inline">
						<label for = "itr_no">Pat. No:</label>
						<input class = "form-control" size = "12" min = "0" type = "number" value = "<?php echo $itr_no ?>" name = "itr_no" id="itr_no" disabled = 'disabled'>
					</div>
					<div style = "float:right;" class = "form-inline">
						<label for = "family_no">Huduma No:</label>
						<input class = "form-control" placeholder = "" required size = "12" type = "number" name = "hu_no">
					</div>
					<br />
					<br />
					<br />
					<div class = "form-inline">
						<label for = "firstname">Firstname:</label>
						<input class = "form-control" name = "firstname" type = "text" required = "required" pattern="/^[A-Za-z]+$/">
						&nbsp;&nbsp;&nbsp;
						<label for = "middlename">Middle Name:</label>
						<input class = "form-control" name = "middlename" placeholder = "(Optional)" type = "text" pattern="/^[A-Za-z]+$/">
						&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Lastname:</label>
						<input class = "form-control" name = "lastname" type = "text" required = "required" pattern="/^[A-Za-z]+$/">
					</div>
					<br />
					<div class ="form-inline">
						<label for = "birthdate">Birthdate:</label>
						<input class = "form-control" name = "date" id= "date" type = "date" onchange="getDate(this.value)" required = "required">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "address">Phone No.:</label>
						<input class = "form-control" name = "phone" type = "number"  max="10000000000" minlength="100000000" required = "required">
						
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "address">Physical Address:</label>
						<input class = "form-control" name = "address" type = "text" class="form-control input-lg" pattern="/^[A-Za-z]+$/"  required = "required">
					</div>
					<br />
					<div class ="form-inline">
						<label for = "civil_status">Civil Status:</label>
						<select style = "width:22%;" class = "form-control" name = "civil_status" required = "required">
							<option value = "">--Please select an option--</option>
							<option value = "Single">Single</option>
							<option value = "Married">Married</option>
						</select>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "gender">Gender:</label>
						<select style = "width:22%;" class = "form-control" name = "gender" required = "required">
							<option value = "">--Please select an option--</option>
							<option value = "Male">Male</option>
							<option value = "Female">Female</option>
						</select>
					</div>
					<br />
					<div class = "form-inline">
						<label for = "bp">BP:</label>
						<input class = "form-control" name = "bp" type = "number" max = "200" min = "0" required = "required">
						&nbsp;&nbsp;&nbsp;
						<label for = "temp">TEMP:</label>
						<input class = "form-control" name = "temp" type = "number" max = "99" min = "0" size = "15" required = "required"><label>&deg;C</label>
						&nbsp;&nbsp;&nbsp;
						
						<label for = "wt">WT :</label>
						<input class = "form-control" name = "wt" style = "width:10%;" type = "number" max = "300" min = "0" required = "required"><label>kg</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "ht">HT :</label>
						<input class = "form-control" name = "ht" style = "margin-right:10px;" type= "number" max = "99" min = "0" required = "required">
					</div>
					<br />
					<div class = "form-inline">
						<button class = "btn btn-primary" name = "save_patient"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
				</form>
			</div>	
		</div>	
		<?php require 'add_patient.php'?>
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<label>PATIENTS LIST</Label>
			</div>
			<div class = "panel-body">
				<button id = "show_itr" class = "btn btn-info"><span class = "glyphicon glyphicon-plus"></span> ADD PATIENT</button>
				<a href = "home.php" class = "btn btn-sm btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
				<br />
				<br />
				<table id = "table" class = "display" width = "100%" cellspacing = "0">
					<thead>
						<tr>
							<th>Pat. No</th>
							<th>Name</th>
							<th>Birthdate</th>
							<th>Address</th>
							<th>Civil Status</th>
							<th><center>Action</center></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = $conn->query("SELECT *,hrecold_temp.hospital as hospital FROM `patient` left join hrecold_temp on hrecold_temp.pat_no=patient.pat_no where hrecold_temp.date='$date' and hospital= '$code' ORDER BY patient.pat_no DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
						$id = $fetch['pat_no'];
						$q = $conn->query("SELECT COUNT(*) as total FROM `patient_hrecold` where `pat_no` = '$id'") or die(mysqli_error());
						$f = $q->fetch_array();
					?>
						<tr>
							<td><?php echo $fetch['pat_no']?></td>
							<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
							<td><?php echo $fetch['birthdate']?></td>		
							<td><?php echo $fetch['address']?></td>
							<td><?php echo $fetch['civil_status']?></td>
							<td> 
								<a href = "view_patient.php?pat_no=<?php echo $fetch['pat_no']?>"class = "btn btn-sm btn-info"><span class = "glyphicon glyphicon-search"></span> ADD BASIC DETAILS</a> 
							<a href = "update_patient.php?id=<?php echo $fetch['pat_no']?>&lastname=<?php echo $fetch['lastname']?>" class = "btn btn-sm btn-warning"><span class = "glyphicon glyphicon-pencil"></span> Update</a></center></td>
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
<?php include("script.php"); ?>
<script type = "text/javascript">
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
    function getDate() 
            {
                var dateString = document.getElementById("date").value;
                if(dateString !="")
                {
                    var today = new Date();
                    var birthDate = new Date(dateString); //format is mm.dd.yyyy
                    //var age = today.getFullYear() - birthDate.getFullYear();

                    if(today < birthDate )
                    {
                        alert("Invalid date");
                    } 
                } 
                else 
                {
                    alert("please provide your date of birth");
                }
            }
             function getString() 
            {
                var dateString = document.getElementById("date").value;
                if(dateString !="")
                {
                    var today = new Date();
                    var birthDate = new Date(dateString); //format is mm.dd.yyyy
                    //var age = today.getFullYear() - birthDate.getFullYear();

                    if(today < birthDate )
                    {
                        alert("Invalid date");
                    } 
                } 
                else 
                {
                    alert("please provide your date of birth");
                }
            }
</script>	
</body>
</html>