<?php
require_once('../../../../sets.php');
// Connect to DB
 mysql_connect ($someHost, $usrname, $password) or die ('Error: ' . mysql_error());
//select DB
 mysql_select_db('raffleiz_main')or die ("cannot select DB :(");
//pull all the data from the rafflez
 $signups = mysql_query("SELECT * FROM `rafflez_info`") or die ('Error: ' . mysql_error());
 $row = mysql_num_rows($signups);
 
  for($p = 0; $p < $row; $p++){
  $participants[$p] = mysql_result($signups, $p, "#_participants");
 };
  for($a = 0; $a < $row; $a++){
  $max_participants[$a] = mysql_result($signups, $a, "max_participants");
 };
 echo $participants[0];

?>