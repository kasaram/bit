<?php
	defined('BIT') or die;
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Админ панель <?=Config::SITE_NAME?></title>
	<link rel="stylesheet" type="text/css" href="<?=Config::ADDRESS.Config::TEMPLATE?>style/css.css">
</head>
<body>
	<div class="adminLine"></div>
	<div id="mainmenu">
		<a href="<?=Config::ADDRESS?>admin/users">Пользователи</a>
		<a href="<?=Config::ADDRESS?>admin/banners">Баннеры</a>
		<a href="<?=Config::ADDRESS?>admin/reclama">Реклама</a>
		<a href="<?=Config::ADDRESS?>admin/video">Видео</a>
		<a href="<?=Config::ADDRESS?>admin/game">Игра</a>
		<a href="<?=Config::ADDRESS?>admin/design">Дизайн</a>
		<a href="<?=Config::ADDRESS?>admin/service">Настройки</a>
		<a href="<?=Config::ADDRESS?>page" target="_blank">Страница</a>
		<a href="<?=Config::ADDRESS?>admin/logout">Выйти</a>
	</div>