<?php

/*
 * Server level.
 */
$INFO = array();
$INFO['webroot'] = dirname(__FILE__);
ini_set('include_path', $INFO['webroot']);
$INFO['whichServer'] = 'dev';
$INFO['tmp'] = '/var/log/tmp/';
/*
 * Error handling in php.
 */
if(isset($_GET['debug']) ){
	error_reporting(E_ALL);
	ini_set('display_errors', true);
}
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/');
session_start();

date_default_timezone_set('America/Los_Angeles');

$INFO['db'] = array(
				'default'=>array('host'=>'XXXXXX','user'=>'XXXXXX','password'=>'XXXXXX','base'=>'XXXXXX')
			);

