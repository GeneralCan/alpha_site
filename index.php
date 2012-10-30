<?php
  session_start();
  if(!isset($_SESSION['u_name'])){
	$_SESSION['u_name'] = '';
	$welcomeMessage = 0;
	} 
	if(isset($_SESSION['u_name']) || isset($_SESSION['usrpasswrd'])){
		$welcomeMessage = $_SESSION['u_name'];
	}
	else{
		$welcomeMessage = 0;
	}
	require_once('../sets.php');

  //require("site-wide/effects/social.php");
  //fb_count();
  
  // Connect to DB
  mysql_connect ($someHost, $usrname, $password) or die ('Error: ' . mysql_error());
  
  //select DB
  mysql_select_db($Main_DB)or die ('cannot select DB :(' . mysql_error());
  
  //pull all the data from the rafflez
  $signups = mysql_query("SELECT * FROM $rafflez_info ") or die ('Error: ' . mysql_error());
  $row = mysql_num_rows($signups);
  
  //pull timer data
  $res = mysql_query("SELECT `timer` FROM $rafflez_info");
  $row2 = mysql_num_rows($res);
  
  //make sure that the variables are empty
  unset($participants);
  unset($max_participants);
  unset($endtime);
  
  //pull all of the data and store it
  for($a = 0; $a < $row; $a++){
	$max_participants[$a] = mysql_result($signups, $a, "max_participants");
	};
  for($t = 0; $t < $row2; $t++){
	$endtime[$t] = mysql_result($res, $t, "timer");
	};
	
  // Facebook integration------------------------------------------------------------
  //$title=urlencode("Raffleize!");
  //$url=urlencode("http://www.test.raffleize.com");
  //$summary=urlencode("We're giving away 3 $10 itunes gift cards. The more people join the more prizes we can give away");
  //$image=urlencode("http://www.test.raffleize.com/site-wide/RCS_Logo.png");
  //end Facebook integration----------------------------------------------------------
	
  ?>

<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Raffleize | Home</title>
        
<!--style sheets-->
        <link rel='stylesheet' id='style-css'  href="site-wide/functions/css/diapo.css" type='text/css' media='all' /> 
        <link rel="stylesheet" type="text/css" href="site-wide/functions/css/globalR.css" />
        <link rel="stylesheet" type="text/css" href="site-wide/functions/css/homeR.css" /> 
       
<!--javascripts to load
        <script type="text/javascript" src="site-wide/functions/js/jquery-1.3.1.min.js"></script> -->
        <script type='text/javascript' src='site-wide/functions/js/jquery.min.js'></script> 
  		<script type="text/javascript" src="site-wide/functions/js/functions.js"></script>
  		<script type="text/javascript" src="site-wide/functions/js/jquery.validate.js"></script>
  		<script type="text/javascript" src="site-wide/functions/js/jquery.validation.functions.js"></script>
        <script type="text/javascript" src="site-wide/functions/js/jquery.realperson.min.js"></script>

 
<!--slideshow script-->
<!--[if !IE]><!--><script type='text/javascript' src='site-wide/functions/js/jquery.mobile-1.0rc2.customized.min.js'></script><!--<![endif]-->
		<script type='text/javascript' src='site-wide/functions/js/jquery.easing.1.3.js'></script> 
		<script type='text/javascript' src='site-wide/functions/js/jquery.hoverIntent.minified.js'></script> 
	<script type='text/javascript' src='site-wide/functions/js/diapo.js'></script> 


<!--share this buttons 
 	 	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
  		<script type="text/javascript">stLight.options({publisher: "ur-10cc6ff7-2386-e8d9-c5c-681d416f29b7"}); </script>
  -->
  <style type="text/css">
  @import "site-wide/functions/css/jquery.realperson.css";
  
 
body {
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: 12px;
	line-height: 20px;
}
section {
	display: block;
	overflow: hidden;
	position: relative;
}


  #realPerson {
	position: absolute;
	left: 57px;
	top: 376px;
	width: 512px;
	height: 70px;
	z-index: 2;
		}
		.realperson-challenge { display:inline-block; }
  #apDiv1 {
	position: absolute;
	left: 158px;
	top: 1px;
	width: 350px;
	height: 70px;
	background-color: #E6E6E6;
	z-index: 1;
}
  </style>
