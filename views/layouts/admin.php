<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';

?>
<style type="text/css">
  .field { width: 200px; height: 30px; border-radius: 3px; border-color: #b8b8b8; color: #444; padding: 5px; font-size: 14px; float: right; margin-right: 700px;}
  .area{height: 100px;}
  .sub{margin-left: 565px;}
</style>

<a href="<?=Config::ADDRESS?>admin/users">Пользователи</a><br/><br/>
<a href="<?=Config::ADDRESS?>admin/banners">Баннеры</a><br/><br/>
<a href="<?=Config::ADDRESS?>admin/reclama">Реклама</a><br/><br/>
<a href="<?=Config::ADDRESS?>admin/video">Видео</a><br/><br/>
<a href="<?=Config::ADDRESS?>admin/game">Игра</a><br/><br/>
<a href="<?=Config::ADDRESS?>admin/design">Дизайн</a><br/><br/>
<a href="<?=Config::ADDRESS?>admin/service">Настройки</a><br/><br/>
<a href="<?=Config::ADDRESS?>page" target="_blank">Страница</a><br/><br/>
<a href="<?=Config::ADDRESS?>admin/logout">Выйти</a><br/><br/>
<br><br>
