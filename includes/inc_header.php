<div id="header">
    	<div id="logo"><a href="<?php echo ROOT_INDEX; ?>" title="<?php echo SITE_NAME; ?>"><?php echo SITE_NAME; ?></a></div>
      <div id="topNav">
      	<div class="phone"><?php echo SITE_PHONE; ?></div>
        <ul>
					<?php
            if ($dyn_nav == '1') {
              $sql = "SELECT * FROM `pages` WHERE page_type='index' AND in_nav='1'";
              $index_link = $db->Execute($sql);
              while(!$index_link->EOF) {
                echo '<li><a href="'.ROOT_INDEX.'">Home</a></li>';
                $index_link->MoveNext();
              }
              
              $sql = "SELECT * FROM `pages` WHERE page_type='action' AND active='1' AND in_nav='1' ORDER BY weight ASC";
              $action_links = $db->Execute($sql);
              while (!$action_links->EOF) {
                echo '<li><a href="'.$uristr_prefix,$action_links->fields['page_id'],$uristr_suffix.'">'.$action_links->fields['page_title'].'</a></li>';
                $action_links->MoveNext();
              }
							
							if ($system_page_contact == true) {
								$sql = "SELECT * FROM `pages` WHERE page_id='contact' AND in_nav='1'";
								$contact_link = $db->Execute($sql);
								while(!$contact_link->EOF) {
									echo '<li><a href="'.$uristr_prefix,$contact_link->fields['page_id'],$uristr_suffix.'">'.$contact_link->fields['page_title'].'</a></li>';
									$contact_link->MoveNext();
								}
							}
            } else { 
          ?>
          	<li class="one"><a href="<?php echo ROOT_INDEX; ?>">HOME</a></li>
            <li class="two"><a href="<?php echo $uristr_prefix; ?>about<?php echo $uristr_suffix; ?>" title="About <?php echo SITE_NAME; ?>">ABOUT</a></li>
            <li class="three"><a href="<?php echo $uristr_prefix; ?>contact<?php echo $uristr_suffix; ?>" title="Contact us for more information">CONTACT</a></li>
          <?php } ?>
          </ul>
      </div>
      <div id="navigation">
					<?php
						if ($dyn_nav == '1') {
							echo '<ul class="primaryNav">';
							$sql = "SELECT * FROM `pages` WHERE page_type='primary' AND active='1' AND in_nav='1' ORDER BY weight ASC";
							$nav_links = $db->Execute($sql);
							while (!$nav_links->EOF) {
								echo '<li><a href="'.$uristr_prefix,$nav_links->fields['page_id'],$uristr_suffix.'">'.$nav_links->fields['page_title'].'</a></li>';
								$nav_links->MoveNext();
							}
							echo '</ul>';
						} else { 
					?>
          <ul class="primaryNav">
          	<li class="one"><a href="<?php echo $uristr_prefix; ?>advanced-meat-recovery-systems<?php echo $uristr_suffix; ?>" title="Learn about our advanced meat recovery systems">ADVANCED MEAT RECOVERY SYSTEMS</a></li>
            <li class="two"><a href="<?php echo $uristr_prefix; ?>soft-tissue-separators<?php echo $uristr_suffix; ?>" title="Learn about our soft tissue speparator systems">SOFT TISSUE SEPARATORS</a></li>
            <li class="three"><a href="<?php echo $uristr_prefix; ?>automatic-bagging-systems<?php echo $uristr_suffix; ?>" title="Learn about our automatic bagging systems systems">AUTOMATIC BAGGING SYSTEMS</a></li>
          </ul>
          <ul class="secondaryNav">
          	<li class="one"><a href="<?php echo $uristr_prefix; ?>rebuilt-reconditioned-systems<?php echo $uristr_suffix; ?>" title="Learn about our rebuilt and reconditioned systems">REBUILT AND RECONDITIONED SYSTEMS</a></li>
            <li class="two"><a href="<?php echo $uristr_prefix; ?>automatic-conveyor-cleaning-systems<?php echo $uristr_suffix; ?>" title="Learn about our automatic conveyor cleaning systems">AUTOMATIC CONVEYOR CLEANING SYSTEMS</a></li>
            <li class="three"><a href="<?php echo $uristr_prefix; ?>bandsaw-blades<?php echo $uristr_suffix; ?>" title="Learn about our bandsaw blades">BANDSAW BLADES</a></li>
          </ul>
					<?php } ?>
      </div>
    </div>