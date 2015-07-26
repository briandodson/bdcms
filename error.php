<?php /*

||=====================================================================||
||=== Author: Brian Dodson, bri-design studios [www.bri-design.com] ===||
||=== Email: brian@bri-design.com                                   ===||
||=== See /includes/config.php for licensing rights     						===||
||=====================================================================||

*/?>
<?php 
	require ('includes/config.php');
	if ($_REQUEST['error-page'] == '400') {
		$error_code = '400';
		$error_type = 'Bad Syntax';
	} elseif ($_REQUEST['error-page'] == '401') {
		$error_code = '401';
		$error_type = 'Unauthorized';
	} elseif ($_REQUEST['error-page'] == '402') {
		$error_code = '402';
		$error_type = 'Not Used';
	} elseif ($_REQUEST['error-page'] == '403') {
		$error_code = '403';
		$error_type = 'Forbidden';
	} elseif ($_REQUEST['error-page'] == '404') {
		$error_code = '404';
		$error_type = 'Not Found';
	} elseif ($_REQUEST['error-page'] == '500') {
		$error_code = '500';
		$error_type = 'Internal Server Error';
	} elseif ($_REQUEST['error-page'] == '501') {
		$error_code = '501';
		$error_type = 'Not Implemented';
	} elseif ($_REQUEST['error-page'] == '502') {
		$error_code = '502';
		$error_type = 'Overloaded';
	} elseif ($_REQUEST['error-page'] == '503') {
		$error_code = '503';
		$error_type = 'Overloaded';
	} else {
		$error_code = 'Unknown System Error';
		$error_type = 'Unknown System Error';
	}
	require ('includes/app_top.php');
?>
<title>ERROR | <?php echo $error_code; ?> | <?php echo $error_type; ?></title>
<meta name="keywords" content="<?php echo DEFAULT_KEYWORDS; ?>" />
<meta name="description" content="<?php echo DEFAULT_DESCRIPTION; ?>" />
<meta name="dc.title" content="ERROR | <?php echo $error_code; ?> | <?php echo $error_type; ?>" />
<meta name="city" content="<?php echo SITE_CITY; ?>" />
<meta name="country" content="<?php if (SITE_COUNTRY == 'USA') { echo 'United States (USA)';} else { echo SITE_COUNTRY; } ?>" />
<meta name="state" content="<?php echo SITE_STATE; ?>" />
<meta name="zipcode" content="<?php echo SITE_ZIP; ?>" />
<meta name="revisit-after" content="15 days" />	
<meta name="robots" content="index,follow" />
<meta name="audience" content="all" />
<meta name="author" content="<?php echo SITE_NAME; ?> and bri-design studios" />
<meta name="copyright" content="Copyright <?php if (date("Y") == "2009"): echo "2009"; else: echo "2009 - ".date("Y"); endif ?>  <?php echo SITE_NAME; ?>" />
<?php echo GOOGLE_VERIFY_TAG; ?>
<?php include ('includes/head.php'); ?>
</head>

<body id="pageSub" class="pg_error">
  <div id="container">
    <div id="wrapper">
      <?php include ('includes/inc_header.php'); ?>
      <div id="body">
        <div id="content">
          <div id="mainCol">
            <div class="copy">
              <?php //include('includes/inc_right-col.php'); ?>
              <h1>Error <?php echo $error_code; ?></h1>
              <h2><?php echo $error_type; ?></h2>
              <p>The page you requested, <?php echo $_SERVER['REQUEST_URI']; ?>, has resulted in the above error.</p>
              <p><a href="<?php echo ROOT_INDEX; ?>">Back to <?php echo SITE_NAME; ?> home &raquo;</a><br />
              <a href="mailto:<?php echo WEBMASTER_EMAIL; ?>?subject=Error report from http://bfdcorp.com<?php echo $_SERVER['REQUEST_URI']; ?>">Report error &raquo;</a></p>
            </div>
            <div class="clear"></div>
          </div>
          <div class="clear"></div>
        </div>
      	<?php include ('includes/inc_bottom.php'); ?>
      </div>
      <?php include ('includes/inc_footer.php'); ?>
    </div>
  </div>
<?php require ('includes/app_bottom.php'); ?>