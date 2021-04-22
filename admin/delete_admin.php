<?php
   include_once('include/config.php');
   if($_GET['id']!="AD0003"){
   	$conn->query("insert into `admin_archive` select * from admin WHERE `admin_id` = '$_GET[id]'") or die(mysqli_error());
	 $conn->query("DELETE FROM `admin` WHERE `admin_id` = '$_GET[id]'") or die(mysqli_error());
   }
else
{
		echo "<script>alert('You cannot delete the super admin')</script>";
	}
	header("location:admin.php");
