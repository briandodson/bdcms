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
	$title = 'Manage Gallery Images';
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
	if ($_POST) {
		$sql = 'DELETE FROM images 
			WHERE image_id="'.$_REQUEST['image_id'].'"
		';
		$a = $db->Execute($sql);
		$message = '<div class="success">Image deleted.</div>';
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
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	$total_results = mysql_result(mysql_query("SELECT COUNT(image_id) as Num FROM images"),0); 
	$a = $db->Execute("SELECT * FROM images ORDER BY gallery_name, weight LIMIT $from, $max_results");	
	$total_pages = ceil($total_results / $max_results); 
	// Build Pagination
	for($i = 1; $i <= $total_pages; $i++) {
		if (($page) == $i) {
			$pagination .= '<span class="active">'.$i.'</span>';
		} else {
			$pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a>';
		}
	}
	$optins_list .= '<table class="listTable">';
	$optins_list .= '<tr>';
	$optins_list .= '<th>Gallery Image</th>';
	$optins_list .= '<th>Title</th>';
	$optins_list .= '<th>ID</th>';
	$optins_list .= '<th>Gallery</th>';
	$optins_list .= '<th>Active?</th>';
	$optins_list .= '<th colspan="2">Actions</th>';
	$optins_list .= '</tr>';
	while (!$a->EOF) {
  	if ($page == '1') {
			$delete .= '?act=delete&image_id='.$a->fields['image_id'];
		} else {
			$delete .= '?page='.$page.'&act=delete&image_id='.$a->fields['image_id'];
		}
		$optins_list .= '<tr>';
		$optins_list .= '<td>';
		$optins_list .= '<img src="/images/gallery/'.$a->fields['file_name'].'" alt="'.$a->fields['image_title'].'" class="listThumbImg" />';
		$optins_list .= '</td>';
		$optins_list .= '<td>'.$a->fields['image_title'].'</td>';
		$optins_list .= '<td>'.$a->fields['image_id'].'</td>';
		$optins_list .= '<td>'.$a->fields['gallery_name'].'</td>';
		$optins_list .= '<td>';
			if ($a->fields['active'] == '1') {
				$optins_list .= '<span class="yes">YES</span>';
			} else { 
				$optins_list .= '<span class="no">no</span>';
			}
		$optins_list .= '</td>';
		$optins_list .= '<td><a href="edit-image.php?image_id='.$a->fields['image_id'].'" class="edit">edit</a></td>';
		$optins_list .= '<td><a href="list-images.php'.$delete.'" class="delete">delete</a></td>';
		$optins_list .= '</tr>';
		if (($_REQUEST['act'] == 'delete') && ($_REQUEST['image_id'] == $a->fields['image_id'])) {
			$optins_list .= '<tr><td colspan="7"><div class="confirm"><form action="'.$_SERVER['PHP_SELF'].'" method="post"><input type="hidden" name="image_id" value="'.$a->fields['image_id'].'" />Are you sure you want to delete this image? <input type="submit" name="submit" value="YES" /><a href="list-images.php" class="confirmlinkNO">NO</a></form></div></td></tr>';
		}
    $a->MoveNext();
  }
	$optins_list .= '</table>';
	
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
