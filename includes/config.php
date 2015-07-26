<?php /* Application Configuration File

||=====================================================================||
||=== Author: Brian Dodson, bri-design studios [www.bri-design.com] ===||
||=== Email: brian@bri-design.com                                   ===||
||=== Version: 0.1                                                  ===||
||=== Licensed for: COMPANY/CLIENT NAME HERE [www.domain.com]     	===||
||=====================================================================||

*/

// Framework configuration settings - can be customized for individual sites
$dyn_nav = '1'; // Use dynamically generated navigation for primary, action, and footer nav. 1=yes, 0=no

$testmode = '0'; // 0 = testmode OFF | 1 = testmode ON | 2 = testmode/debug ON | 3 = testmode/debug/phpinfo
//For general development on non-live sites, use 1
//If site is live, use 0
//For extensive debugging and testing, use 2 or 3

// .htaccess ModRewrite
$use_htaccess_rewrite = '0'; // 0 = No rewrite, URLs will be in form of page.php?p=pageid | 1 = Rewrite on, URLs will be in the form of page.html

if ($testmode == '3') {
	ini_set('display_errors',1);
	error_reporting(E_ALL|E_STRICT);
} elseif ($testmode == '2') {
	ini_set('display_errors',1);
	error_reporting(E_ALL|E_STRICT);
} elseif ($testmode == '1') {
	ini_set('display_errors',1);
	error_reporting(E_ALL);
} else {
	error_reporting(0);
} 

if ($use_htaccess_rewrite == '1') {
	$uristr_prefix = '';
	$uristr_suffix = '.html';
	$sitemap_uristr_prefix = '';
	$sitemap_uristr_suffix = '.xml';
} else {
	$uristr_prefix = 'page.php?p=';
	$uristr_suffix = '';
	$sitemap_uristr_prefix = 'google-';
	$sitemap_uristr_suffix = '.php';
}

$browser_info = '<div class="browserReporting">
Browser Reporting:<br /><dl>'.
'<dt>DOCUMENT_ROOT:</dt><dd>'.$_SERVER['DOCUMENT_ROOT'].'</dd><div class="clear"></div>'.
'<dt>GATEWAY_INTERFACE:</dt><dd>'.$_SERVER['GATEWAY_INTERFACE'].'</dd><div class="clear"></div>'.
'<dt>HTTP_ACCEPT:</dt><dd>'.$_SERVER['HTTP_ACCEPT'].'</dd><div class="clear"></div>'.
'<dt>HTTP_ACCEPT_CHARSET:</dt><dd>'.$_SERVER['HTTP_ACCEPT_CHARSET'].'</dd><div class="clear"></div>'.
'<dt>HTTP_ACCEPT_ENCODING:</dt><dd>'.$_SERVER['HTTP_ACCEPT_ENCODING'].'</dd><div class="clear"></div>'.
'<dt>HTTP_ACCEPT_LANGUAGE:</dt><dd>'.$_SERVER['HTTP_ACCEPT_LANGUAGE'].'</dd><div class="clear"></div>'.
'<dt>HTTP_CONNECTION:</dt><dd>'.$_SERVER['HTTP_CONNECTION'].'</dd><div class="clear"></div>'.
'<dt>HTTP_HOST:</dt><dd>'.$_SERVER['HTTP_HOST'].'</dd><div class="clear"></div>'.
'<dt>HTTP_USER_AGENT:</dt><dd>'.$_SERVER['HTTP_USER_AGENT'].'</dd><div class="clear"></div>'.
'<dt>PHP_SELF:</dt><dd>'.$_SERVER['PHP_SELF'].'</dd><div class="clear"></div>'.
'<dt>QUERY_STRING:</dt><dd>'.$_SERVER['QUERY_STRING'].'</dd><div class="clear"></div>'.
'<dt>REMOTE_ADDR:</dt><dd>'.$_SERVER['REMOTE_ADDR'].'</dd><div class="clear"></div>'.
'<dt>REMOTE_PORT:</dt><dd>'.$_SERVER['REMOTE_PORT'].'</dd><div class="clear"></div>'.
'<dt>REQUEST_METHOD:</dt><dd>'.$_SERVER['REQUEST_METHOD'].'</dd><div class="clear"></div>'.
'<dt>REQUEST_URI:</dt><dd>'.$_SERVER['REQUEST_URI'].'</dd><div class="clear"></div>'.
'<dt>SCRIPT_FILENAME:</dt><dd>'.$_SERVER['SCRIPT_FILENAME'].'</dd><div class="clear"></div>'.
'<dt>SCRIPT_NAME:</dt><dd>'.$_SERVER['SCRIPT_NAME'].'</dd><div class="clear"></div>'.
'<dt>SERVER_ADMIN:</dt><dd>'.$_SERVER['SERVER_ADMIN'].'</dd><div class="clear"></div>'.
'<dt>SERVER_NAME:</dt><dd>'.$_SERVER['SERVER_NAME'].'</dd><div class="clear"></div>'.
'<dt>SERVER_PORT:</dt><dd>'.$_SERVER['SERVER_PORT'].'</dd><div class="clear"></div>'.
'<dt>SERVER_PROTOCOL:</dt><dd>'.$_SERVER['SERVER_PROTOCOL'].'</dd><div class="clear"></div>'.
'<dt>SERVER_SIGNATURE:</dt><dd>'.$_SERVER['SERVER_SIGNATURE'].'</dd><div class="clear"></div>'.
'<dt>SERVER_SOFTWARE:</dt><dd>'.$_SERVER['SERVER_SOFTWARE'].'</dd><div class="clear"></div>'.
'</dl></div>';

