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
	$title = 'Add page';
	/*
			SQL `pages` table
			page_id
			page_type
			page_title
			page_desc
			meta_title
			meta_keywords
			meta_description
			modified
			weight
	*/
	if ($_POST) {
		$sql = 'INSERT INTO pages ( 
			page_id, 
			page_type, 
			in_nav, 
			page_title, 
			page_desc, 
			meta_title, 
			meta_keywords, 
			meta_description, 
			modified, 
			weight, 
			active
		) VALUES (
			"'.$_REQUEST['page_id'].'", 
			"'.$_REQUEST['page_type'].'", 
			"'.$_REQUEST['in_nav'].'", 
			"'.$_REQUEST['page_title'].'", 
			"'.$_REQUEST['page_desc'].'", 
			"'.$_REQUEST['meta_title'].'", 
			"'.$_REQUEST['meta_keywords'].'", 
			"'.$_REQUEST['meta_description'].'", 
			"'.date("Y-m-d  H:i:s").'", 
			"'.$_REQUEST['weight'].'", 
			"'.$_REQUEST['active'].'"
		)';
		$a = $db->Execute($sql);
		$message = '<div class="success">Your page has been created.</div>';
		$success = true;
	} else {
		$message = '';
		$success = false;
	}
	require ('includes/app_top.php');
?>
<title><?php echo $title; ?> | <?php echo SITE_NAME; ?> Content Management System (<?php echo ROOT_INDEX; ?>)</title>
<?php include ('includes/head.php'); ?>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
// O2k7 skin (silver)
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "page_desc",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "silver",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
		valid_elements: "*[*]",
		extended_valid_elements: "*[*]",
		verify_html: false,
		media_strict: false,
		
		
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "bullist,numlist,outdent,indent,blockquote,cite,abbr,acronym,sub,sup,charmap,emotions,iespell,|,insertdate,inserttime|,link,unlink,anchor,image,media,|,styleprops,cleanup,help,code,|,fullscreen,preview",
		theme_advanced_buttons3 : "tablecontrols,|,forecolor,backcolor,|,hr,nonbreaking,pagebreak,|,search,replace",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "tinymce/examples/css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "tinymce/examples/lists/template_list.js",
		external_link_list_url : "tinymce/examples/lists/link_list.js",
		external_image_list_url : "tinymce/examples/lists/image_list.js",
		media_external_list_url : "tinymce/examples/lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

</script>
</head>

<?php include ('includes/inc_header.php'); ?>

          	<h1><?php echo $title; ?></h1>
            <?php if ($message) { ?>
            <div class="messages">
            	<?php echo $message; ?>
            </div>
            <?php } ?>
            <?php if ($success == true) { ?>
            <div class="actions">
            	<a href="add-page.php">Add another page</a>
            </div>
            <?php } else { ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            	<fieldset>
                <dl>
                	
                  <dt><label><b>*</b> Page ID</label></dt>
                  <dd><input type="text" class="largeTextField" name="page_id" value="" /><span class="tooltip" title="Must be alphanumeric with no special characters other than hyphens ( - ) or underscores ( _ ).<br /><br />Tip: This will be displayed in the page URL, so make it descriptive and relevant to page content.<br /><br />Example: http://www.site-name.com/<b>page-id-here</b>.html">?</span></dd>
                  
                  <dt><label><b>*</b> Page Title</label></dt>
                  <dd><input type="text" class="largeTextField" name="page_title" value="" /></dd>
                  
                  <dt><label><b>*</b> Page Type</label></dt>
                  <dd>
                    <select name="page_type" class="selectMenu">
                      <option value="primary">Primary Page (appears in main navigation)</option>
                      <option value="action">Action Page (appears in sub menu)</option>
                      <option value="footer">Footer Page (appears in footer links)</option>
                      <?php /* DISABLED <option value="index">Home Page</option> */ ?>
                    </select>
                  </dd>
                  <?php if ($dyn_nav == '1') { ?>
                  <div class="subOption">
                  	<dt><label>Include in navigation?</label></dt>
                    <dd>
                      <div class="radio">Yes <input type="radio" name="in_nav" value="1" checked="checked" /></div>
                      <div class="radio">No <input type="radio" name="in_nav" value="0" /></div>
                    </dd>
                  </div>
                  <?php } else { ?>
                  <input type="hidden" name="in_nav" value="1" />
                  <?php } ?>
                  </dd>
                  
                  <dt><label>Page Sort Order</label></dt>
                  <dd><input type="text" class="nanoTextField" name="weight" value="" /><span class="tooltip" title="Sort is weight based. A page with a sort order of '1' will display before a page with a sort order of '2'. You may also use decimals to indicate sort order (1.5, 2.36, etc.)">?</span></dd>
                  
                  <dt><label><b>*</b> Page Content</label></dt>
                  <dd><textarea name="page_desc" id="page_desc" rows="" cols="" class="largeTextArea"></textarea></dd>
                  
                </dl>
                <dl>
                  
                  <dt><label>Meta Title</label></dt>
                  <dd><input type="text" class="largeTextField" name="meta_title" value="" /><span class="tooltip" title="This is the text that displays at the top of your browser. This text is given very high relevance in search engines, so make it meaningful and relevant to the page."></span></dd>
                  
                  <dt><label>Meta Keywords</label></dt>
                  <dd><textarea name="meta_keywords" rows="" cols="" class="smallTextArea"></textarea><span class="tooltip" title="Separate keywords by a comma. Example 'keyword 1, keyword 2'. Search engines suggest no more than 8-10 keywords per page."></span></dd>
                  
                  <dt><label>Meta Description</label></dt>
                  <dd><textarea name="meta_description" rows="" cols="" class="mediumTextArea"></textarea><span class="tooltip" title="Search engines suggest no more than 160 characters"></span></dd>
                  
                </dl>
                <dl>
                
                	<?php if ($a->fields['page_type'] !== 'index') { ?>
                  <dt><label>Activate?</label></dt>
                  <dd>
                  	<div class="radio">Yes <input type="radio" name="active" value="1" checked="checked" /></div>
                    <div class="radio">No <input type="radio" name="active" value="0" /></div>
                  </dd>
                  <?php } ?>
                
                </dl>
                <div class="buttonRow">
                  <button type="submit" class="submit">create</button>
                  <button type="reset" class="cancel">cancel</button>
                </div>
              </fieldset>
            </form>
            <?php } ?>
            
						<?php include ('includes/inc_footer.php'); ?>
<?php require ('includes/app_bottom.php'); ?>