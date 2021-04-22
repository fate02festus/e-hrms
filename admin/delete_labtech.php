<?php
	include_once('include/config.php');
		$conn->query("insert into `latech_archive` select * from labtech WHERE `user_id` = '$_GET[id]'") or die(mysqli_error());
	$conn->query("DELETE FROM `labtech` WHERE `user_id` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
	header("location:lab.php");