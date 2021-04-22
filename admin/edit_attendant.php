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
	<?php include "include/sidebar.php"; ?><script>
// Defining a function to display error message
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}
// Defining a function to validate form 
function validateForm() {
    // Retrieving the values of form elements 
    var fname = document.form_user.firstname.value;
    var mname = document.form_user.middlename.value;
    var lname = document.form_user.lastname.value;
    var email = document.form_user.username.value;
    var mobile = document.form_user.contact.value;
    var id = document.form_user.idno.value;
    
	// Defining error variables with a default value
    var fnameErr = emailErr = mobileErr = lnameErr = mnameErr =idErr= true;
    printError("nameErr", "Please enter your firstname");
    // Validate name
    if(fname == "") {
        printError("nameErr", "Please enter your firstname");
    } else {
        var regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(mname) === false) {
            printError("nameErr", "Please enter a valid name");
        } else {
            printError("nameErr", "");
            fnameErr = false;
        }
    }
    if(mname == "") {
        printError("nameErr", "Please enter your middlename");
    } else {
        var regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(middlename) === false) {
            printError("nameErr", "Please enter a valid name");
        } else {
            printError("nameErr", "");
            mnameErr = false;
        }
    }
    if(lname == "") {
        printError("lnameErr", "Please enter your lastname");
    } else {
        var regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(lastname) === false) {
            printError("lnameErr", "Please enter a valid name");
        } else {
            printError("lnameErr", "");
            lnameErr = false;
        }
    }
    // Validate email address
    if(email == "") {
        printError("emailErr", "Please enter your username address");
    } else {
        // Regular expression for basic email validation
        var regex = /^\S+@\S+\.\S+$/;
        if(regex.test(username) === false) {
            printError("emailErr", "Please enter a valid username address");
        } else{
            printError("emailErr", "");
            emailErr = false;
        }
    }
    
    // Validate mobile number
    if(mobile == "") {
        printError("mobileErr", "Please enter your mobile number");
    } else {
        var regex = /^[0-9]\d{10}$/;
        if(regex.test(contact) === false) {
            printError("mobileErr", "Please enter a valid 10 digit mobile number");
        } else{
            printError("mobileErr", "");
            mobileErr = false;
        }
    } 
    if(id == "") {
        printError("idErr", "Please enter your id number");
    } else {
        var regex = /^[0-9]\d{8}$/;
        if(regex.test(idno) === false) {
            printError("idErr", "Please enter a valid 8 digit id number");
        } else{
            printError("idErr", "");
           idErr = false;
        }
    } 
};
</script>
	<div id = "content">
		<br />
		<br />
		<br />
		<div class = "panel panel-success">	
		<?php
		 include "include/config.php"; 
		    $query = $conn->query(" SELECT * FROM `attendant` WHERE `user_id` = '$_GET[id]'") or die(mysqli_error());
			$fetch = $query->fetch_array();

			$row = mysqli_query($conn, "SELECT * FROM `hospital` order by hos_id") or die(mysqli_error());
		$row1 = mysqli_fetch_all($row);
		?>
			<div class = "panel-heading">
				<label>EDIT ATTENDANT</label>
				<a href = "attendants.php" class = "btn btn-sm btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<div class = "panel-body">
				<form id = "form_user" name="form_user" onsubmit="return validateForm()"  method = "POST" enctype = "multi-part/form-data">
					<div class = "panel panel-default" style = "width:60%; margin:auto;">
					<div class = "panel-heading">
					</div>
					<div class = "panel-body">
						<div class = "form-group">
							<label for = "username">Username: </label>
							<input class = "form-control" value = "<?php echo $fetch['username']?>" name = "username" type = "email" required = "required">
						</div>
						<div class = "form-group">	
							<label for = "password">Password: </label>
							<input class = "form-control" name = "password" maxlength = "12" value = "<?php echo $fetch['password']?>" type = "password" required = "required">
						</div>
						<div class = "form-group">
							<label for = "firstname">Firstname: </label>
							<input class = "form-control" type = "text" value = "<?php echo $fetch['firstname']?>" name = "firstname" required = "required" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						<div class = "form-group">
							<label for = "middlename">Middlename: </label>
							<input class = "form-control" type = "text" value = "<?php echo $fetch['middlename']?>" name = "middlename" placeholder = "(Optional)" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						</div>
						<div class = "form-group">
							<label for = "lastname">Lastname: </label>
							<input class = "form-control" type = "text" value = "<?php echo $fetch['lastname']?>" name = "lastname" required = "required" pattern="[A-Za-z]{1,15}" title="Enter characters only">
						</div>
						<div class = "form-group">
                            <label for = "lastname">Phone: </label>
                            <input class = "form-control" type = "number" min="1" value = "<?php echo $fetch['contact']?>" name = "contacts" required = "required" pattern="[0-9]{9,12}" title="Enter numerics value of length between 7 and  8  characters">
                        </div>
                        <div class = "form-group">
                            <label for = "lastname">ID No.: </label>
                            <input class = "form-control" type = "number" min="1" value = "<?php echo $fetch['idno']?>" name = "idno" required = "required" pattern="[0-9]{7,8}" title="Enter numerics value of length between 9 and 12 characters"> 
                        </div>
						<div class = "form-group">
							<label for = "section">Hospital: </label>
							<select name = "hospital" class = "form-control" required = "required">
								<?php foreach ($row1 as $p) {?>
								<option value = "<?php echo $p['1'];?>"><?php echo $p['1'];?></option>
								 <?php } ?>
							</select>
						</div>
							<button class = "btn btn-warning" name = "edit_attendant" type="submit" value="submit"><span class = "glyphicon glyphicon-edit"></span> SAVE</button>
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