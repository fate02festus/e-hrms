<?php
	include_once('include/config.php');
	$conn->query("insert into `doctor_archive` select * from doctor WHERE `user_id` = '$_GET[id]'") or die(mysqli_error());
	$conn->query("DELETE FROM `doctor` WHERE `user_id` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
	header("location:user.php");

