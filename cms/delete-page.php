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
	$title = 'Delete page';
	/*
			SQL `pages` table
			page_id
			page_type
			in_nav
			page_title
			page_desc
			meta_title
			meta_keywords
			meta_description
			modified
			weight
			active
	*/
	if ($_POST) {
		$sql = 'DELETE FROM pages 
			WHERE page_id="'.$_REQUEST['page_id'].'"
		';
		$a = $db->Execute($sql);
		$message = '<div class="success">Your page has been deleted.</div>';
		$success = true;
	} else {
		$message = '';
		$sql = "SELECT * FROM `pages` WHERE page_id='".$_REQUEST['page_id']."'";
		$a = $db->Execute($sql);
		$success = false;
	}
	require ('includes/app_top.php');
?>
<title><?php echo $title; ?> | <?php echo SITE_NAME; ?> Content Management System (<?php echo ROOT_INDEX; ?>)</title>
<?php include ('includes/head.php'); ?>
</head>

<?php include ('includes/inc_header.php'); ?>

          	<h1><?php echo $title; ?><?php if ($success == false) { ?>: <?php echo htmlspecialchars($a->fields['page_title']); ?><?php } ?></h1>
            <?php if ($message) { ?>
            <div class="messages">
            	<?php echo $message; ?>
            </div>
            <?php } ?>
            <?php if ($success == true) { ?>
            
            <?php } else { ?>
            	<?php if ($a->fields['page_type'] == 'index') { ?>
              	<p>You cannot delete the home page.</p>
              <?php } elseif (($_REQUEST['page_id'] == 'contact') || ($_REQUEST['page_id'] == 'send-to-friend') || ($_REQUEST['page_id'] == 'optin')) { ?>
              	<p>You cannot delete this page. You can, however, <a href="edit-page.php?page_id=<?php echo $_REQUEST['page_id']; ?>">deactivate it</a> in the edit page section.</p>
              <?php } else { ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            	<fieldset class="pageDeleteConfirm">
                <p>Are you absolutely, 100%, positively, without a doubt sure that you want to delete this page?</p>
                <input type="hidden" name="page_id" value="<?php echo $a->fields['page_id']; ?>" />
                <div class="buttonRow">
                	<button type="submit" class="submit">delete</button>
                	<button type="reset" onclick="javascript:history.back()" class="cancel">cancel</button>
                </div>
              </fieldset>
            </form>
            <?php }
						} ?>
            
						<?php include ('includes/inc_footer.php'); ?>
<?php require ('includes/app_bottom.php'); ?>
