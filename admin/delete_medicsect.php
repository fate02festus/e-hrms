<?php
	include_once('include/config.php');
		//$conn->query("insert into `medicalsection_archive` select * from medicalsection WHERE `id` = '$_GET[id]'") or die(mysqli_error());
	$conn->query("DELETE FROM `medicalsection` WHERE `id` = '$_GET[id]'") or die(mysqli_error());
	header("location:medicalsection.php");