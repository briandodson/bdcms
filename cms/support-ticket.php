<?php /*

||=====================================================================||
||=== Author: Brian Dodson, bri-design studios [www.bri-design.com] ===||
||=== Email: brian@bri-design.com                                   ===||
||=== Version: 0.1                                                  ===||
||=== Produced for: bri-design site framework | bri-design studios  ===||
||=====================================================================||

*/?>
<?php
	require ('includes/session_start.php');
	require ('includes/logout.php');
	require ('includes/check_session.php');
	require ('../includes/config.php');
	$title = 'Support Ticket';
	// Contact Form Processing
// General defines
	$to=WEBMASTER_EMAIL; // Email goes here
	$messageSubject='bdcms Support Ticket Submission from '.SITE_NAME; // Email subject goes here
	$success_message='Your ticket has been submitted. We will review and respond promptly.'; // Message that displays after the message was successfully sent
	$error_email=WEBMASTER_EMAIL; // Errors will be sent to this email
	$incomplete_form='Please check your fields again and resubmit';
	$crack_message='We have detected a possible crack attempt. Your details have been logged and sent to the webmaster.'; // If a crack attempt is detected, display this message.
	$invalid_email='Oops... please check your email and make sure it is valid. ';
	$spam_trap='<strong>HTTP/1.0 403 Forbidden</strong><br />You have triggered our anti-spam trap. Your details have been logged and sent to the webmaster.'; // Spam trap message
	$unknown_error='An unknown error has occurred. Please <a href="mailto:'.WEBMASTER_EMAIL.'">contact bri-design studios</a> to report this problem if it keeps occuring.'; // Unknown error message - catch all
	
	//mail($to,$messageSubject,$messageSubject,'From: '.$to."\r\n");
	// You can include a second email that gets sent to another address as a Confirmation or copy email. Just set it to TRUE if you need to use it
	$confirmation_copy = 0;
	
	if ($confirmation_copy == 1) {
		$confirmationSubject='Confirmation email subject';
  	$confirmationBody='Static content that you want in the confirmation email body';
	}
	
	// Fields are not parsed yet, empty the values
  $name='';
	$phone='';
	$email='';
	$message='';
	$priority='';
	$type='';
  
	// Empty email relative variables
	$body='';
	
	// The form has been submitted
  if ($_POST['sent'] == "yes") {
	
		// Format the data
    $name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$message=$_POST['message'];
		$priority=$_POST['priority'];
		$type=$_POST['type'];
		
		// Create the email body
 		$body="
Type: ".$type."
Priority: ".$priority." 

Name: ".stripslashes($name)."
Email: ".stripslashes($email)." 
Phone: ".stripslashes($phone)."

Message:
".stripslashes($message)."\r\n".
"\n\n".

"*****"."\n".
"REMOTE URI: " . $_SERVER['HTTP_REFERER']
."\n"
."REMOTE IP: " . $_SERVER['REMOTE_ADDR'] 
."\n"
."REQUEST DATE: " .date("l dS of F Y h:i:s A") . " PST"
. "\n"
. "BROWSER: " . $_SERVER['HTTP_USER_AGENT'];
    
		// Validate
    $valid_email=eregi('^([0-9a-z]+[-._+&])*[0-9a-z]+@([-0-9a-z]+[.])+[a-z]{2,6}$',$email);
    $crack=eregi("(\r|\n)(to:|from:|cc:|bcc:)",$body);
		// Check for link injections and other strange characters, a.k.a., SPAM TRAP, and scare the offenders away forever!
		if ((! preg_match('/^[-A-z0-9.,\'\s]*$/i',$name)) || (! preg_match('/^[-A-z0-9.,\'\s]*$/i',$phone)) || (! preg_match('/^[-A-z0-9.,\'\s]*$/i',$message))) {
			$spam_detect = true;
		} else {
			$spam_detect = false;
		}
			
			if ($name && ($name != '') && $email && ($email != '') && $phone && ($phone != '') && $body && ($message != '') && $valid_email && !$crack && !$spam_detect){
				$valid = true;
			} else {
				$valid = false;
				$message = '<div class="error">'.$incomplete_form.'</div>';
				$display_form = true;
			}
		
			// Make sure the required data is submitted and the email address is validated
			if ($valid==true){
      
				// Made it past validation and requirement checks, so send the email
				if (mail($to,$messageSubject,$body,'From: '.$email."\r\n")) {
					if ($confirmation_copy == 1) {
						// If the confirmation email is enabled, send it
						mail($email,$confirmationSubject,$confirmationBody.$body,'From: '.$to."\r\n");
					}
				}
		
				// The Email was sent, display the success message
				$message = '<div class="success">'.$success_message.'</div>';
				$display_form = false;
				
		
    	} elseif ($valid==false) { 
		
				// Errors occurred
				
				if ($crack) {
					// Crack attempt
					$details = 'A possible Crack attempt has been detected at '.$_SERVER['REQUEST_URI']."\n".'REMOTE IP:' . $_SERVER['REMOTE_ADDR'] ."\n"."REQUEST DATE: " .date("l dS of F Y h:i:s A") . " PST". "\n". "BROWSER:" . $_SERVER['HTTP_USER_AGENT'];
					$subject = 'Possible Crack attempt at '.$_SERVER['REQUEST_URI'];
					mail($error_email,$subject,$details,'From: '.$error_email."\r\n");
					$message = '<div class="error"><strong>Error 102</strong><br />'.$crack_message.'</div>';
					$display_form = false;
				} elseif ($spam_detect == true) {
					$message = '<div class="error">'.$spam_trap.'</div>';
					$display_form = false;
				} else { 
					
					if (!$valid_email) {
						
						// Email is not valid
						$message = '<div class="error">'.$invalid_email.'</div>';
						$display_form = true;
						
					
					} else {
					
						// Form not complete - required fields were not submitted
						$message = '<div class="error">'.$incomplete_message.'</div>';
						$display_form = true;
						
					}
				}
			
			} else {
				
				// Unknown error
				$details = 'A unknown error has occurred at '.$_SERVER['REQUEST_URI']."\n".'REMOTE IP:' . $_SERVER['REMOTE_ADDR'] ."\n"."REQUEST DATE: " .date("l dS of F Y h:i:s A") . " PST". "\n". "BROWSER:" . $_SERVER['HTTP_USER_AGENT'];
				$subject = 'Unknown error at '.$_SERVER['REQUEST_URI'];
				mail($error_email,$subject,$details,'From: '.$error_email."\r\n");
				$message = '<div class="error"><strong>Error 100</strong><br />'.$unknown_error.'</div>';
				$display_form = true;
			
			}
	} else {
		// Form has not been submitted yet. Do nothing.
		$display_form = true;
	}
	
	
	require ('includes/app_top.php');
