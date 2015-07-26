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
	$title = 'Google Analytics and Verification';
	/*
			SQL `google` table
			verify_tag
			analytics_code
			active
	*/
	
	// Check to see if there is a record first
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM google"),0);
	if ($total_results > 0) {
		// There is a record existing, create UPDATE query and action
		if ($_POST) {
			$sql = 'UPDATE google  
				SET 
					verify_tag="'.$_REQUEST['verify_tag'].'", 
					analytics_code="'.$_REQUEST['analytics_code'].'", 
					active="'.$_REQUEST['active'].'"
			';
			$a = $db->Execute($sql);
			$message = '<div class="success">Google Verification and Analytics has been updated. Please <a href="https://www.google.com/accounts/Login?continue=http://www.google.com/&hl=en" target="_blank">log in</a> to your Google Webmaster account to update verification and Analytics.</div>';
			$success = true;
		} else {
			$message = '';
			$sql = "SELECT * FROM `google`";
			$a = $db->Execute($sql);
			$success = false;
		}
	} else {
		// There is no record existing, create INSERT INTO query and action
		if ($_POST) {
			$sql = 'INSERT INTO google  (
				verify_tag, 
				analytics_code, 
				active
			) VALUES (
				"'.$_REQUEST['verify_tag'].'", 
				"'.$_REQUEST['analytics_code'].'", 
				"'.$_REQUEST['active'].'"
			)';
			$a = $db->Execute($sql);
			$message = '<div class="success">Google Verification and Analytics has been activated. Please <a href="https://www.google.com/accounts/Login?continue=http://www.google.com/&hl=en" target="_blank">log in</a> to your Google Webmaster account to continue verification and set up Analytics.</div>';
			$success = true;
		} else {
			$message = '';
			$sql = "SELECT * FROM `google`";
			$a = $db->Execute($sql);
			$success = false;
		}
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
            <?php if ($success == true) { ?>
            <div class="actions">
            	<a href="google.php">Back to <?php echo $title; ?> setup</a>
            </div>
            <?php } else { ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            	<fieldset>
                <dl>
                	
                  <dt><label>Verification Tag</label><span class="note">Paste the verification meta tag that Google supplied here.</span></dt>
                  <dd><input type="text" class="giantTextField" name="verify_tag" value="<?php if ($a->fields['verify_tag'] !== '') { echo htmlspecialchars($a->fields['verify_tag']); } ?>" /></dd>
                  <?php if (!$a->fields['verify_tag']) { ?>
                  <div class="example">
                  	<div class="title">Example:</div>
                  	<div class="desc">
                    	<code>&lt;meta name="verify-v1" content="GXwcsNKjMsFXhYy3qcodmh4xA5zkrAbBv0VJbty62ro=" /&gt;</code>
                    </div>
                    <div class="clear"></div>
                  </div>
									<?php } ?>
                  
                  <dt><label>Analytics Code</label><span class="note">Paste the code snippet that Google Analytics supplied here.</span></dt>
                  <dd><textarea name="analytics_code" class="giantTextArea" cols="" rows=""><?php if ($a->fields['analytics_code'] !== '') { echo htmlspecialchars($a->fields['analytics_code']); } ?></textarea></dd>
                  <?php if (!$a->fields['analytics_code']) { ?>
                  <div class="example">
                  	<div class="title">Example:</div>
                  	<div class="desc">
                      <code>
                        &lt;script type="text/javascript"&gt;<br />
                        &nbsp;&nbsp;var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");<br />
                        &nbsp;&nbsp;document.write(unescape("%3Cscript src='" + gaJsHost +<br />
                        &nbsp;&nbsp;"google-analytics.com/ga.js' 								type='text/javascript'%3E%3C/script%3E"));<br />
                        &lt;/script&gt;<br />
                        &lt;script type="text/javascript"&gt;<br />
                        &nbsp;&nbsp;try {<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;var pageTracker = _gat._getTracker("UA-1234567-1");<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;pageTracker._trackPageview();<br />
                        &nbsp;&nbsp;} catch(err) {}<br />
                        &lt;/script&gt;	
                      </code>
                    </div>
                    <div class="clear"></div>
                  </div>
                  <?php } ?>
                  
									<dt><label>Activate Google?</label></dt>
                  <dd>
                  	<div class="radio">Yes <input type="radio" name="active" value="1"<?php if ($a->fields['active'] == '1') { echo ' checked="checked"'; } else { echo ''; } ?> /></div>
                    <div class="radio">No <input type="radio" name="active" value="0"<?php if ($a->fields['active'] == '0') { echo ' checked="checked"'; } else { echo ''; } ?> /></div>
                  </dd>
                
                </dl>
                <div class="buttonRow">
                  <button type="submit" class="submit">submit</button>
                  <button type="reset" class="cancel">cancel</button>
                </div>
              </fieldset>
            </form>
            <?php } ?>
            
						<?php include ('includes/inc_footer.php'); ?>
<?php require ('includes/app_bottom.php'); ?>
