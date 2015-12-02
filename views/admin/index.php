<?php
defined('BIT') or die;
//проверяем авторизирован ли админ
if(isset($_SESSION['adm_log'])) {
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>
<div id="content" class="centerBlock">
	<h2>Добро пожаловать!</h2>
	<h3>В административном разделе сайта вы можете изменять различные настройки.</h3>
	<img align="center" src="<?=Config::ADDRESS.Config::TEMPLATE?>images/service.png" alt="service">
</div>
<?php 
} elseif (isset($_GET[Config::SECRET])) { 
	require_once ROOT.'/'.Config::VIEW.'layouts/admin_auth.php';
} else self::checkAdmin(); ?>