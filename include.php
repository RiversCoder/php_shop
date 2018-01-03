<?php
	session_start();
	define('ROOT',dirname(__FILE__));
	set_include_path('.'.PATH_SEPARATOR.ROOT.'/libs'.PATH_SEPARATOR.ROOT.'/core'.PATH_SEPARATOR.ROOT.'/configs'.PATH_SEPARATOR.get_include_path());

	ini_set('date.timezone','Asia/Shanghai');
	
	require_once 'configs.php';
	require_once 'mysql.func.php';
	require_once 'image.func.php';
	require_once 'common.func.php';
	require_once 'string.func.php';
	require_once 'page.func.php';
	require_once 'admin.inc.php';
	require_once 'pro.inc.php';
	require_once 'album.inc.php';
	require_once 'uploads.func.php';
	require_once 'user.inc.php';
	

