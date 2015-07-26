<?php if (($_REQUEST['p']) || ($_REQUEST['p'] != '') || ($_REQUEST['p'] != 'home')) { ?>
<title><?php echo $page->fields['meta_title']; ?> | <?php echo SITE_NAME; ?></title>
<meta name="keywords" content="<?php echo $page->fields['meta_keywords']; ?>" />
<meta name="description" content="<?php echo $page->fields['meta_description']; ?>" />
<meta name="dc.title" content="<?php echo $page->fields['meta_title']; ?> | <?php echo SITE_NAME; ?>" />
<?php } ?>
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