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
	$title = 'Backup Database';
	
	
	
	if ($_POST) {

		$message = '<div class="success">Your backup has been created.</div>';
		$success = true;
	} else {
		$message = '';
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

          		<?php 
								if ($_REQUEST['get'] == 'backup') {
									include ('includes/backup_handler.php');
            		} else { 
							?>
              <?php if ($success == true) { ?>
              <?php } else { ?>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              	<input type="hidden" name="get" value="backup" />
                <fieldset class="pageDeleteConfirm">
                  <p>Click 'backup' to create a backup of your database. It is a good idea to do this first before you make any changes.</p>
                  
                  <div class="buttonRow">
                    <button type="submit" class="submit">backup</button>
                    <button type="reset" onclick="javascript:history.back()" class="cancel">cancel</button>
                  </div>
                </fieldset>
              </form>
              <?php } ?>
            <?php } ?>
            
            <?php
							$dir="../backup/"; // Directory where files are stored
							if ($dir_list = opendir($dir)) {
								while(($filename = readdir($dir_list)) !== false) {
									
									if (($filename == '.') || ($filename == '..')) {
										$link .= '';
            			} else {
										$link .= '<li><a href="'.$filename.'">'.$filename.'</a></li>';
									}
								}
								closedir($dir_list);
						?>
            <div class="hr"></div>
            <h2>Existing Backups</h2>
            <ul class="backupLinks">
            	<?php	echo $link; ?>
            </ul>
						<?php
              }
						?>
            
						<?php include ('includes/inc_footer.php'); ?>
<?php require ('includes/app_bottom.php'); ?>
