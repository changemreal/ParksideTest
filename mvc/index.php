<?php
require_once("mvc_config.php");
require_once "framework/Controller.php";
require_once "framework/Model.php";

// Save the url of the index page.
$INFO['indexurl'] = $_SERVER['SCRIPT_NAME'];

// Initializing modules from user input
if (array_key_exists("contr", $_GET)) {
	$contr = $_GET["contr"];
} else if (array_key_exists("contr", $_POST)) {
	$contr = $_POST["contr"];
}

// Load home page as default if no module is specified!
if (!isset($contr) || $contr == '') {
	$_GET["contr"] = $contr = "home";
}

$pkg = empty($_GET['pkg'])? '':$_GET['pkg'].'/';
if (!file_exists("controllers/" . $pkg. $contr."_controller.php")) {
	header("Location: error.php");
	die();
}else{
	require_once("controllers/". $pkg . $contr."_controller.php");
}
// Strip slashes if magic quotes is turned on
if (get_magic_quotes_gpc()) {
	$input = array(&$_GET, &$_POST, &$_COOKIE, &$_ENV, &$_SERVER);
	while(list($k, $v) = each($input)) {
		foreach($v AS $key => $val) {
			if(!is_array($val)) {
				$input[$k][$key] = stripslashes($val);
				continue;
			}
			$input[] =& $input[$k][$key];
		}
	}
	unset($input);
}

try {

	// This code is setting the cookie, it must be
	// executed before any output.
	$contrClass = $contr;
	$contr_instance = new $contrClass();
	$contr_instance->dispatch();

} catch (Exception $error) {
	//trigger_error($error->getMessage());
	$INFO['log']->logError($error);
   	echo $error->getMessage();
}