// CMS administration
define('CMS_VERSION','1.0');

// define our database connection
define('DB_TYPE', 'mysql');
define('DB_SERVER', 'localhost'); 
define('DB_DATABASE', 'bdizl34_bdcms');
define('DB_SERVER_USERNAME', 'bdizl34_user');
define('DB_SERVER_PASSWORD', 'cft67ygv');
define('USE_PCONNECT', 'false'); 
define('DIR_FS_SQL_CACHE', '/tmp');
define('STORE_SESSIONS', 'db');
define('ADODB_LOG_SQL','false');

// Load ADOdb classes
require ('adodb_lite/adodb-errorhandler.inc.php');
require ('adodb_lite/adodb.inc.php');
$ADODB_CACHE_DIR = DIR_FS_SQL_CACHE;
$db = ADONewConnection(DB_TYPE);
$db->debug = false;
if (USE_PCONNECT == 'false') {
$db->Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);
} else {
$db->PConnect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);
}
if (ADODB_LOG_SQL == 'true') {
$db->LogSQL();
}

// SITE DEFINES
$sql = "SELECT * FROM `site_info`";
$site_info = $db->Execute($sql);

// Company info defines
define('ROOT_INDEX',$site_info->fields['site_uri']);
define('WEBMASTER_EMAIL','webmaster@bri-design.com');
define('SITE_NAME',$site_info->fields['site_name']);
define('SITE_WWW',$site_info->fields['site_www']);
define('SITE_PHONE',$site_info->fields['site_phone']);
define('SITE_PHONE_TOLLFREE',$site_info->fields['site_phone_tollfree']);
define('SITE_FAX',$site_info->fields['site_fax']);
define('SITE_EMAIL',$site_info->fields['site_email']);
define('SITE_ADDRESS',$site_info->fields['site_address']);
define('SITE_ADDRESS2',$site_info->fields['site_address2']);
define('SITE_CITY',$site_info->fields['site_city']);
define('SITE_STATE',$site_info->fields['site_state']);
define('SITE_STATE_ABB',$site_info->fields['site_state_abb']);
define('SITE_ZIP',$site_info->fields['site_zip']);
define('SITE_COUNTRY',$site_info->fields['site_country']);

define('DEFAULT_KEYWORDS','keyword1, keyword2, keyword3');
define('DEFAULT_DESCRIPTION','default description goes here. it is found in config.php');

if (($testmode == '1') || ($testmode == '2') || ($testmode == '3')) {
	define('CONTACT_EMAIL',WEBMASTER_EMAIL);
} else {
	define('CONTACT_EMAIL',SITE_EMAIL);
}

// CMS USER AND PASS
define('CMS_USER','user');
define('CMS_PASS','pass');

// CMS Modules - true to activate
$mod_galleries = false;
$mod_google = true;
$mod_optins = false;
$mod_site_information = true;
$mod_backup_database = false;

// System Pages - true to activate
$system_page_contact = true;
$system_page_sendtofriend = true;
$system_page_optin = true;

// GOOGLE VERIFY AND ANALYTICS
$sql = "SELECT * FROM `google`";
$google = $db->Execute($sql);
if ($google->fields['active'] == '1') {
	if ($google->fields['verify_tag']) {
		define('GOOGLE_VERIFY_TAG',$google->fields['verify_tag']);
	} else {
		define('GOOGLE_VERIFY_TAG','');
	}
	if ($google->fields['analytics_code']) {
		define('GOOGLE_ANALYTICS_CODE',$google->fields['analytics_code']);
	} else {
		define('GOOGLE_ANALYTICS_CODE','');
	}
} else {
	define('GOOGLE_VERIFY_TAG','');
	define('GOOGLE_ANALYTICS_CODE','');
}
?>