</head>

<body>
  <div id="container">
    <div id="wrapper">
      <div id="header">
        <div id="topNav">
          <a href="<?php echo ROOT_INDEX; ?>" target="_blank">View Site</a>
          <a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout=true">Log Out</a>
        </div>
        <div id="topHeadRight">
          <form action="support-ticket.php" name="reportCMSBug" method="post">
          	<input type="hidden" name="type" value="cmsbug" />
            <a href="<?php echo ROOT_INDEX; ?>cms/" title="bri-design CMS administration" class="logo">bri-design CMS administration</a>
            <h1><a href="<?php echo ROOT_INDEX; ?>" target="_blank"><?php echo SITE_WWW; ?></a></h1>
            <h2>bri-design CMS administration v.<?php echo CMS_VERSION; ?> | <input type="submit" name="submit" value="Report CMS Bug" /></h2>
          </form>
        </div>
      </div>
      <div id="navigation">        
        <ul class="sf-menu" id="nav">
          <li class="pages"><a class="sf-with-ul" id="catJump">Site Pages</a>
          	<ul id="catJumpOpts">
            	<li>
              	<span id="catJumpOptsButton"><a id="catJumpOptsTop">Site Pages</a></span>
              	<a href="add-page.php" class="addpage">create a new page</a>
                <ul class="homePage">
                  <li><a href="edit-page.php?page_id=home">Home Page</a><a class="nodelete">delete</a><a href="edit-page.php?page_id=home" class="edit">edit</a></li>
                </ul>
                <ul class="primaryPages">
                  <?php
                    $sql = "SELECT * FROM `pages` WHERE page_type='primary' ORDER BY weight ASC";
                    $primary_links = $db->Execute($sql);
                    while (!$primary_links->EOF) {
                      echo '<li><a href="edit-page.php?page_id='.$primary_links->fields['page_id'].'">'.$primary_links->fields['page_title'].'</a><a href="delete-page.php?page_id='.$primary_links->fields['page_id'].'" class="delete">delete</a><a href="edit-page.php?page_id='.$primary_links->fields['page_id'].'" class="edit">edit</a></li>
											';
                    	$primary_links->MoveNext();
                    }
                  ?>
                </ul>
                <ul class="actionPages">
                  <?php
                    $sql = "SELECT * FROM `pages` WHERE page_type='action' ORDER BY weight ASC";
                    $action_links = $db->Execute($sql);
                    while (!$action_links->EOF) {
                      echo '<li><a href="edit-page.php?page_id='.$action_links->fields['page_id'].'">'.$action_links->fields['page_title'].'</a><a href="delete-page.php?page_id='.$action_links->fields['page_id'].'" class="delete">delete</a><a href="edit-page.php?page_id='.$action_links->fields['page_id'].'" class="edit">edit</a></li>
											';
                    	$action_links->MoveNext();
                    }
                    ?>
                </ul>
                <ul class="footerPages">
                  <?php
                    $sql = "SELECT * FROM `pages` WHERE page_type='footer' ORDER BY weight ASC";
                    $footer_links = $db->Execute($sql);
                    while (!$footer_links->EOF) {
                      echo '<li><a href="edit-page.php?page_id='.$footer_links->fields['page_id'].'">'.$footer_links->fields['page_title'].'</a><a href="delete-page.php?page_id='.$footer_links->fields['page_id'].'" class="delete">delete</a><a href="edit-page.php?page_id='.$footer_links->fields['page_id'].'" class="edit">edit</a></li>
											';
                      $footer_links->MoveNext();
                    }
                  ?>
                </ul>
                <ul class="systemPages">
                	<?php
										if ($system_page_contact == true) {
											$sql = "SELECT * FROM `pages` WHERE page_id='contact'";
											$system_links = $db->Execute($sql);
											while (!$system_links->EOF) {
												echo '<li><a href="edit-page.php?page_id='.$system_links->fields['page_id'].'">'.$system_links->fields['page_title'].'</a><a class="nodelete">delete</a><a href="edit-page.php?page_id='.$system_links->fields['page_id'].'" class="edit">edit</a></li>';
												$system_links->MoveNext();
											}
										}
									?>
                  <?php
										if ($system_page_sendtofriend == true) {	
											$sql = "SELECT * FROM `pages` WHERE page_id='send-to-friend'";
											$system_links = $db->Execute($sql);
											while (!$system_links->EOF) {
												echo '<li><a href="edit-page.php?page_id='.$system->links->fields['page_id'].'">'.$system_links->fields['page_title'].'</a><a class="nodelete">delete</a><a href="edit-page.php?page_id='.$system_links->fields['page_id'].'" class="edit">edit</a></li>';
												$system_links->MoveNext();
											}
										}
									?>
                  <?php
										if ($system_page_optin == true) {
											$sql = "SELECT * FROM `pages` WHERE page_id='optin'";
											$system_links = $db->Execute($sql);
											while (!$system_links->EOF) {
												echo '<li><a href="edit-page.php?page_id='.$system->links->fields['page_id'].'">'.$system_links->fields['page_title'].'</a><a class="nodelete">delete</a><a href="edit-page.php?page_id='.$system_links->fields['page_id'].'" class="edit">edit</a></li>';
												$system_links->MoveNext();
											}
										}
									?>
                </ul>
                <div class="clear"></div>
              </li>
            </ul><div class="clear"></div>
          </li>
          <?php if ($mod_backup_database == true) { ?><li class="toolLink"><a href="backup.php">Backup Database</a></li><?php } ?>
          <?php if ($mod_site_information == true) { ?><li class="toolLink"><a href="edit-site-info.php">Site Information</a></li><?php } ?>
          <?php if ($mod_optins == true) { ?><li class="toolLink"><a href="list-optins.php">Optins</a></li><?php } ?>
          <?php if ($mod_google == true) { ?><li class="toolLink"><a href="google.php">Google</a></li><?php } ?>
          <?php if ($mod_galleries == true) { ?><li class="toolLink"><a href="list-images.php">Galleries</a></li><?php } ?>
        </ul>
      </div>
      
      <div id="body">
        <div id="content">
          <div id="mainCol">