<?php

// Google Sitemap builder
// =======================

require('includes/config.php');
require_once('includes/classes/google_sitemap.class.php');

// Grab home page
$url[] = array(
	"loc" =>  ROOT_INDEX,
	"changefreq" => "weekly",
	"priority" => "1.0",
);

// Grab main pages, defined as page_type=primary
$primary_links = $db->Execute("SELECT * from `pages` WHERE page_type='primary' AND active='1' AND in_nav='1' ORDER BY weight ASC");
while (!$primary_links->EOF) {
	$url[] = array(
		"loc" =>  ROOT_INDEX . 'page.php?p='.$primary_links->fields['page_id'],
		"changefreq" => "weekly",
		"priority" => "0.8",
	);
$primary_links->MoveNext();
}

// Grab action pages, defined as page_type=action
$action_links = $db->Execute("SELECT * from `pages` WHERE page_type='action' AND active='1' AND in_nav='1' ORDER BY weight ASC");
while (!$action_links->EOF) {
	$url[] = array(
		"loc" =>  ROOT_INDEX . 'page.php?p='.$action_links->fields['page_id'],
		"changefreq" => "monthly",
		"priority" => "0.5",
	);
$action_links->MoveNext();
}

// Grab footer pages, defined as page_type=footer
$footer_links = $db->Execute("SELECT * from `pages` WHERE page_type='footer' AND active='1' AND in_nav='1' ORDER BY weight ASC");
while (!$footer_links->EOF) {
	$url[] = array(
		"loc" =>  ROOT_INDEX . 'page.php?p='.$footer_links->fields['page_id'],
		"changefreq" => "monthly",
		"priority" => "0.5",
	);
$footer_links->MoveNext();
}
   
$site_map_container =& new google_sitemap();
for ( $i=0; $i < count( $url ); $i++ ) {
	$value = $url[ $i ];
	$site_map_item =& new google_sitemap_item($value['loc'], "", $value['changefreq'], $value['priority']);
	$site_map_container->add_item($site_map_item);
}

print $site_map_container->build(); 

?>