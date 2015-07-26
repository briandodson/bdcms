<?php /*

||=====================================================================||
||=== Author: Brian Dodson, bri-design studios [www.bri-design.com] ===||
||=== Email: brian@bri-design.com                                   ===||
||=== See /includes/config.php for licensing rights     						===||
||=====================================================================||

*/?>
<?php 
	require ('includes/config.php');
	$sql = "SELECT * FROM `pages` WHERE page_id='home'";
  $page_home = $db->Execute($sql);
	require ('includes/app_top.php');
?>
<?php if (($_REQUEST['p'] == '') || (!$_REQUEST['p']) || ($_REQUEST['p'] == 'home')) { ?>
<title><?php echo $page_home->fields['page_title']; ?> | <?php echo SITE_NAME; ?></title>
<meta name="keywords" content="<?php echo $page_home->fields['meta_keywords']; ?>" />
<meta name="description" content="<?php echo $page_home->fields['meta_description']; ?>" />
<meta name="dc.title" content="<?php echo $page_home->fields['meta_title']; ?> | <?php echo SITE_NAME; ?>" />
<?php } ?>
<?php include ('includes/meta.php'); ?>
<?php include ('includes/head.php'); ?>
</head>

<body id="pageHome">
  <div id="container">
    <div id="wrapper">
      <?php include ('includes/inc_header.php'); ?>
      <div id="body">
        <div id="content">
          <div id="mainCol">
           	<?php
              echo '<h1>'.stripslashes($page_home->fields['page_title']).'</h1>';
              echo stripslashes($page_home->fields['page_desc']);		
            ?>
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
