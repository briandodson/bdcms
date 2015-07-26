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
	$title = 'Edit image';
	/*
			SQL `images` table
			image_id
			image_title
			file_name
			gallery_name
			modified
			weight
			active
	*/
	define ("MAX_SIZE","10000");
	function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) {
			return "";
		}
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	if ($_POST) {
			
		if ((!$_REQUEST['image_title']) || (!$_REQUEST['gallery_name'])) {
			$message = '<div class="error">Please enter all required fields.</div>';
			$success = false;
		} else {
			
			// reads the name of the file the user submitted for uploading
			if ($_REQUEST['file_name_new']) {
				$image=$_FILES['file_name_new']['name'];
			} else {
				$image=$_REQUEST['file_name'];
			}
			if ($image) {
				// get the original name of the file from the clients machine
				$filename = stripslashes($image);
				//get the extension of the file in a lower case format
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				//if it is not a known extension, we will suppose it is an error and will not upload the file
				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
					//print error message
					$message = '<div class="error">Unknown file extension, please try again. Images must be JPG, JPEG, PNG or GIF</div>';
					$success = false;
				} else {
					//get the size of the image in bytes
					$size=filesize($_FILES['image']['tmp_name']);
					//compare the size with the max size we defined and print error if too big
					if ($size > MAX_SIZE*1024) {
						//print error
						$message = '<div class="error">File size is a bit too big, please try again. Files must be less than 10mb</div>';
						$success = false;
					}
					//we will keep the name of the file
					$image_name=$filename;
					// the new name will contain the full path where the file will be stored
					$newname="../images/gallery/".$image_name;
					//we verify if the image has been uploaded, and print error if not
					$copied = copy($_FILES['file_name']['tmp_name'], $newname);
					if (!$copied) {
						$message = '<div class="error">There was an unknown error. For some reason the file could not be copied to the server. Please try again. If you have continued problems, please contact the <a href="mailto:webmaster@bri-design.com">web master</a>';
						$success = false;
					}	
				}
				$sql = 'UPDATE images 
					SET  
						image_title="'.$_REQUEST['image_title'].'", 
						file_name="'.$image.'", 
						gallery_name="'.$_REQUEST['gallery_name'].'",
						modified="'.$_REQUEST['modified'].'", 
						weight="'.$_REQUEST['weight'].'", 
						active="'.$_REQUEST['active'].'"
					WHERE image_id="'.$_REQUEST['image_id'].'"
				';
				$a = $db->Execute($sql);
				$message = '<div class="success">Your image has been updated.</div>';
				$success = true;	
			} else {
				$message = '<div class="error">Oops! You forgot to upload an image. <a href="javascript:history.back()">Go back and try again.</a></div>';
				$success = false;
				$display_form = false;
			}
		}
	} else {
		$message = '';
		$sql = "SELECT * FROM `images` WHERE image_id='".$_REQUEST['image_id']."'";
		$a = $db->Execute($sql);
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

          	<h1><?php echo $title; ?><?php if ($success == false) { ?>: <?php echo htmlspecialchars($a->fields['image_title']); ?> <?php } ?></h1>
            <?php if ($message) { ?>
            <div class="messages">
            	<?php echo $message; ?>
            </div>
            <?php } ?>
            <?php if ($success == true) { ?>
            <div class="actions">
            	<a href="javascript:history.back()">Back to Edit Image</a>
            </div>
            <?php } else { ?>
            <?php if ($display_form !== false) { ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            	<fieldset>
                <dl>
                	
                  <dt><label><b>*</b> Image Title</label></dt>
                  <dd><input type="text" class="largeTextField" name="image_title" value="<?php echo $a->fields['image_title']; ?>" /><span class="tooltip" title="This will display below the large version of the image and will also be used as the value for the ALT tag of the image in the code.">?</span></dd>
                  
                  <dt><label><b>*</b> Upload Image File</label></dt>
                  <dd><input type="hidden" name="file_name" value="<?php echo $a->fields['file_name']; ?>" /><input type="file" class="fileUploadField" name="file_name_new" value="<?php echo $a->fields['file_name']; ?>" /> <a href="/images/gallery/<?php echo $a->fields['file_name']; ?>" target="_blank">view current image</a><span class="tooltip" title="Image must be optimized for the web at 72 dpi, in RGB color format. Can be JPG, JPEG, PNG, or GIF.">?</span></dd>
                  
                  <dt><label><b>*</b> Gallery</label></dt>
                  <dd>
                    <select name="gallery_name" class="selectMenu">
                    	<option value="">Select a Gallery</option>
                      <option value="child"<?php if ($a->fields['gallery_name'] == 'child') { echo ' selected="selected"'; } ?>>Children's Illustrations</option>
                      <option value="oil"<?php if ($a->fields['gallery_name'] == 'oil') { echo ' selected="selected"'; } ?>>Oil Paintings</option>
                      <option value="fashion"<?php if ($a->fields['gallery_name'] == 'fashion') { echo ' selected="selected"'; } ?>>Fashion</option>
                      <option value="sketch"<?php if ($a->fields['gallery_name'] == 'sketch') { echo ' selected="selected"'; } ?>>Sketches</option>
                    </select>
                  </dd>
                  
                  <dt><label>Image Sort Order</label></dt>
                  <dd><input type="text" class="nanoTextField" name="weight" value="<?php echo $a->fields['weight']; ?>" /><span class="tooltip" title="Sort is weight based. An image with a sort order of '1' will display in front of an image with a sort order of '2'. You may also use decimals to indicate sort order (1.5, 2.36, etc.)">?</span></dd>
                  
                </dl>
                
                <dl>
                  <dt><label>Activate?</label></dt>
                  <dd>
                  	<?php if ($a->fields['active']) { ?>
											<?php if ($a->fields['active'] == '1') { ?>
                        <div class="radio">Yes <input type="radio" name="active" value="1" checked="checked" /></div>
                        <div class="radio">No <input type="radio" name="active" value="0" /></div>
                      <?php } else { ?>
                        <div class="radio">Yes <input type="radio" name="active" value="1" /></div>
                        <div class="radio">No <input type="radio" name="active" value="0" checked="checked" /></div>
                      <?php } ?>
                    <?php } else { ?>
                    	<div class="radio">Yes <input type="radio" name="active" value="1" checked="checked" /></div>
                        <div class="radio">No <input type="radio" name="active" value="0" /></div>
                    <?php } ?>
                  </dd>                
                </dl>
                <input type="hidden" name="image_id" value="<?php echo $a->fields['image_id']; ?>" />
                <div class="buttonRow">
                  <button type="submit" class="submit">upload</button>
                  <button type="reset" class="cancel">cancel</button>
                </div>
              </fieldset>
            </form>
            <?php } ?>
            <?php } ?>
            
						<?php include ('includes/inc_footer.php'); ?>
<?php require ('includes/app_bottom.php'); ?>