<!--custom javascript functions-->
  		<script type="text/javascript">
		//slideshow
		$(function(){
			$('.pix_diapo').diapo();
		});
		//end slideshow
		
		$(function() {
			$('#defaultReal').realperson();
		});
		function usrsess(){
			var sess = "<?php echo $welcomeMessage; ?>";	
  			if (sess == 0 ){
	 			document.getElementById('welcomeDiv').style.display = 'none';  
  			}
		}
  		//----------------------Join Button--------------------------------------------------
			function joinraffle(){
		//check if user session exsists
				$.post("site-wide/functions/php//chkSess.php", function(session){//.post()1
					var usrsession = session;
					if (usrsession == 0){
		//if user session does not exist pull up loginScreen
						LogDispOn();
						$("html, body").animate({ scrollTop: 0 }, "slow");
						}//end if
					
		//if user session exists check if user has already signed up for current raffle and submit query if FALSE
						else{
							$.post("site-wide/functions/php/chkUsr.php", function(usr){//.post()2
								var usrSet = usr;
		//if user is not registered in the current raffle share
								if (usrSet == 1){
		//update DB and share
									$.post("site-wide/functions/php/updateJoin.php");//.post()3
  		//requires sharescreen-		shareScreen(); 
  		//-							$("html, body").animate({ scrollTop: 0 }, "slow");
								}//end if
							
		//if user is registered in the current raffle
								else{
									alert("You can only Raffleize Once per giveaway");
  		//requires sharescreen-		shareScreen(); 
  		//-							$("html, body").animate({ scrollTop: 0 }, "slow");
								}//end else
				   			});//end .post()2
						}//end else
				});//end .post()1
			}//end function
  //----------------------------end joinraffle------------------------------------
   
  //-------progress bar----------------------------------------------
  
  //function to read data from database and adjust the progress bar acording to it
	function progress(data){
		$.post("site-wide/functions/php/loadBarAjax.php", function(loading){
			var signups = loading;
  
			//pull variables form PHP and store them to javascript
			var maxP = "<?php echo $max_participants[0]; ?>";
			//run the calculations for percentage
			var pSignup = signups / maxP;
			var total = 948 * pSignup;
			
			//change the width of the given image based on the percent given
			if(signups < 17){
				$('#unlock1').hide();
				$('#unlock2').hide();
				$('#unlock3').hide();
				$('#lock1').show("fade");
				$('#lock2').show("fade");
				$('#lock3').show("fade");
				}//end if
			if(signups >= 17){
				$('#unlock1').show("fade");
				$('#unlock2').hide();
				$('#unlock3').hide();
				$('#lock2').show("fade");
				$('#lock3').show("fade");
				}//end if
			if(signups >= 34){
				$('#unlock2').show("fade");
				$('#unlock3').hide();
				$('#lock1').hide();
				$('#lock2').hide();
				$('#lock3').show("fade");
				}//end if
			if(signups >= 52){
				$.post("site-wide/effects/massMail.php", function(mails){//.post()
				mail = mails;
				alert(mail);
				});
				$('#unlock3').show("fade");
				}//end if
  
			//if the total is greater than 550 then just set it as 550
			if(total > 948){
				total = 948;
				}//end if
			theImg = document.getElementById('progress');
			theImg.width = total;
		});	//end .post()
	}//end function
	
  //update the progress bar every 5 seconds
  var update = setInterval( progress, 5000);
  
  //------------end progresbar---------------------------------------------------
  
  
  //------Countdown Clock-------------------------------------------------------
  
	//pull endtime from php based on DB  
	var endtime = "<?php echo date('Y/m/d H:i:s', strtotime($endtime[0])); ?>";
	var dateFuture1;
	var dateNow;
	var amount;
	dateFuture1 = new Date(endtime);
	function GetCount(ddate, iid) {
		dateNow = new Date();	//grab current date
		amount = ddate.getTime() - dateNow.getTime();
		
		//calc milliseconds between dates
		// if time is already past
		if (amount <= 0) {
			document.getElementById(iid).innerHTML="00  00  00  00";
			document.getElementById("countbox1").className="red";
			}//end if
		// else date is still good
		else{
			document.getElementById("countbox1").className="blue";
			days=0;
			hours=0;
			mins=0;
			secs=0;
			out="";
		
			amount = Math.floor(amount/1000);  //kill the milisecs so just secs
  
			days = Math.floor(amount/86400); //days
			amount = amount%86400;
			days = ("0" + days).slice (-2); // show zeros in single-digit numbers
  
			hours = Math.floor(amount/3600);//hours
			amount = amount%3600;
			hours = ("0" + hours).slice (-2); // show zeros in single-digit numbers
  
			mins = Math.floor(amount/60);//minutes
			amount = amount%60;
			mins = ("0" + mins).slice (-2); // show zeros in single-digit numbers
		
			secs = Math.floor(amount);//seconds
			secs = ("0" + secs).slice (-2); // show zeros in single-digit numbers
		
			if(days !== 0){
				out += days +" "+((days==1)?"":"")+" ";
				}//end if
			if(hours !== 0){
				out += hours +" "+((hours==1)?"":"")+" ";
				}//end if
				
			out += mins +" "+((mins==1)?"":"")+" ";
			out += secs +" "+((secs==1)?"":"")+" ";
			out = out.substr(0,out.length-2);
			document.getElementById(iid).innerHTML=out;		
			setTimeout(function(){GetCount(ddate,iid)}, 1000);
			}//end else
  }//end Getcountdown()
  
  window.onload=function(){
	  GetCount(dateFuture1, 'countbox1');
	  progress();
	};//end onload function
  //----------end countdown clock----------------------------------------------
	
  </script>
	
	</head>

	<body>
    	<!--//////Begin fade\\\\\-->
	<div id="fade">
		<!--////Registration section\\\\-->
		<div id="reg">		<!--///registration sections header -->
			<div id="reg-title">Account Registration</div>
			<div id="apDiv2">
				<div id="title">Facebook user?</div>
				<p id="content1">You can use your Facebook ccount <br /> to register for Raffleize.</p>
				<div id="apDiv4"></div><!--separator, image in css -->
				<div id="apDiv3">or</div>
				<div id="apDiv5"></div><!--separator, image in css -->
			</div><!--close div2-->
			<div id="apDiv6"><a href="javascript:RegDispOff()"><img src="site-wide/images/close.png" width="45" height="45" alt="Close" /></a></div>

			<!--The registration form-->
			<div id="reg-form">
				<form id="form1" name="form1" method="post" action="site-wide/functions/php/ajax_signup.php" >
					<div id="sect1"><!--sect1-->
						<label for="Firstname"></label>
						<input type="text" name="usrfname" id="usrfname" value="first name" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
					</div><!--close sect1-->
					<div id="sect2"><!--sect2-->
						<label for="Lastname"></label>
						<input type="text" name="usrlname" id="usrlname" value="last name" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
					</div><!--close sect2-->
					<div id="sect3"><!--sect3-->
						<label for="Gender"></label>
						<input type="text" name="usrgender" id="usrgender" value="gender" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
					</div><!--close sect3-->
					<div id="sect4"><!--sect4-->
						<label for="Age"></label>
						<input type="text" name="usrage" id="usrage" value="age" onfocus="clearMe(this);" onblur="unClearMe(this);"/>                
					</div><!--close sect4-->
					<div id="sect5"><!--sect5-->
						<label for="zipcode"></label>
						<input type="text" name="zipcode" id="zipcode" value="zipcode" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
                    </div><!--close sect5-->
					<div id="sect6"><!--sect6-->
						<label for="email"></label>
						<input type="text" name="email" class="longbox" id="email" value="email address" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
                    </div><!--close sect6-->
					<div id="sect7"><!--sect7-->
						<label for="password"></label>
						<input type="password" name="password" id="passwrd" value="password" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
                    </div><!--close sect7-->
					<div id="sect8"><!--sect8-->
						<label for="password2"></label>
						<input type="password" name="passwrd2" id="passwrd2"  onfocus="clearMe(this);" onblur="unClearMe(this);"/>            
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

			<!--////begin login section\\\\-->
			<div id="log">
				<div id="apDiv13"><a href="javascript:LogDispOff()"><img src="site-wide/images/close.png" width="57" height="57" alt="close" /></a></div>
				<div id="apDiv9">Login</div>
				<div id="logForm"><!--begin login form-->
					<form id="form2" name="form2" method="post" action="site-wide/functions/php/ajax_login.php">
						<div id="apDiv10"><!--sect1-->
							<label for="email2"></label>
							<input type="text" name="email2" id="email" class="longbox" value="email address" onfocus="clearMe(this);" onblur="unClearMe(this);"/>
                        </div><!--cloase sect1-->
						<div id="apDiv11"><!--sect2-->
							<label for="password3"></label>
							<input type="password" name="passwrd3" id="passwrd3" class="longbox" onfocus="clearMe(this);" onblur="unClearMe(this);" value="password"/>
                        </div><!--cloase sect2-->
		   <!--submit--><div id="apDiv12" class="submit"><input type="submit" name="submit2" value="Submit"/></div>
					</form><!--end form-->
				</div><!--close loging form-->
			</div>
			<!--////end login section\\\\-->

		<!--////////////////////////////SHARING SECTINO NEEDS WORK\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
		<div id="sharing">
			<div id="apDiv18" class="title">Share to unlock more prizes!</div>
		</div>
		<!--//////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

	</div>
	<!--/////end fade\\\\\-->
	<!--Navigation header-->
	<nav>
		<div id="cont"><!---nav wrap--->
        	<a href="index.html"><div id="logo"></div></a>
            <ul>
            	<li><a href="overlay1.html">Guided Tour</a></li>
                <li class="drop">
                	<a href="#">About</a>
                    <div class="dropdownContain">
                    	<div class="dropOut">
                        	<div class="triangle"></div>
                            <ul>
                            	<li>About us</li>
                                <li>Terms of Use</li>
                                <li>Privacy Policy</li>
                            </ul>
                        </div>
                    </div>
                    <span>
                    	<li style="color:#FFF;"><a href="javascript:LogDispOn()">Login</a></li><!--login buton-->
               		<li><a href="javascript:RegDispOn()">Signup</a></li><!--register button-->
                		<div id="welcomeDiv"><a href="userHome.php"><?php echo $welcomeMessage ?></a></div>
                    </span>
                 </li>
             </ul>
             <div id="tour"></div><!---Guided Tour arrow--->
		</div><!---end nav wrap--->
	</nav><!---end navigation--->
    
        <!--wrapper-->
    <div id="wrapper">
	
      <!--sharing div-->

      <!--end sharing div-->
      <section>                  
      <!--slideshow-->
	<div style="overflow:hidden; width:960px; margin: 0px auto; padding:0; z-index:1;">
     
        <!--diapo slideshow-->
        <div class="pix_diapo" style="z-index:1;">
        	<!--set one -->
            <div data-time="8000">
            	<img src="site-wide/images/content/megamind1048.jpg">
                <div class="caption elemHover fadeIn"><!--content 1-->			
                	<p class="title2">$10 iTunes Gift Card</p></ br>
					<p class="descrip">Short prize descrription goes here. Short prize descrription goes here. Short prize descrription goes here. Short prize descrription goes here. </p>
					<hr noshade size="2" width="298" />
					<p class="status">This prize is locked, keep sharing the raffle to ensure the prizes you want are unlocked!</p>
                    <span class="elemHover fadeIn" style="margin-top:40px;"><a class="button large green" href="javascript:joinraffle();">Enter to Win</a></span>
            	</div><!--end content 1 -->
	 		
            	<div id="social">
					<a href="#"><div id="twitter"></div></a>
					<a href="#"><div if="facebook"></div></a>
				</div>
            </div>
			<!--end set one-->
            
            <!--set two-->
			<div data-time="8000">
            	<img src="site-wide/images/content/megamind_07.jpg">
                <div class="caption elemHover fadeIn">
					<p class="title2">$15 Fandango Gift Card</p>
					<p class="descrip">Short prize descrription goes here. Short prize descrription goes here. Short prize descrription goes here. Short prize descrription goes here.</p>
					<hr noshade size="2" width="298">
					<p class="status">This prize is locked, keep sharing the raffle to ensure the prizes you want are unlocked!</p>
                    <span class="elemHover fadeIn" style="margin-top:40px;"><a class="button large green" href="javascript:joinraffle();">Enter to Win</a></span>
                </div>
			</div>
			<!--end set two-->
            
            <!--set three-->	
            <div data-time="8000">
            	<img src="site-wide/images/content/wall-e.jpg">
                <div class="caption elemHover fadeIn">
					<p class="title2">8 GB iPod Touch</p>
					<p class="descrip">Short prize descrription goes here. Short prize descrription goes here. Short prize descrription goes here. Short prize descrription goes here.</p>
					<hr noshade size="2" width="298">
					<p class="status">This prize is locked, keep sharing the raffle to ensure the prizes you want are unlocked!</p>
                    <span class="elemHover fadeIn" style="margin-top:40px;"><a class="button large green" href="javascript:joinraffle();">Enter to Win</a></span>
                </div>
          	</div>
            <!--end set three-->
		</div><!-- end diapo -->
      
	</div>
	<!--end slideshow-->
     </section>       
		<!--/countdown clock\-->
		<div id="clock_n_join">
			<div id="countbox1"></div>
			<div id="days">Days</div>
            <div id="hours">Hours</div>
	  	  <div id="minutes">Minutes</div>
			<div id="secs">Seconds</div>
   		  <div id="apDiv1"></div>
             
      </div>
		<!--/end countdown clock\-->
        
		<!--//Loading bar \\-->
	  <div id="progressBar"><img src="site-wide/images/progressBar.png" width="" height="52" id="progress"/></div>
		<!--//end loading bar\\-->
   	  </div>
      <!--end wrapper-->
	<!--end Navigation header-->

	</body>
</html>
