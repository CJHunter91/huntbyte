<?php
ob_start();
session_start();

if(file_exists($_SERVER['DOCUMENT_ROOT'].'/huntbyte/includes/db_config.php')) {
      include('db_config.php');
}else{
      define('DBHOST', getenv('DBHOST'));
      define('DBUSER', getenv('DBUSER'));
      define('DBPASS', getenv('DBPASS'));
      define('DBNAME', getenv('DBNAME'));
}
$db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//set timezone
date_default_timezone_set('Europe/London');

//load classes as needed
function __autoload($class) {

   $class = strtolower($class);

	//if call from within assets adjust the path
   $classpath = 'classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	}

	//if call from within admin adjust the path
   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	}
}

$user = new User($db);
include('functions.php');
?>
