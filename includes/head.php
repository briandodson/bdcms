<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen, projection" />
<script type="text/javascript" language="javascript" src="js/jquery-1.2.6.min.js"></script>
<?php if (($_REQUEST['p'] == '') || (!$_REQUEST['p']) || ($_REQUEST['p'] == 'home')) { //Slider is only on homepage ?>
<script type="text/javascript" language="javascript" src="js/jquery-easySlider.js"></script>
<?php } ?>
<?php if (($_REQUEST['p'] == 'contact') || ($_REQUEST['p'] == 'optin') || ($_REQUEST['p'] == 'send-to-friend')) { //Slider is only on homepage ?>
<script type="text/javascript" language="javascript" src="js/jquery-validate.pack.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-metadata.js"></script>
<script type="text/javascript" language="javascript" src="js/util-validate.js"></script>
<?php } ?>
<?php if (($_REQUEST['p'] == 'advanced-meat-recovery-systems') || ($_REQUEST['p'] == 'soft-tissue-separators') || ($_REQUEST['p'] == 'automatic-bagging-systems')) {
// Tabs ?>
<script type="text/javascript" language="javascript" src="js/ui.core.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-tabs.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {

	$('#tabs ul').tabs();
	$('#stabs ul').tabs();
});
</script>
<?php } ?>
<?php if (($_REQUEST['p'] !== 'contact') || ($_REQUEST['p'] !== 'optin') || ($_REQUEST['p'] !== 'send-to-friend')) { ?>
<script type="text/javascript" language="javascript" src="js/util.js"></script>
<?php } ?>
<?php if (($testmode == '2') || ($testmode == '3')) { ?>
<script type='text/javascript' src='http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js'></script>
<style type="text/css">
.browserReporting {width:800px; margin:30px auto; padding:20px; background-color:#000; color:#FFF; font-size:12px !important; text-align:left; line-height:18px;}
.browserReporting dl {display:block; width:800px; font-size:1em; margin-top:15px;}
.browserReporting dt {display:block; float:left; width:200px; text-align:right; margin-right:20px; font-weight:bold; font-size:1em; color:#666;}
.browserReporting dd {display:block; float:left; font-weight:normal; font-size:1em; color:#fff; text-align:left !important;}
.browserReporting div.clear {clear:both; display:block; border-top:1px solid #666 !important; margin:10px 0;}
</style>
<?php } ?>