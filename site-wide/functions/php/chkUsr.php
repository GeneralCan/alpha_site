<?php
session_start();
if($_SESSION['u_name'] != ''){
	$usrsession = $_SESSION['u_name'];
	require_once('../../../../sets.php');
// Connect to DB
 mysql_connect ($someHost, $usrname, $password) or die ('Error: ' . mysql_error());
//select DB
 mysql_select_db('raffleiz_main')or die ("cannot select DB :(");
 
//check if the user has already signed up for the current raffle
 $result = mysql_query("SELECT * FROM `raffle_joins` WHERE `1` = '".$usrsession."'") or die ('Error: ' . mysql_error());
 $user_data = mysql_fetch_row($result);

//if the user has not signed up then return 1
 if (empty($user_data)){
echo 1;
 }
//if the user has already signed up then send the value "false" to the main page
 else{
	  echo 0;
 }
 
 }


?>