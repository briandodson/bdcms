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
	require ('../includes/config.php');
	
	// Login //
	$actual_username = CMS_USER;
	$actual_password = CMS_PASS;
	if($_POST['action']) {	
		if (($_POST['username'] == $actual_username) && ($_POST['password'] == $actual_password)) {
			session_register('username');
			$_SESSION['username'] = $actual_username;
			//$host = $_SERVER['HTTP_HOST'];
			//$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			//$extra = 'index.php';
			//header("Location: http://$host$uri/$extra");
			//exit;
		} else {
			$message = '<div class="error"><strong>Error:</strong> Your login credentials are incorrect. Please double check and try again.</div>';
		}
	}
	
	if (isset($_SESSION['username'])) {
	
		$sql = "SELECT * FROM `pages` WHERE page_id='home'";
  	$page_home = $db->Execute($sql);
		require ('includes/app_top.php');
?>
<title><?php echo SITE_NAME; ?> Content Management System (<?php echo ROOT_INDEX; ?>)</title>
<?php include ('includes/head.php'); ?>
</head>

<?php include ('includes/inc_header.php'); ?>

          	<h1>Welcome to your <?php echo SITE_NAME; ?> Content Management System</h1>
            <p>Use the navigation links above to navigate to the area of the CMS that you wish to manage.</p>
            
						<?php include ('includes/inc_footer.php'); ?>
<?php require ('includes/app_bottom.php'); ?>

<?php } else { // No session, or it doesn't match 
require ('includes/app_top.php');
?>
<title><?php echo SITE_NAME; ?> Content Management System (<?php echo ROOT_INDEX; ?>)</title>
<?php include ('includes/head.php'); ?>
</head>

<body>
<div id="loginPage">
	<?php if ($message) { ?>
  <div class="messages">
  	<?php echo $message; ?>
  </div>
  <?php } ?>
	<form action="index.php" method="post" name="login" id="login">
  <input name="action" type="hidden" value="login" />
		<fieldset>
    	<dl>
      	<dt><label for="username">Username</label></dt>
      	<dd><input name="username" id="username" type="text" value="" class="mediumTextField" /></dd>
      	<dt><label for="password">Password</label></dt>
        <dd><input name="password" id="password" type="password" value="" class="mediumTextField" /></dd>
      </dl>
      <button type="submit" class="submit">Login</button>
    </fieldset>
	</form>
</div>
<?php require ('includes/app_bottom.php'); ?>
<?php } ?>