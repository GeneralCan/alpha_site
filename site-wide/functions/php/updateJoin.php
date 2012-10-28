<?php
session_start();
if($_SESSION['u_name'] != ''){
	$usrsession = $_SESSION['u_name'];
require_once('../../../../sets.php');
// Connect to DB
  mysql_connect ($someHost, $usrname, $password) or die ('Error: ' . mysql_error());
//select DB
 mysql_select_db('raffleiz_main')or die ("cannot select DB :(");
 
//add plus 1 to the raffle being used at the time
	 mysql_query("UPDATE `rafflez_info` SET `#_participants`= `#_participants`+1 WHERE (rafflez_info.raffle_name='Demo')") or die ('Error: ' . mysql_error());
//add $_SESSION['u_name'] to the table containing how many users signed up for the specific raffle
 	mysql_query("INSERT INTO `raffleiz_main`.`raffle_joins` (`ID`,`1`) VALUES (NULL, '".$usrsession."')")or die ('Error: ' . mysql_error()); 
	
	 $to = $usrsession;
 $subject = "You Joined a Raffle!";
 $body = "We would like to thank you for entering the raffle on Raffleize.\nWe wish you the best of luck. Go ahead tweet, like and share the raffle to ensure all the prizes are unlocked.\n\n\nAll the best,\n\n\nThe Raffleize team";
 $headers = "From: Hello@rafflize.com\r\n" . "X-Mailer: php";
 if (mail($to, $subject, $body, $headers)or die ('Error: ' . mysql_error())) {
   
   echo 1;
  } else {
   echo 0;
  } 
}
 ?>