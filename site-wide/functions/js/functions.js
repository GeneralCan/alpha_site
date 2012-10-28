// JavaScript Document
var reg = 0;
var logn = 0;
var fade = 0;
var share = 0;

  function clearMe(formfield){
   if (formfield.defaultValue==formfield.value){
    formfield.value = "";
   }
  }

  function unClearMe(formfield){
   if (formfield.value==""){
	formfield.value = formfield.defaultValue;
   }
  }
  function RegDispOn() {
  if (fade == 0){
	  document.getElementById('fade').style.display = 'block';
	  document.getElementById('reg').style.display = 'block';
	  fade = 1;
	  reg = 1;
  }
  }
  function RegDispOff(){
  if (reg == 1){
	  document.getElementById('fade').style.display = 'none';
	  document.getElementById('reg').style.display = 'none';
	  fade = 0;
	  reg = 0;
  }
  }
  
    function LogDispOn() {
  if (fade == 0){
	  document.getElementById('fade').style.display = 'block';
	  document.getElementById('log').style.display = 'block';
	  fade = 1;
	  logn = 1;
  }
  }
  function LogDispOff(){
  if (logn == 1){
	  document.getElementById('fade').style.display = 'none';
	  document.getElementById('log').style.display = 'none';
	  fade = 0;
	  logn = 0;
  }
  }
  function ShareDispOn(){
	  document.getElementById('fade').style.display = 'block';
	  document.getElementById('sharing').style.display = 'block';
	  fade = 1;
	  share = 1;
  }
    function ShareDispOff(){
	  document.getElementById('fade').style.display = 'none';
	  document.getElementById('sharing').style.display = 'none';
	  fade = 0;
	  share = 0;
  }
	function blankfunction(){
		var useless="nothing";
	}
	
	function slideShow(speed) {
		//append a LI item to the UL list for displaying caption
		$('ul.slideshow').append('<li id="slideshow-caption" class="caption"><div class="slideshow-caption-container"><h3></h3><p></p></div></li>');

		//Set the opacity of all images to 0
		$('ul.slideshow li').css({opacity: 0.0});
	
		//Get the first image and display it (set it to full opacity)
		$('ul.slideshow li:first').css({opacity: 1.0}).addClass('show');
	
		//Get the caption of the first image from REL attribute and display it
		$('#slideshow-caption h3').html($('ul.slideshow li.show').find('img').attr('title'));
		$('#slideshow-caption p').html($('ul.slideshow li.show').find('img').attr('button'));
		
		//Display the caption
		$('#slideshow-caption').css({opacity: 0.9, bottom:0});
	
		//Call the gallery function to run the slideshow	
		var timer = setInterval('gallery()',speed);
	
		//pause the slideshow on mouse over
		$('ul.slideshow').hover(
			function () {
				clearInterval(timer);	
			}, 	
			function () {
				timer = setInterval('gallery()',speed);			
			}
		);
	
	}

	function gallery() {
		//if no IMGs have the show class, grab the first image
		var current = ($('ul.slideshow li.show')?  $('ul.slideshow li.show') : $('#ul.slideshow li:first'));
	
		//trying to avoid speed issue
		if(current.queue('fx').length == 0) {	
	
		//Get next image, if it reached the end of the slideshow, rotate it back to the first image
		var next = ((current.next().length) ? ((current.next().attr('id') == 'slideshow-caption')? $('ul.slideshow li:first') :current.next()) : $('ul.slideshow li:first'));
			
		//Get next image caption
		var title = next.find('img').attr('title');	
		var desc = next.find('img').attr('alt');	
	
		//Set the fade in effect for the next image, show class has higher z-index
		next.css({opacity: 0.0}).addClass('show').animate({opacity: 1.0}, 1000);
		
		//Hide the caption first, and then set and display the caption
		$('#slideshow-caption').slideToggle(300, function () { 
			$('#slideshow-caption h3').html(title); 
			$('#slideshow-caption p').html(desc); 
			$('#slideshow-caption').slideToggle(500); 
		});		
	
		//Hide the current image
		current.animate({opacity: 0.0}, 1000).removeClass('show');

		}

	}
 
$(document).ready( function (){
		usrsess();
		slideShow(7000);
		
	$('#img1').mouseover(function(){
		$(this).stop().animate({marginTop: "-20px" }, 200);
	});
	$('#img1').mouseleave(function(){
		$(this).stop().animate({marginTop: "+0px" }, 200);
	});
	
	$('#img2').mouseover(function(){
		$(this).stop().animate({marginTop: "-20px" }, 200);
	});
	$('#img2').mouseleave(function(){
		$(this).stop().animate({marginTop: "+0px" }, 200);
	});
	
	$('#img3').mouseover(function(){
		$(this).stop().animate({marginTop: "-20px" }, 200);
	});
	$('#img3').mouseleave(function(){
		$(this).stop().animate({marginTop: "+0px" }, 200);
	});
	
	            jQuery(function(){
               jQuery("#usrfname").validate({
                    expression: "if (document.form1.usrfname.value == 'first name') return false; else return true;",
                    message: "Please enter the Required field"
                });
				jQuery("#usrlname").validate({
                    expression: "if (document.form1.usrlname.value == 'last name') return false; else return true;",
                    message: "Please enter the Required field"
                });
                jQuery("#usrage").validate({
                    expression: "if (!isNaN(VAL) && VAL && VAL > 12) return true; else return false;",
                    message: "You must be 13 or older to sign up"
                });
                jQuery("#email").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Please enter a valid Email"
                });
                jQuery("#passwrd").validate({
                    expression: "if (VAL.length > 5 && VAL) return true; else return false;",
                    message: "Please enter a valid Password"
                });
                jQuery("#passwrd2").validate({
                    expression: "if ((VAL == jQuery('#passwrd').val()) && VAL) return true; else return false;",
                    message: "Passwords do not match"
                });
            });
	
});