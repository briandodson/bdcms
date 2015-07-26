<?php

// Contact Form Processing
// General defines
	$to=CONTACT_EMAIL; // Email goes here
	$messageSubject='Contact inquiry from '.SITE_NAME; // Email subject goes here
	$success_message='Thank you for your inquiry. We will get back with you promptly.'; // Message that displays after the message was successfully sent
	$error_email=WEBMASTER_EMAIL; // Errors will be sent to this email
	$incomplete_form='Please check your fields again and resubmit';
	$crack_message='We have detected a possible crack attempt. Your details have been logged and sent to the webmaster.'; // If a crack attempt is detected, display this message.
	$invalid_email='Oops... please check your email and make sure it is valid. ';
	$spam_trap='<strong>HTTP/1.0 403 Forbidden</strong><br />You have triggered our anti-spam trap. Your details have been logged and sent to the webmaster.'; // Spam trap message
	$unknown_error='An unknown error has occurred. Please <a href="mailto:'.CONTACT_EMAIL.'">contact the site owner</a> to report this problem if it keeps occuring.'; // Unknown error message - catch all
	
	//mail($to,$messageSubject,$messageSubject,'From: '.$to."\r\n");
	// You can include a second email that gets sent to another address as a Confirmation or copy email. Just set it to TRUE if you need to use it
	$confirmation_copy = 0;
	
	if ($confirmation_copy == 1) {
		$confirmationSubject='Confirmation email subject';
  	$confirmationBody='Static content that you want in the confirmation email body';
	}
	
	// Fields are not parsed yet, empty the values
  $company_name='';
	$contact_person='';
	$position='';
	$email='';
	$phone='';
	$fax='';
	$address='';
	$city='';
	$state='';
	$zip='';
	$message='';
  
	// Empty email relative variables
	$body='';
	
	// The form has been submitted
  if ($_POST['sent'] == "yes") {
	
		// Format the data
    $company_name=$_POST['company_name'];
		$contact_person=$_POST['contact_person'];
		$position=$_POST['position'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$fax=$_POST['fax'];
		$address=$_POST['address'];
		$city=$_POST['city'];
		$state=$_POST['state'];
		$zip=$_POST['zip'];
		$message=$_POST['message'];
		
		// Create the email body
 		$body="
Company Name: ".stripslashes($company_name)."
Contact Person: ".stripslashes($contact_person)."
Position: ".stripslashes($position)."
Email Address: ".stripslashes($email)." 
Phone No: ".stripslashes($phone)."
Fax No: ".stripslashes($fax)."
Street Address: ".stripslashes($address)."
City: ".stripslashes($city)."
State: ".stripslashes($state)."
Zip: ".stripslashes($zip)."

Questions/Comments:
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
    //$valid_email=eregi('^([0-9a-z]+[-._+&])*[0-9a-z]+@([-0-9a-z]+[.])+[a-z]{2,6}$',$email);
    //$crack=eregi("(\r|\n)(to:|from:|cc:|bcc:)",$body);
		// Check for link injections and other strange characters, a.k.a., SPAM TRAP, and scare the offenders away forever!
		//if (! preg_match('/^[-A-z0-9.,\'\s]*$/i',$company_name)) {
		//	$spam_detect = true;
		//}
		
		$spam_detect = false;
			
			if ($message != ''){
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
?>

<?php if ($message) { echo $message; } ?>
<?php if ($display_form == true) { ?>
<div class="rightCol contactMod">
  <div class="contactForm">
    <p>Fill out the form to send us an email. A representative will respond to your inquiry as soon as possible.</p>
    <form class="" id="contactForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?p=contact">
      <fieldset>
        <legend>Contact Us</legend>
        <div class="company_name">
          <label for="company_name">Company Name</label>
          <input type="text" id="company_name" name="company_name" class="{validate:{required:true, messages:{required:'Please enter company name'}}}" value="" accesskey="c" tabindex="1" />
        </div>
        <div class="contact_person">
          <label for="contact_person">Contact Person</label>
          <input type="text" id="contact_person" name="contact_person" class="{validate:{required:true, messages:{required:'Please enter contact person'}}}" value="" accesskey="p" tabindex="2" />
        </div>
        <div class="position">
          <label for="phone">Position</label>
          <input type="text" id="position" name="position" class="" value="" accesskey="p" tabindex="3" />
        </div>
        <div class="email">
          <label for="email">Email address</label>
          <input type="text" id="email" name="email" class="{validate:{required:true, email:true, messages:{required:'Please enter your email address', email:'Please enter a valid email address'}}}" value="" accesskey="e" tabindex="4" />
        </div>
        <div class="phone">
          <label for="phone">Phone No.</label>
          <input type="text" id="phone" name="phone" class="{validate:{required:true, messages:{required:'Please enter your phone number'}}}" value="" accesskey="e" tabindex="5" />
        </div>
        <div class="fax">
          <label for="fax">Fax No.</label>
          <input type="text" id="fax" name="fax" class="" value="" accesskey="f" tabindex="6" />
        </div>
        <div class="address">
          <label for="address">Street Address</label>
          <input type="text" id="address" name="address" class="" value="" accesskey="a" tabindex="7" />
        </div>
        <div class="city">
          <label for="city">City</label>
          <input type="text" id="city" name="city" class="" value="" accesskey="c" tabindex="8" />
        </div>
        <div class="state">
          <label for="state">State</label>
          <input type="text" id="state" name="state" class="" value="" accesskey="s" tabindex="9" />
        </div>
        <div class="zip">
          <label for="zip">Zip</label>
          <input type="text" id="zip" name="zip" class="" value="" accesskey="z" tabindex="10" />
        </div>
        <div class="message">
          <label for="message">Questions/Comments</label>
          <textarea id="message" name="message" class="{validate:{required:true, messages:{required:'Please enter your message or inquiry'}}}" cols="" rows="" accesskey="m" tabindex="11"></textarea>
        </div>
        <input type="hidden" name="sent" value="yes" />
        <input class="submit" type="submit" value="Submit" accesskey="s" tabindex="12" />
      </fieldset>
    </form>
  </div>
</div>
<br class="clear" />
<?php } ?>