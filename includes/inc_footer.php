<div id="footer">
	<?php
    if ($system_page_sendtofriend == true) {
			$sql = "SELECT * FROM `pages` WHERE page_id='send-to-friend' AND active='1' AND in_nav='1' ORDER BY weight ASC";
			$footer_links = $db->Execute($sql);
			while (!$footer_links->EOF) {
				echo '<div class="sendToFriendLink"><a href="'.$uristr_prefix,$footer_links->fields['page_id'],$uristr_suffix.'">'.$footer_links->fields['page_title'].'</a></div>';
				$footer_links->MoveNext();
			}
		}
  ?>
  <?php
    if ($system_page_optin == true) {
			$sql = "SELECT * FROM `pages` WHERE page_id='optin' AND active='1' AND in_nav='1' ORDER BY weight ASC";
			$footer_links = $db->Execute($sql);
			while (!$footer_links->EOF) {
				echo '<div class="optinLink"><a href="'.$uristr_prefix,$footer_links->fields['page_id'],$uristr_suffix.'">'.$footer_links->fields['page_title'].'</a></div>';
				$footer_links->MoveNext();
			}
		}
  ?>
  <div class="fCopy">
  	<p>Copyright &copy; <?php if (date("Y") == "2009"): echo "2009"; else: echo "2009 - ".date("Y"); endif ?>, <?php echo SITE_NAME; ?> &bull; All rights reserved &bull; 
    <a href="<?php echo ROOT_INDEX; ?>">Home</a> &bull; 
		<?php
			if ($dyn_nav == '1') {
				$sql = "SELECT * FROM `pages` WHERE page_type='footer' AND active='1' AND in_nav='1' ORDER BY weight ASC";
				$footer_links = $db->Execute($sql);
				while (!$footer_links->EOF) {
					echo '<li><a href="'.$uristr_prefix,$footer_links->fields['page_id'],$uristr_suffix.'">'.$footer_links->fields['page_title'].'</a></li>';
					$footer_links->MoveNext();
				}
			} else {
		?>
    <a href="<?php echo $uristr_prefix; ?>about<?php echo $uristr_suffix; ?>">About <?php echo SITE_NAME; ?></a> &bull; 
    <a href="<?php echo $uristr_prefix; ?>contact<?php echo $uristr_suffix; ?>">Contact Us</a> &bull; 
    <a href="sitemap<?php echo $sitemap_uristr_suffix; ?>">Sitemap</a><br />
    <a href="<?php echo $uristr_prefix; ?>advanced-meat-recovery-systems<?php echo $uristr_suffix; ?>">Advanced Meat Recovery Systems</a> &bull;  
    <a href="<?php echo $uristr_prefix; ?>soft-tissue-separators<?php echo $uristr_suffix; ?>">Soft Tissue Separators</a> &bull;  
    <a href="<?php echo $uristr_prefix; ?>automatic-bagging-systems<?php echo $uristr_suffix; ?>">Automatic Bagging Systems</a> &bull;  
    <a href="<?php echo $uristr_prefix; ?>rebuilt-reconditioned-systems<?php echo $uristr_suffix; ?>">Rebuilt and Reconditioned Systems</a> &bull;  
    <a href="<?php echo $uristr_prefix; ?>automatic-conveyor-cleaning-systems<?php echo $uristr_suffix; ?>">Automatic Conveyor Cleaning Systems</a> &bull;  
    <a href="<?php echo $uristr_prefix; ?>bandsaw-blades<?php echo $uristr_suffix; ?>">Bandsaw Blades</a></p>
    <?php } ?>
  </div>
  <div class="fContactInfo">
  	<p><?php echo SITE_NAME; ?> &bull; <?php echo SITE_ADDRESS; ?> &bull; <?php echo SITE_CITY . ', ' . SITE_STATE . ' ' . SITE_ZIP; ?> &bull; Tel: <?php echo SITE_PHONE; ?> &bull; Fax: <?php echo SITE_FAX; ?></p>
  </div>
  <div class="developmentInfo">
  	<p>Website Design and Development by <a href="http://www.bri-design.com" target="_blank" rel="author">bri-design studios</a></p>
  </div>
</div>