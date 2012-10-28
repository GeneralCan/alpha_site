<?php
session_start();
if($_SESSION['u_name'] != ''){
echo 1; //session does not exist
 }
 else{
	 echo 0; //session exists
 }

?>