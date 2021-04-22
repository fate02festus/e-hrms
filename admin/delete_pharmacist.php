<?php
	include_once('include/config.php');
	$conn->query("insert into `pharmacist_archive` select * from pharmacist WHERE `user_id` = '$_GET[id]'") or die(mysqli_error());
	$conn->query("DELETE FROM `pharmacist` WHERE `user_id` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
	header("location:pharmacist.php");

