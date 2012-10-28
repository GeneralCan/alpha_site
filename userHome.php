<?php
session_start();
	
	$email = $_SESSION['u_name'];
	$passwrd = $_SESSION['usrpasswrd'];
	
	require_once('../sets.php');
  
  // Connect to DB
mysql_connect ($someHost, $usrname, $password) or die ('Error: ' . mysql_error());
//select the DataBase
mysql_select_db($Main_DB)or die ('cannot select DB :('. mysql_error());

	if(isset($_SESSION['u_name']) && isset($_SESSION['usrpasswrd'])){
		$sql = "SELECT email,password,name,Lname,age,location,gender,acess,engagement,rafflez,sharing FROM user_info WHERE email = '".$email."' and password = '".$passwrd."'";
	
		$result = mysql_query($sql);
	
		if($result === FALSE) {
    		die(mysql_error()); // TODO: better error handling
		}
		$row = mysql_fetch_array($result);
	
		//select everything belonging to this specific user and store in variables
		$fisrtName = $row["name"];
		$lastName = $row["Lname"];
		$age = $row["age"];
		$location = $row["location"];
		$gender = $row["gender"];
		$access = $row["acess"];
		$engagement = $row["engagement"];
		$rafflez = $row["rafflez"];
		$sharing = $row["sharing"];
	
	} 
	else {
		echo '<div style="position:fixed;left:0px;right:0px;top:0px;width:100%; height:100%; background-color:black;z-index:200;"><img src="site-wide/images/error.fw.png" width="700" height="500" alt="error" /> </div>';
 		session_destroy();
		header("Location: index.php");
	exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
    <!--style sheets-->
    <link rel="stylesheet" type="text/css" href="site-wide/functions/css/globalR.css" />
       
    <style type="text/css">
	a { color:#333;}
    	#content {
			font-family:Arial, Helvetica, sans-serif;
			text-align:left;
			background-color: #FFF;
			position: absolute;
			left: 0px;
			top: 150px;
			width: 960px;
			height: 400px;
			z-index: 1;
		}
		#logout {
	position: absolute;
	left: 910px;
	top: -17px;
	width: 53px;
	height: 23px;
	z-index: 2;
		}
    #sessionName {
	position: absolute;
	left: 5px;
	top: 1px;
	width: 436px;
	height: 35px;
	z-index: 26;
}
/*--user edit form--*/
#user-form {
	position: absolute;
	left: 14px;
	top: 46px;
	width: 840px;
	height: 343px;
	z-index: 21;
}
/*----Form fields--------------------------*/
	#usrSect1 {
	position: absolute;
	left: 15px;
	top: 19px;
	width: 189px;
	height: 44px;
	z-index: 3;
}
	#usrSect2 {
	position: absolute;
	left: 15px;
	top: 74px;
	width: 194px;
	height: 44px;
	z-index: 3;
}
	#usrSect3 {
	position: absolute;
	left: 12px;
	top: 191px;
	width: 193px;
	height: 48px;
	z-index: 3;
}
	#usrSect4 {
	position: absolute;
	left: 465px;
	top: 191px;
	width: 181px;
	height: 46px;
	z-index: 3;
}
	#usrSect5 {
	position: absolute;
	left: 238px;
	top: 191px;
	width: 184px;
	height: 50px;
	z-index: 3;
}
	#usrSect6 {
	position: absolute;
	left: 14px;
	top: 131px;
	width: 443px;
	height: 50px;
	z-index: 3;
}
	#usrSect7 {
	position: absolute;
	left: 13px;
	top: 254px;
	width: 182px;
	height: 50px;
	z-index: 3;
}
	#usrSect8 {
	position: absolute;
	left: 240px;
	top: 254px;
	width: 184px;
	height: 50px;
	z-index: 3;
}
/*----end form fields----------------------*/

