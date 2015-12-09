<?php
	defined('BIT') or die;
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Админ панель <?=Config::SITE_NAME?></title>
	<link href="<?=Config::ADDRESS.Config::TEMPLATE?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="<?=Config::ADDRESS.Config::TEMPLATE?>style/admin_auth.css">
</head>
<body>
	<div id="backSite"><a href="<?=Config::ADDRESS?>">ВЕРНУТЬСЯ НА САЙТ</a></div>

	<form id="autForm" action="<?=Config::ADDRESS?>admin/login" method="post">
		<?php 
		  //выводим сообщение об ошибке или успехе проведения операции
		  if(isset($_GET['res']) && !empty($_GET['res'])){ 
		    echo Message::getMsg($_GET['res']);
		  } 
		?>
		<input type="text" name="adm_log" class="autField" placeholder="Логин"><br/>
		<input type="password" name="adm_pass" class="autField" placeholder="Пароль"><br/>
		<input type="submit" name="authSubmit" class="autField" value="ВОЙТИ">
	</form>
</body>
</html>