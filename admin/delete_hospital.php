<?php
	include_once('include/config.php');
	$conn->query("DELETE FROM `hospital` WHERE `hos_id` = '$_GET[id]' && `name` = '$_GET[name]'") or die(mysqli_error());
	header("location:hospital.php");

