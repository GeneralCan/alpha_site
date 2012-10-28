<?php 
session_start();

require_once('../../../../sets.php');

//connect and select DB
mysql_connect ($someHost, $usrname, $password) or die ('Error: ' . mysql_error());
mysql_select_db($Main_DB)or die ("cannot select DB :(");

function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
//Array to store validation errors
	$errmsg_arr = array();
	
//Validation error flag
	$errflag = false;

//transfer values sent from form
$email = clean($_POST['email2']);
$passwrd = md5(clean($_POST['passwrd3']));

	//Input Validations
	if($email == '' or $email == 'email') {
		$errmsg_arr[] = 'Incorrect Username or Password';
		$errflag = true;
	}
	if($passwrd == '' or $passwrd == 'password') {
		$errmsg_arr[] = 'Incorrect Username or Password';
		$errflag = true;
	}

if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		echo 'wrong';
		exit();
	}
	
$sql = "SELECT email,password FROM user_info WHERE email = '".$email."' and password = '".$passwrd."'";
$result = mysql_query($sql);

//count the number of rows found with the given info
$count = mysql_num_rows($result);

//the matched result must be equal to 1
if ($count == 1) {	
	$_SESSION['u_name'] = $email;
	$_SESSION['usrpasswrd'] = $passwrd;
	header("Location: ../../../index.php");
	exit();
}
else {?>
	<html>
		<head>
			<style type="text/css">
				body {background-image:url('../../images/light_toast.png');text-align:center;}
				/*--login base--*/
				#log {display:block;position:relative;margin-left:auto;margin-right:auto;margin-left:auto;top:100px;width:580px;height:250px;z-index:20;}
				#apDiv9 {position: absolute;left: 46px;top: 7px;color: #09F;font-size: 40px;font-weight: bold;font-family:"Myriad pro";width: 134px;height: 50px;z-index: 21;}
				/*--login form--*/
				#logForm {position: absolute;left: 38px;top: 11px;width: 506px;height: 238px;z-index: 21;}
				/*----Form fields--------------------------*/
				#apDiv10 {position: absolute;left: 25px;top: 61px;width: 423px;height: 36px;z-index: 21;}
				#apDiv11 {position: absolute;left: 25px;top: 125px;width: 405px;height: 31px;z-index: 22;}
				#apDiv12 {position: absolute;left: 375px;top: 183px;width: 100px;height: 43px;z-index: 21;}
				#apDiv13 {position: absolute;left: 545px;top: -28px;width: 61px;height: 59px;z-index: 21;}
				/*form validation styles-------------------------------------------------------------------------*/
				.hover { border: 5px; color:#39F;}
				img {border:0px;}
				.title{font-family: Arial; font-size: 24px; color:#000; font-weight:600;}
				.letters2{font-family: Candara; font-size: 17px; color:#CCC; font-weight:700;}
				.bold-text {font-family:Arial; font-weight:600; color:#333;}

				input, .textarea {padding: 9px;border: solid 1px #E5E5E5;outline: 0;font: normal 13px/100% Verdana, Tahoma, sans-serif;color:#666;width: 200px;height:45px;box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;-moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;-webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;}
				.textarea {max-width: 400px;line-height: 75%;}  
				.longbox{width:440px;}

				input:hover, textarea:hover,input:focus, textarea:focus {border-color: #C9C9C9;-webkit-box-shadow: rgba(0, 0, 0, .3) 0px 0px 8px;}
				.submit input {width: auto;height:40px;padding: 9px 15px;background: #7ac943;border: 0;font-size: 20px;color: #FFFFFF;font-family:"myriad pro";-moz-border-radius: 5px;-webkit-border-radius: 5px;} 

			</style>
 
			<!--javascripts to load -->
			<script type="text/javascript" src="../js/jquery-1.3.1.min.js"></script>
			<script type="text/javascript" src="../js/functions.js"></script>
			<script type="text/javascript" src="../js/jquery.validate.js"></script>
			<script type="text/javascript" src="../js/jquery.validation.functions.js"></script>
		</head>
		<body>
			<div id="log">
				<div id="errorComment" style="color:red;">*Wrong user name or password, let's try that again.</div>
				<div id="apDiv9">Login</div>
					<div id="logForm"><!--begin login form-->
						<form id="form2" name="form2" method="post" action="ajax_login.php">
							<div id="apDiv10"><!--sect1-->
								<label for="email2"></label>
								<input type="text" name="email2" id="email" class="longbox" value="email address" onFocus="clearMe(this);" onBlur="unClearMe(this);"/>
							</div><!--cloase sect1-->
							<div id="apDiv11"><!--sect2-->
								<label for="password3"></label>
								<input type="password" name="passwrd3" id="passwrd3" class="longbox" onFocus="clearMe(this);" onBlur="unClearMe(this);" value="password"/>
							</div><!--cloase sect2-->
			   <!--submit--><div id="apDiv12" class="submit"><input type="submit" name="submit2" value="submit"/></div>
						</form><!--end form-->
					</div><!--close loging form-->
			</div>
			<!--////end login section\\\\-->
		</body>
	</html>
<?php
}

?>