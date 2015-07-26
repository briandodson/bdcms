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
	$title = 'Edit Site Information';
	/*
			SQL `site_info` table
			site_uri
			site_name
			site_www
			site_phone
			site_phone_tollfree
			site_fax
			site_email
			site_address
			site_address2
			site_city
			site_state
			site_state_abb
			site_zip
			site_country
	*/
	if ($_POST) {
		$sql = 'UPDATE site_info
			SET 
				site_uri="'.$_REQUEST['site_uri'].'",
				site_name="'.$_REQUEST['site_name'].'",
				site_www="'.$_REQUEST['site_www'].'",
				site_phone="'.$_REQUEST['site_phone'].'",
				site_phone_tollfree="'.$_REQUEST['site_phone_tollfree'].'",
				site_fax="'.$_REQUEST['site_fax'].'",
				site_email="'.$_REQUEST['site_email'].'",
				site_address="'.$_REQUEST['site_address'].'",
				site_address2="'.$_REQUEST['site_address2'].'",
				site_city="'.$_REQUEST['site_city'].'",
				site_state="'.$_REQUEST['site_state'].'",
				site_state_abb="'.$_REQUEST['site_state_abb'].'",
				site_zip="'.$_REQUEST['site_zip'].'",
				site_country="'.$_REQUEST['site_country'].'"
			WHERE site_id=1
		';
		$a = $db->Execute($sql);
		$message = '<div class="success">Your site information has been saved.</div>';
		$success = true;
	} else {
		$message = '';
		$sql = "SELECT * FROM `site_info` WHERE site_id='1'";
		$a = $db->Execute($sql);
		$success = false;
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
            	<a href="edit-site-info.php">Back to Edit Site Info</a>
            </div>
            <?php } else { ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            	<fieldset>
                <dl>
                	
                  <dt><label><b>*</b> Site URI</label></dt>
                  <dd><input type="text" class="largeTextField" name="site_uri" value="<?php echo htmlspecialchars($a->fields['site_uri']); ?>" readonly="readonly" /></dd>
                  
                  <dt><label><b>*</b> Site Domain Name</label></dt>
                  <dd><input type="text" class="largeTextField" name="site_www" value="<?php echo htmlspecialchars($a->fields['site_www']); ?>" readonly="readonly" /></dd>
                  
                 </dl>
                 <dl>
                  
                  <dt><label><b>*</b> Site Name</label></dt>
                  <dd><input type="text" class="largeTextField" name="site_name" value="<?php echo htmlspecialchars($a->fields['site_name']); ?>" /></dd>
                  
                  <dt><label>Site Phone</label></dt>
                  <dd><input type="text" class="medTextField" name="site_phone" value="<?php echo htmlspecialchars($a->fields['site_phone']); ?>" /></dd>
                  
                  <dt><label>Site Phone (toll free)</label></dt>
                  <dd><input type="text" class="medTextField" name="site_phone_tollfree" value="<?php echo htmlspecialchars($a->fields['site_phone_tollfree']); ?>" /></dd>
                  
                  <dt><label>Site Fax</label></dt>
                  <dd><input type="text" class="medTextField" name="site_fax" value="<?php echo htmlspecialchars($a->fields['site_fax']); ?>" /></dd>
                  
                  <dt><label><b>*</b> Site email</label></dt>
                  <dd><input type="text" class="largeTextField" name="site_email" value="<?php echo htmlspecialchars($a->fields['site_email']); ?>" /></dd>
                  
                  <dt><label>Address</label></dt>
                  <dd><input type="text" class="largeTextField" name="site_address" value="<?php echo htmlspecialchars($a->fields['site_address']); ?>" /></dd>
                  
                  <dt><label>Address2</label></dt>
                  <dd><input type="text" class="largeTextField" name="site_address2" value="<?php echo htmlspecialchars($a->fields['site_address2']); ?>" /></dd>
                  
                  <dt><label>City</label></dt>
                  <dd><input type="text" class="largeTextField" name="site_city" value="<?php echo htmlspecialchars($a->fields['site_city']); ?>" /></dd>
                  
                  <dt><label>State/Province</label></dt>
                  <dd><input type="text" class="medTextField" name="site_state" value="<?php echo htmlspecialchars($a->fields['site_state']); ?>" /></dd>
                  
                  <dt><label>State/Province Abbr.</label></dt>
                  <dd><input type="text" class="nanoTextField" name="site_state_abb" value="<?php echo htmlspecialchars($a->fields['site_state_abb']); ?>" /></dd>
                  
                  <dt><label>Zip/Postal Code</label></dt>
                  <dd><input type="text" class="smallTextField" name="site_zip" value="<?php echo htmlspecialchars($a->fields['site_zip']); ?>" /></dd>
                  
                  <dt><label>Country</label></dt>
                  <dd><input type="text" class="medTextField" name="site_country" value="<?php echo htmlspecialchars($a->fields['site_country']); ?>" /></dd>
                  
                </dl>
                <div class="buttonRow">
                	<button type="submit" class="submit">save</button>
                	<button type="reset" class="cancel">cancel</button>
                </div>
              </fieldset>
            </form>
            <?php } ?>
            
      			<?php include ('includes/inc_footer.php'); ?>
<?php require ('includes/app_bottom.php'); ?>
