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
	$title = 'Manage Optins';
	/*
			SQL `optins` table
			id
			optin_name
			optin_email
			added
	*/
	if ($_POST) {
		$sql = 'DELETE FROM optins 
			WHERE id="'.$_REQUEST['id'].'"
		';
		$a = $db->Execute($sql);
		$message = '<div class="success">Optin deleted.</div>';
	}
	//$sql = 'SELECT * FROM `optins` ORDER BY optin_name ASC LIMIT 5';
	//$a = $db->Execute($sql);
	
	// Determine page
	if((!isset($_GET['page'])) && (!isset($_POST['page']))){ 
		$page = 1; 
	} else { 
		$page = $_REQUEST['page']; 
	}
	//SQL Query
	$max_results = 30; 
	$from = (($page * $max_results) - $max_results); 
	$total_results = mysql_result(mysql_query("SELECT COUNT(id) as Num FROM optins"),0); 
	$a = $db->Execute("SELECT * FROM  optins LIMIT $from, $max_results");	
	$total_pages = ceil($total_results / $max_results); 
	// Build Pagination
	for($i = 1; $i <= $total_pages; $i++) {
		if (($page) == $i) {
			$pagination .= '<span class="active">'.$i.'</span>';
		} else {
			$pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a>';
		}
	}
	
	while (!$a->EOF) {
  	if ($page == '1') {
			$delete .= '?act=delete&id='.$a->fields['id'];
		} else {
			$delete .= '?page='.$page.'&act=delete&id='.$a->fields['id'];
		}
		$optins_list .= '<dt>'.$a->fields['optin_name'].'</dt>
		<dd><a href="mailto:'.$a->fields['optin_email'].'">'.$a->fields['optin_email'].'</a><a href="list-optins.php'.$delete.'" class="delete">delete</a>';
		if (($_REQUEST['act'] == 'delete') && ($_REQUEST['id'] == $a->fields['id'])) {
			$optins_list .= '<div class="confirm"><form action="'.$_SERVER['PHP_SELF'].'" method="post"><input type="hidden" name="id" value="'.$a->fields['id'].'" />Are you sure? <input type="submit" name="submit" value="YES" /><a href="list-optins.php" class="confirmlinkNO">NO</a></form></div>';
		}
    $a->MoveNext();
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
            <dl class="optins">
            	<?php echo $optins_list; ?>
            </dl>
            <div class="pagination">
            	<?php echo $pagination; ?>
            </div>
            
						<?php include ('includes/inc_footer.php'); ?>
<?php require ('includes/app_bottom.php'); ?>
