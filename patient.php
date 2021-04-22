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

		$date = date('d/m/Y');

		$_SESSION['pat_no'] = null;
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
	<?php include "include/sidebar.php"; ?>
	<div id = "content">
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
						<label for = "itr_no">Patient No:</label>
						<input class = "form-control" size = "12" min = "0" type = "number" value = "<?php echo $itr_no ?>" name = "itr_no" id="itr_no" disabled = 'disabled'>
					</div>
					<div style = "float:right;" class = "form-inline">
						<label for = "family_no">Huduma No:</label>
						<input class = "form-control" placeholder = "" size = "12" type = "text" name = "hu_no" pattern="[0-9]{1,7}" title="Enter numeric values">
					</div>
					<br />
					<br />
					<br />
					<div class = "form-inline">
						<label for = "firstname">Firstname:</label>
						<input class = "form-control" name = "firstname" type = "text"  required = "required"
						 pattern="[A-Za-z]{1,15}" title="Enter characters only">
						&nbsp;&nbsp;&nbsp;
						<label for = "middlename">Middle Name:</label>
						<input class = "form-control" name = "middlename" placeholder = "(Optional)" type = "text" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Lastname:</label>
						<input class = "form-control" name = "lastname" type = "text"  required = "required" pattern="[A-Za-z]{1,15}" title="Enter characters only">
					</div>
					<br />
					<div class ="form-inline">
						<label for = "birthdate">D.O.B:</label>
						<input class = "form-control" name = "date" id= "date" type = "date" min="1900-01-01" onchange="getDate(this.value)" required = "required">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "address">Phone No.:</label>
						<input class = "form-control" name = "phone" type = "number" min="1" required = "required" pattern="[0-9]{9,12}" title="Enter numerics value of length between 9 and 12 characters"> 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "address">Physical Address:</label>
						<input class = "form-control" name = "address" type = "text"  required = "required" pattern="[a-zA-Z]{1,30}" title="Enter characters only">
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
						<label for = "bp">Blood Pressure:</label>
						<input class = "form-control" name = "bp" type = "number" max = "250" min="150" pattern="[0-9]" title="Enter numerics value between 150 and 250" required = "required">
						&nbsp;&nbsp;&nbsp;
						<label for = "temp">Temperature:</label>
						<input class = "form-control" name = "temp" type = "number" placeholder="Temp (oC)" max = "38" min= "36" size = "15" pattern="[0-9]" title="Enter numerics value between 36 and 38" required = "required"><label>&deg;C</label>
						&nbsp;&nbsp;&nbsp;
						
						<label for = "wt">Weight :</label>
						<input class = "form-control" name = "wt" style = "width:10%;" type = "number" min= "1" max= "299" placeholder="Weight(Kg)" pattern="[0-9]" title="Enter numerics value between 1 and 299"required = "required"><label>kg</label>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<label for = "ht">Height :</label>
						<input class = "form-control" name = "ht" style = "margin-right:10px;" type= "number" min= "1" max= "299" placeholder="Height (M) " pattern="[0-9]" title="Enter numerics value between 1 and 299" required = "required"><label>cm</label>
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
				<!--<a href = "pdfspt.php" class = "btn btn-sm btn-print"><span class = "glyphicon glyphicon-pencil"></span> Print</a>-->
				<br />
				<br />
				<table id = "table" class = "display" width = "100%" cellspacing = "0">
					<thead>
						<tr>
							<th>Pat. No</th>
							<th>Name</th>
							<th>D.O.B</th>
							<th>Address</th>
							<th>Phone No.</th>
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
							<td><?php echo $fetch['phone']?></td>
							<td><?php echo $fetch['civil_status']?></td>
							<td><center><a href = "view_patient.php?id=<?php echo $fetch['pat_no']?>"class = "btn btn-sm btn-info"><span class   = "glyphicon glyphicon-search"></span> BASIC DETAILS</a> 
						    <a href = "complaints.php?id=<?php echo $fetch['pat_no']?>&lastname=<?php echo $fetch['lastname']?>" class = "btn btn-sm btn-info">Complaints <span class = "badge"><?php echo $f['total']?></span></a> 
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
                        return false;
                    } 
                } 
                else 
                {
                    alert("please provide your date of birth");
                    return;
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
                        return;
                    } 
                } 
                else 
                {
                    alert("please provide your date of birth");
                    return;
                }
            }
</script>	
</body>
</html>