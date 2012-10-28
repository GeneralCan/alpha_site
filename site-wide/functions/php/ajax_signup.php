<?php
session_start();
function rpHash($value) {
	$hash = 5381;
	$value = strtoupper($value);
	for($i = 0; $i < strlen($value); $i++) {
		$hash = (($hash << 5) + $hash) + ord(substr($value, $i));
	}
	return $hash;
}
?>
<html>
<head>
<style type="text/css">
  @import "../css/jquery.realperson.css";
  #realPerson {
	position: absolute;
	left: 57px;
	top: 376px;
	width: 512px;
	height: 70px;
	z-index: 2;
		}
		.realperson-challenge { display:inline-block; }
		
.accepted { padding: 0.5em; border: 2px solid green; }
.rejected { padding: 0.5em; border: 2px solid red; }
</style>
<script type="text/javascript">
		$(function() {
			$('#defaultReal').realperson();
		});
		function usrsess(){
			var sess = "<?php echo $welcomeMessage; ?>";	
  			if (sess == 0 ){
	 			document.getElementById('welcomeDiv').style.display = 'none';  
  			}
		}
</script>
</head>
<body>
<?php
if (rpHash($_POST['defaultReal']) == $_POST['defaultRealHash']) {
	$usremail = $_POST['email'];
	$usrfname = $_POST['usrfname'];
	$usrlname = $_POST['usrlname'];
	$usrage = $_POST['usrage'];
	$usrgender = $_POST['usrgender'];
	$zipcode = $_POST['zipcode'];
	$passwrd = $_POST["passwrd2"] ? $_POST["passwrd2"] : "";
	$passwrd = md5($passwrd);
	
require_once('../../../../sets.php');


	echo "email </br>";
	echo $usremail;
	echo "</br> name </br>";
	echo $usrfname;
	echo "</br> lastname</br>";
	echo $usrlname;
	echo "</br> age </br>";
	echo $usrage;
	echo " </br>gender </br>";
	echo $usrgender;
	echo " </br>zipcode </br>";
	echo $zipcode;
	echo "</br> pass</br>";
	echo $passwrd;
	
$sql="SELECT email FROM user_info WHERE email='".$usremail."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

if(mysql_num_rows($result) > 0)
{
	echo "no";
	
}

else {

	$query="INSERT INTO `raffleiz_main`.`user_info` (`ID`, `email`,`password`,`name`,`Lname`,`age`,`location`,`gender`) VALUES (NULL,'".$usremail."','".$passwrd."','".$usrfname."','".$usrlname."','".$usrage."','".$zipcode."','".$usrgender."')";

//	$query="INSERT INTO `raffleiz_main`.`user_info` (`ID`, `email`, `password`) VALUES (NULL, '".$usremail."', '".$passwrd."')";

	mysql_query($query) or die ('Error Updating Data ' . mysql_error());

//------------------------send email --------------------------------------------------------------
 $to = $usremail;
 $subject = "Welcome to raffleize!";
 $body = "hello, thank you for joining raffleize.com :) we are awesome!";
 $headers = "From: Hello@rafflize.com\r\n" . "X-Mailer: php";
 mail($to, $subject, $body, $headers);

// ----------------------------------end send email--------------------------------------------------

		//now set the session from here if needed
	$_SESSION['u_name']= $usremail;
	//header("Location: ../../index.php");
	exit();
}

?>
<p class="accepted">You have entered the "real person" value correctly and the form has been processed.</p>
<?php
} else {
?>
<p class="rejected">ok, you got the captcha wrong. Don't panic you got this... let's get it right this time.</p>

<div id="reg" style="display:block;">		<!--///registration sections header -->
			<div id="reg-title">Account Registration</div>
			<div id="apDiv2">
				<div id="title">Facebook user?</div>
				<p id="content1">You can use your Facebook ccount <br /> to register for Raffleize.</p>
				<div id="apDiv4"></div><!--separator, image in css -->
				<div id="apDiv3">or</div>
				<div id="apDiv5"></div><!--separator, image in css -->
			</div><!--close div2-->
			
			<!--The registration form-->
			<div id="reg-form">
				<form id="form1" name="form1" method="post" action="site-wide/functions/php/ajax_signup.php" >
					<div id="sect1"><!--sect1-->
						<label for="Firstname"></label>
						<input type="text" name="usrfname" id="usrfname" value="first name" onFocus="clearMe(this);" onBlur="unClearMe(this);"/>
					</div><!--close sect1-->
					<div id="sect2"><!--sect2-->
						<label for="Lastname"></label>
						<input type="text" name="usrlname" id="usrlname" value="last name" onFocus="clearMe(this);" onBlur="unClearMe(this);"/>
					</div><!--close sect2-->
					<div id="sect3"><!--sect3-->
						<label for="Gender"></label>
						<input type="text" name="usrgender" id="usrgender" value="gender" onFocus="clearMe(this);" onBlur="unClearMe(this);"/>
					</div><!--close sect3-->
					<div id="sect4"><!--sect4-->
						<label for="Age"></label>
						<input type="text" name="usrage" id="usrage" value="age" onFocus="clearMe(this);" onBlur="unClearMe(this);"/>                
					</div><!--close sect4-->
					<div id="sect5"><!--sect5-->
						<label for="zipcode"></label>
						<input type="text" name="zipcode" id="zipcode" value="zipcode" onFocus="clearMe(this);" onBlur="unClearMe(this);"/>
                    </div><!--close sect5-->
					<div id="sect6"><!--sect6-->
						<label for="email"></label>
						<input type="text" name="email" class="longbox" id="email" value="email address" onFocus="clearMe(this);" onBlur="unClearMe(this);"/>
                    </div><!--close sect6-->
					<div id="sect7"><!--sect7-->
						<label for="password"></label>
						<input type="password" name="password" id="passwrd" value="password" onFocus="clearMe(this);" onBlur="unClearMe(this);"/>
                    </div><!--close sect7-->
					<div id="sect8"><!--sect8-->
						<label for="password2"></label>
						<input type="password" name="passwrd2" id="passwrd2"  onfocus="clearMe(this);" onBlur="unClearMe(this);"/>            
					</div><!--cloase sect8-->
       				<div id="realPerson">
                    <label for="realperson"></label>
       					<input type="text" id="defaultReal" name="defaultReal">
                    </div>
       <!--submit--><div id="apDiv8" class="submit">
       					 <input type="submit" name="submit2" value="Submit"/>
                    </div>
       			</form> <!--end form-->
 				<!--privacy policy and terms and conditions -->               
				<div id="apDiv7">Raffleize will use the information you submit in a manne concistant<br />
				with our <span class="blue">Privacy Policy</span> and <span class="blue">Terms of Use</span>. By clicking “Register” you <br />
				agree with Raffleize’s <span class="blue">Privacy Policy</span> and <span class="blue">Terms of  Use</span> and consent to<br />
				the collection, storage and use of this information in the U.S. <br />
				subject to U.S. laws and regulations. </div>
				<!--close terms and conditions -->
				</div>
			</div>
			<!--////end registration section\\\\-->
            
</body>
</html>
<?php
}
?>