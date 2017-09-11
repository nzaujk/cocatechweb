<?php 
$nameError="";
$emailError="";
$commentError="";
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure message were entered	
		if(trim($_POST['message']) === '') {
			$commentError = 'You forgot to enter your message.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$message = stripslashes(trim($_POST['message']));
			} else {
				$message = trim($_POST['message']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			//Fill the following line with your email address
			$emailTo = 'info@cocatechkenya.com';
			
			$subject = 'Contact Form Submission from '.$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\nComments: $message";
			$headers = 'From: sitemail <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			$emailSent = true;

		}
	}
} ?>
<!DOCTYPE html>
<head>
<title>Cocatech Enterprises</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="Shortcut Icon" type="image/ico" href="favicon.ico" />

<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/ddsmoothmenu.css" rel="stylesheet" type="text/css" />

<!--[if lte IE 6]>
	<link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" />
<![endif]-->

<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie7.css" media="screen" />
<![endif]-->


<!-- JQUERY Library -->
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/fadeinout.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/Museo_Sans_500.font.js"></script>
<script type="text/javascript" src="js/fontconfig.js"></script>
<script type="text/javascript" src="js/menu/ddsmoothmenu.js">
/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
</script>
<script type="text/javascript" src="js/contact-form.js"></script>	
<script type="text/javascript" src="js/common.js"></script>

</head>

<body>

<div id="pagecontainer"> <!-- Outside Container -->
	<div id="mainpage"> 
	
		<div id="header"> 
			
			<div id="smoothmenu1" class="ddsmoothmenu"><!-- The Menu -->
				<ul>
					<!-- Menu Item Start-->
					<li class="current-menu-item"><a href="index.html">Home</a>
						<!-- Dropdown menu -->
						
						<!-- Dropdown end -->
					</li>
					<!-- Menu Item End -->
					<li><a href="about.html">About</a>
						<ul>
							<li><a href="about.html">Company</a>
							<ul>
								<li><a href="about.html">History</a></li>
								<li><a href="about.html">Profile</a></li>
							</ul>
							</li>
						</ul>
					</li>
					<li><a href="product.html">Products</a>
						<ul>
							<li><a href="product.html">Solar lamps</a>
                            <ul>
                            <li><a href="beacon.html">Beacons</a></li>
							<li><a href="fosera">Fosera</a></li>
                         </ul>
                    </li>
							
							<li><a href="solarwaterheater.html">Solar Water heaters</a>
                            
                        <ul>
							
							<li><a href="direct-indirect.html">Direct Systems</a></li>
							<li><a href="direct-indirect.html">Indirect Systems</a></li>
						</ul></ul>
					</li>
					
					<!-- Menu Single Item -->
					<li><a href="calculator.html">Power Consumption Calculator</a></li>
					<li><a href="contact.php">Contact us</a></li>
				</ul>
				<br style="clear: left" />
			</div>
			<!-- End of Menu -->
			
			<div id="logo"><a href="index.html"><img src="images/logo.png" alt="logo" /></a></div>
		</div> <!-- Close Header -->

		<div id="fullwidth-categorytitle">
		Contact us
		</div>
		

		<div id="subtitle">
		Please fill form and submit
		</div>
		
		
		<div id="contents">

		<?php if(isset($emailSent) && $emailSent == true) { ?>

			<div class="thanks">
				<h1>Thanks, <?=$name;?></h1>
				<p>Your email was successfully sent. I will be in touch soon.</p>
			</div>

		<?php } else { ?>

		
		<?php if(isset($hasError) || isset($captchaError)) { ?>
		<p class="error">There was an error submitting the form.<p>
		<?php } ?>
		


		<div class="addressbox">
			<div class="addresstitle"><!-- Company Address which will appear in sidebar -->
					Head Office
			</div>	
			<div class="fulladdress">
				<ul>
					<li>cocatech enterprises</li>
							<li>Climate Innovation Center,</li>
							<li>Strathmore University, Kenya</li>
							<li>Tel1: +354 720248916</li>
							<li>Tel2: +254 711851762</li>
							<
							<li>Email: <a href="#">info@cocatechkenya.com</a></li>
							<
							<li>Website: <a href="http://cocatechkenya.com/">cocatechkenya.com</a></li>
				</ul>
			</div>
		</div>


	
		<form action="contact.php" id="contactForm" method="post">
	
			<ol class="forms">
				<li><label for="contactName">Name</label></li>
				<li class="inputbar">
					<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
					<?php if($nameError != '') { ?>
						<span class="error"><?=$nameError;?></span> 
					<?php } ?>
				</li>
				
				<li><label for="email">Email</label></li>
				<li class="inputbar">
					<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />
					<?php if($emailError != '') { ?>
						<span class="error"><?=$emailError;?></span>
					<?php } ?>
				</li>
				
				<li class="textarea"><label for="commentsText">Message</label></li>
				<li class="inputbar">
					<textarea name="message" id="commentsText" rows="20" cols="30" class="requiredField"><?php if(isset($_POST['message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message']); } else { echo $_POST['message']; } } ?></textarea>
					<?php if($commentError != '') { ?>
						<span class="error"><?=$commentError;?></span> 
					<?php } ?>
				</li>
				<li class="screenReader"><label for="checking" class="screenReader">If you want to submit this form, do not enter anything in this field</label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>
				<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit">Send</button></li>
			</ol>
			
		</form>
		

		
	</div>

		<div class="clear"></div>
<?php } ?>

	</div> <!-- Close Mainpage -->
	<!-- Footer start -->
	<div id="footer">
		<div id="footerwrap">
			<div class="footerminibox">
				<div class="footertitle">Products</div>
				<div class="footerposts">
				<ul>
					<li><a href="#">Products</a></li>
					<li><a href="#">Services</a></li>

				</ul>
				</div>
			</div>
			<div class="footerminibox">
				<div class="footertitle">Company</div>
				<div class="footerposts">
				<ul>
					<li><a href="#">What we do</a></li>
					<li><a href="#">How we started</a></li>
					<li><a href="#">Company</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">Social links</a></li>

				</ul>
				</div>
			</div>
			<div class="footerminibox">
				<div class="footertitle">Social</div>
				<div class="footersocial">
				<ul>
					<li><a href="#"><img src="images/icons/facebook_16.png" alt="facebook" /> Facebook</a></li>

				</ul>
				</div>
			</div>
			<div class="footerbox footerspace">
				<div class="footertitle">About us</div>
				<div class="footertext">
					<div class="aboutimage">
						<a href="#"><img src="images/footer/about.jpg" alt="photo" /></a>
					</div>
				Cocatech Enterprises Ltd Is a company dealing in renewable energy solutions with <br>
specialization in solar energy installations and products including solar lamps, solar <br>
laptop chargers and solar plug and play home systems.</div>
			</div>
			<div class="footerbox footerspace">
				<div class="footertitle">Contact Information</div>
					<div class="footeraddress">
						<ul>
							<li>cocatech enterprises</li>
							<li>Climate Innovation Center,</li>
							<li>Strathmore University, Kenya</li>
							<li>Tel1: +354 720248916</li>
							<li>Tel2: +254 711851762</li>
							<li></li>
							<li>Email: <a href="#">info@cocatechkenya.coml</a></li>
							<li>Website: <a href="#">cocatechkenya.com</a></li>
						</ul>
					</div>
			</div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div id="footerbarwrap">
	<ul>
		<li>Copyright © Your Contact Name. All rights reserved.     +12 34 56 78 90</li>
		<li>Other important footer information is easy to add <a href="#">Including links</a></li>
	</ul>
	</div>
</div> <!-- Close Container -->
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>