?>
<title><?php echo $title; ?> | <?php echo SITE_NAME; ?> Content Management System (<?php echo ROOT_INDEX; ?>)</title>
<?php include ('includes/head.php'); ?>
</head>

<?php include ('includes/inc_header.php'); ?>
      
          	<h1><?php echo $title; ?></h1>
            <?php if ($message) { ?>
            <div class="messages">
            	<?php echo $message; ?>
            </div>
            <?php } ?>
            <?php if ($display_form == true) { ?>
            <form class="" id="contactForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <fieldset>
                <dl>
                	<dt><label for="priority">Priority</label></dt>
                  <dd>
                  	<select name="priority" id="priority" class="selectMenu">
                      <option value="low">Low</option>
                      <option value="medium">Medium</option>
                      <option value="high">High</option>
                    </select>
                  </dd>
                  <dt><label for="type">Submission Type</label></dt>
                  <dd>
                  	<select name="type" id="type" class="selectMenu">
                    	<option value="bug">Bug Report</option>
                      <option value="cmsbug"<?php if ($_REQUEST['type'] == 'cmsbug') { echo ' selected="selected"'; } ?>>CMS Bug Report</option>
                      <option value="maintenance">Site Maintenance</option>
                      <option value="feature">New Feature Request</option>
                      <option value="general">General question or comment</option>
                      <option value="other">Other</option>
                    </select>
                  </dd>
                </dl>
                
                <dl>
                	<dt><label for="name"><b>*</b>Name</label></dt>
                  <dd><input type="text" id="name" name="name" class="mediumTextField" value="" /></dd>
                	<dt><label for="phone"><b>*</b>Phone</label></dt>
                  <dd><input type="text" id="phone" name="phone" class="mediumTextField" value="" /></dd>
                	<dt><label for="email"><b>*</b>E-Mail</label></dt>
                  <dd><input type="text" id="email" name="email" class="largeTextField" value="" /></dd>
                  <dt><label for="message"><b>*</b>Details</label></dt>
                  <dd><textarea id="message" name="message" class="largeTextArea" cols="" rows=""></textarea></dd>
                </dl>
                
                <input type="hidden" name="sent" value="yes" />
                <div class="buttonRow">
                	<button type="submit" class="submit">submit</button>
                	<button type="reset" class="cancel">cancel</button>
                </div>
              </fieldset>
            </form>
            <?php } ?>
            
						<?php include ('includes/inc_footer.php'); ?>
<?php require ('includes/app_bottom.php'); ?>
