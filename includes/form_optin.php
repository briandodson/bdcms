<?php

// Contact Form Processing
// General defines
	$to=CONTACT_EMAIL; // Email goes here
	$messageSubject='Optin submission on '.SITE_NAME; // Email subject goes here
	$success_message='Thank you for opting in!'; // Message that displays after the message was successfully sent
	$error_email=WEBMASTER_EMAIL; // Errors will be sent to this email
	$incomplete_form='Please check your fields again and resubmit';
	$already_added='That email address is already in our database.'; // If email address is already in database
	$crack_message='We have detected a possible crack attempt. Your details have been logged and sent to the webmaster.'; // If a crack attempt is detected, display this message.
	$invalid_email='Oops... please check your email and make sure it is valid.';
	$spam_trap='<strong>HTTP/1.0 403 Forbidden</strong><br />You have triggered our anti-spam trap. Your details have been logged and sent to the webmaster.'; // Spam trap message
	$unknown_error='An unknown error has occurred. Please <a href="mailto:'.CONTACT_EMAIL.'">contact the site owner</a> to report this problem if it keeps occuring.'; // Unknown error message - catch all
	
	//mail($to,$messageSubject,$messageSubject,'From: '.$to."\r\n");
	// You can include a second email that gets sent to another address as a Confirmation or copy email. Just set it to TRUE if you need to use it
	
	// Fields are not parsed yet, empty the values
  $name='';
	$email='';
  
	// Empty email relative variables
	$body='';
	
	// The form has been submitted
  if ($_POST['sent'] == "yes") {
	
		// Format the data
    $name=$_POST['name'];
		$email=$_POST['email'];
		
// Create the main email body
$body="This submission has also been added to the Optin database.

Name: ".stripslashes($name)."
Email: ".stripslashes($email).
"

*****"."\n".
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
		if ((! preg_match('/^[-A-z0-9.,\'\s]*$/i',$name)) || (! preg_match('/^[-A-z0-9.,\'\s]*$/i',$message))) {
			$spam_detect = true;
		}
			
			if ($name && ($name != '') && $email && ($email != '') && $body && $valid_email && !$crack && !$spam_detect){
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
				
				$check_cust_email_query = "select count(*) as total from optins where optin_email = '" . $email . "'";
				$check_cust_email = $db->Execute($check_cust_email_query);	
			  if ($check_cust_email->fields['total'] > 0) { //Found a matching email already in database
					$message = '<div class="error"><strong>Error: </strong> '.$already_added.'</div>';
					$display_form = true;
				} else {
					// Add to Optin database
					$sql = "INSERT INTO optins (optin_name, optin_email) VALUES ('".$_REQUEST['name']."', '".$_REQUEST['email']."')";
					$db->Execute($sql);
					
					// The Email was sent, display the success message
					$message = '<div class="success">'.$success_message.'</div>';
					$display_form = false;
				}
    	} elseif ($valid==false) { 
		
				// Errors occurred
				
				if ($crack) {
					// Crack attempt
					$details = 'A possible Crack attempt has been detected at '.$_SERVER['REQUEST_URI']."\n".'REMOTE IP:' . $_SERVER['REMOTE_ADDR'] ."\n"."REQUEST DATE: " .date("l dS of F Y h:i:s A") . " PST". "\n". "BROWSER:" . $_SERVER['HTTP_USER_AGENT'];
					$subject = 'Possible Crack attempt at '.$_SERVER['REQUEST_URI'];
					mail($error_email,$subject,$details,'From: '.$error_email."\r\n");
					$message = '<div class="error"><strong>Error 102</strong><br />'.$crack_message.'</div>';
					$display_form = false;
				} elseif ($spam_trap == true) {
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
?>

<?php 
	echo '<h1>'.stripslashes($page->fields['page_title']).'</h1>';
	echo '<p>'.stripslashes($page->fields['page_desc']).'</p>';
?>
<?php if ($message) { echo $message; } ?>
<?php if ($display_form == true) { ?>
<div class="optinForm">
	<form class="" id="optinForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?p=optin">
  	<fieldset>
    	<legend>Optin</legend>
      <div class="name">
      	<label for="name">Name *</label>
        <input type="text" id="name" name="name" class="{validate:{required:true, messages:{required:'Please enter your name'}}}" value="" accesskey="n" tabindex="1" />
      </div>
      <div class="email">
      	<label for="email">E-Mail *</label>
        <input type="text" id="email" name="email" class="{validate:{required:true, email:true, messages:{required:'Please enter your email address', email:'Please enter a valid email address'}}}" value="" accesskey="e" tabindex="3" />
      </div>
      <input type="hidden" name="sent" value="yes" />
      <input class="submit" type="submit" value="Submit" accesskey="s" tabindex="5" />
    </fieldset>
  </form>
</div>
<?php } ?>