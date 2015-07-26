<?php /*

||=====================================================================||
||=== Author: Brian Dodson, bri-design studios [www.bri-design.com] ===||
||=== Email: brian@bri-design.com                                   ===||
||=== See /includes/config.php for licensing rights     						===||
||=====================================================================||

*/?>
<?php 
	require ('includes/config.php');
	require ('includes/app_top.php');
?>
<title>Sitemap | <?php echo SITE_NAME; ?></title>
<meta name="keywords" content="<?php echo DEFAULT_KEYWORDS; ?>" />
<meta name="description" content="<?php echo DEFAULT_DESCRIPTION; ?>" />
<meta name="dc.title" content="Sitemap | <?php echo SITE_NAME; ?>" />
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

<body id="pageSub" class="pg_sitemap">
  <div id="container">
    <div id="wrapper">
      <?php include ('includes/inc_header.php'); ?>
      <div id="body">
        <div id="content">
          <div id="mainCol">
            <div class="copy">
              <?php //include('includes/inc_right-col.php'); ?>
              <h1>Sitemap</h1>
              <ul class="sitemap">
              	<li><a href="<?php echo ROOT_INDEX; ?>">Home</a></li>
              	<?php
									$sql = "SELECT * FROM `pages` WHERE in_nav='1' AND active='1' ORDER BY weight ASC";
									$sitemap = $db->Execute($sql);
									while(!$sitemap->EOF) {
										echo '<li><a href="page.php?p='.$sitemap->fields['page_id'].'">'.$sitemap->fields['page_title'].'</a></li>';
										$sitemap->MoveNext();
									}		
              	?>
              </ul>
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