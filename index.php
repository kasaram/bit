<?php
$m = memory_get_usage();
$t = microtime(true);
ini_set('display_errors', 1);
error_reporting(E_ALL);
/****************************************************************************/

mb_internal_encoding('UTF-8');

define('BIT', true);
define('ROOT', dirname(__FILE__));

if(isset($_COOKIE['PHPSESSID'])) {
  session_start();
}

require_once 'config/Config.php';
require_once 'components/Autoload.php';
spl_autoload_register(['Autoload', 'loadClass']);


$r = new Router();
$r->run();


/****************************************************************************/
//echo "<br/><br/>Изменен: ".date('d F Y H:i:s', getlastmod());
//$m = memory_get_usage()-$m;
//$t = microtime(true) - $t;
//echo '<br/>Память: '.$m.'<br/>Время: '.$t;