#submit-changes {
	position: absolute;
	left: 710px;
	top: 267px;
	width: 107px;
	height: 49px;
	z-index: 21;
}
/*--end user edit form--*/

    </style>
        
        <!--javascripts to load -->
        <script type="text/javascript" src="site-wide/functions/js/jquery-1.3.1.min.js"></script>
  		<script type="text/javascript" src="site-wide/functions/js/functions.js"></script>
  		<script type="text/javascript" src="site-wide/functions/js/jquery.validate.js"></script>
  		<script type="text/javascript" src="site-wide/functions/js/jquery.validation.functions.js"></script>

</head>


	<body>

		<!--Navigation header-->
   	<nav>	
        <!--wrapper-->
   	  <div id="wrapper">
			<div id="logo"><img src="site-wide/images/logo.png" width="163" height="28" alt="Raffleize.com"></div>
            <!--list-->
        <ul>
       	  <li><a href="#">How it Works</a></li>
              <!--drop down-->
          <li class="dropList">
              	<a href="#">About</a>
                <!--dropdown box #1-->
                <div id="dropBox1">
                	<div id="dropOut"><!--begin dropbox-->
                		<ul><!--dropdown items-->
							<li>About us</li>
							<li>Terms of Use</li>
							<li>Privacy Policy</li>
						</ul><!--end dropdown items-->
                    </div><!--end dropbox-->
                </div> 
                <!--end dropdown box #1-->               
              </li>
              <div id="welcomeDiv"></div>
              
              <li style="color:#FFF;"><a href="javascript:LogDispOn()">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;or</li><!--login buton-->
		  <li id="navr"><a href="javascript:RegDispOn()">Signup</a></li><!--register button-->
        </ul>
        
<!--this is where user's information is displayed -->
      <div id="content">
       	  <div id="logout" class="text"><a href="site-wide/functions/php/logout.php">logout</a></div>
        <div id="sessionName">welcome, <?php echo $fisrtName; ?></div>
              		<!--The registration form-->
			<div id="user-form">
				<form id="form1" name="form1" method="post" action="site-wide/functions/php/ajax_edit.php" >
					<div id="usrSect1"><!--sect1-->
						<label for="Firstname"></label>
						<input type="text" name="usrfname" id="usrfname" value="<?php echo $fisrtName; ?>" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
					</div><!--close sect1-->
					<div id="usrSect2"><!--sect2-->
						<label for="Lastname"></label>
						<input type="text" name="usrlname" id="usrlname" value="<?php echo $lastName; ?>" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
					</div><!--close sect2-->
                    <div id="usrSect6"><!--sect6-->
						<label for="email"></label>
						<input type="text" name="email" class="longbox" id="email" value="<?php echo $_SESSION['u_name']; ?>" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
                    </div><!--close sect6-->
					<div id="usrSect3"><!--sect3-->
						<label for="Gender"></label>
						<input type="text" name="usrgender" id="usrgender" value="<?php echo $gender; ?>" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
					</div><!--close sect3-->
					<div id="usrSect5"><!--sect5-->
						<label for="zipcode"></label>
						<input type="text" name="zipcode" id="zipcode" value="<?php echo $location; ?>" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
                    </div><!--close sect5-->
                    <div id="usrSect4"><!--sect4-->
						<label for="Age"></label>
						<input type="text" name="usrage" id="usrage" value="<?php echo $age; ?>" onfocus="clearMe(this);" onblur="unClearMe(this);"/>                
					</div><!--close sect4-->
					
					<div id="usrSect7"><!--sect7-->
						<label for="password"></label>
						<input type="password" name="password" id="passwrd" value="password" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
                    </div><!--close sect7-->
					<div id="usrSect8"><!--sect8-->
						<label for="password2"></label>
						<input type="password" name="passwrd2" id="passwrd2"  onfocus="clearMe(this);" onblur="unClearMe(this);"/>            
					</div><!--cloase sect8-->
					
       <!--submit--><div id="submit-changes" class="submit"><input type="submit" name="submit2" value="Submit"/></div>
       			</form> <!--end form-->
		  </div>
	  </div>
			<!--////end registration section\\\\-->
<!--===========================================================================-->            
   	  </div>
 <!--end wrapper-->
	</nav>
	<!--end Navigation header-->
	
    <nav id="footer">
    </nav>
</body>
</html>
