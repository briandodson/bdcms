<?php /*

||=====================================================================||
||=== Author: Brian Dodson, bri-design studios [www.bri-design.com] ===||
||=== Email: brian@bri-design.com                                   ===||
||=== See /includes/config.php for licensing rights     						===||
||=====================================================================||

*/?>
<?php 
	require ('includes/config.php');
	if ($_REQUEST['p']) {
			$check_page_query = "SELECT count(*) as total from `pages` where page_id = '".$_REQUEST['p']."'";
			$check_page = $db->Execute($check_page_query);
			if ($check_page->fields['total'] > 0) {
				$sql = "SELECT * FROM `pages` WHERE page_id='".$_REQUEST['p']."'";
  			$page = $db->Execute($sql); 
				if ($page->fields['active'] == '1') {
					require ('includes/app_top.php');
?>
<?php include ('includes/meta.php'); ?>
<?php include ('includes/head.php'); ?>
</head>

<body id="pageSub" class="pg_<?php echo stripslashes($page->fields['page_id']); ?>">
  <div id="container">
    <div id="wrapper">
      <?php include ('includes/inc_header.php'); ?>
      <div id="body">
        <div id="content">
          <div id="mainCol">
            <div class="copy">
            	<?php echo '<h1>'.stripslashes($page->fields['page_title']).'</h1>'; ?>
							<?php if ($_REQUEST['p'] == 'contact') { ?>
              	<div class="leftCol">
                  <div id="contactInfo">
                    <h3><?php echo SITE_NAME; ?></h3>
                    <address>
                      <?php echo SITE_ADDRESS; if (SITE_ADDRESS2 != '') { echo '<br />'.SITE_ADDRESS2; } ?><br /><?php echo SITE_CITY; ?>, <?php echo SITE_STATE_ABB; ?> <?php echo SITE_ZIP; ?>
                    </address>
                    <p>
                      <span class="telephone">Tel. <?php echo SITE_PHONE; ?></span><br />
                      <?php if (SITE_PHONE_TOLLFREE != '') { ?><span class="tollfree"><?php echo SITE_PHONE_TOLLFREE; ?></span><br /><?php } ?>
                      <span class="fax">Fax. <?php echo SITE_FAX; ?></span>
                    </p>
                    <?php /*<p><a href="mailto:<?php echo SITE_EMAIL; ?>" class="email"><?php echo SITE_EMAIL; ?></a></p>*/ ?>
                  </div>
              <?php } ?>
              <?php //include('includes/inc_right-col.php'); ?>
              <?php echo stripslashes($page->fields['page_desc']); ?>
							<?php
								if ($_REQUEST['p'] == 'contact') {
									echo '</div>';
									include ('includes/form_contact.php');
								} elseif ($_REQUEST['p'] == 'send-to-friend') {
									include ('includes/form_send-to-friend.php');						
								} elseif ($_REQUEST['p'] == 'optin') {
									include ('includes/form_optin.php');
								} else { 
								}
              ?>
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
<?php
			} else {
				header('Location: error.php?error-page=403');
			}
		} else {
			header('Location: error.php?error-page=404');
		}
	} else {
		header('Location: error.php?error-page=403');
	} 
?>