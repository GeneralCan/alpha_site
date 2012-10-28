<?php
session_start();
	$usremail = $_POST['email'];
	$usrfname = $_POST['usrfname'];
	$usrlname = $_POST['usrlname'];
	$usrage = $_POST['usrage'];
	$usrgender = $_POST['usrgender'];
	$zipcode = $_POST['zipcode'];
	$passwrd = $_POST["passwrd2"] ? $_POST["passwrd2"] : "";
	$passwrd = md5($passwrd);
	
	include('../../../../sets.php');
	

	//$query="INSERT INTO `raffleiz_main`.`user_info` WHERE email='".$usremail."' (`ID`, `email`,`password`,`name`,`Lname`,`age`,`location`,`gender`) VALUES (NULL,'".$usremail."','".$passwrd."','".$usrfname."','".$usrlname."','".$usrage."','".$zipcode."','".$usrgender."')";
	
	$query="UPDATE `user_info` SET email='".$usremail."', password='".$passwrd."', name='".$usrfname."', Lname='".$usrlname."', age='".$usrage."', location='".$zipcode."', gender='".$usrgender."'  
	WHERE email='".$usremail."' && password='".$passwrd."'";

	mysql_query($query) or die ('Error Updating Data ' . mysql_error());

?>