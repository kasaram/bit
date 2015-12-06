<?php
	defined('BIT') or die;
	//Массив для меню
	$links = ['users'=>'Пользователи', 'banners'=>'Баннеры', 'reclama'=>'Реклама', 'video'=>'Видео', 'game'=>'Игра', 'design'=>'Дизайн', 'service'=>'Настройки'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Админ панель <?=Config::SITE_NAME?></title>
	<link rel="stylesheet" type="text/css" href="<?=Config::ADDRESS.Config::TEMPLATE?>style/css.css">
</head>
<body>
	<div class="adminLine"><a href="<?=Config::ADDRESS?>" target="_blank">Перейти на сайт</a></div>
	<div id="mainmenu">
		<?php  
			foreach ($links as $k=>$v) {	
			$class = strpos($_SERVER['REQUEST_URI'], $k) ? 'class="active"': '';
		?>	
			<a <?=$class?> href="<?=Config::ADDRESS?>admin/<?=$k?>"><?=$v?></a>
		<?php } ?>
			<a href="<?=Config::ADDRESS?>page" target="_blank">Страница</a>
			<a href="<?=Config::ADDRESS?>admin/logout">Выйти</a>
	</div>