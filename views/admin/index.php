<?php
defined('BIT') or die;
//проверяем авторизирован ли админ

if(isset($_SESSION['adm_log'])) {

require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>
<p style = "color:#1d4bee;">Здесь будет выводиться страница авторизированного админа</p>
<h2>Добро пожаловать!</h2>
<h3>В административном разделе сайта вы можете изменять различные настройки.</h3>

<?php } elseif (isset($_GET[Config::SECRET])) { ?>

<style type="text/css">
	body{margin: 0;	padding: 0;}
	#fon {width: 100%;height: 100%;background: #fbc444;}
	#autForm {width: 220px;height: 155px;position: absolute;left: 50%;top: 50%;margin-left: -110px;margin-top: -75px;}	
	.autField {width: 100%;height: 40px;margin-top: 7px;font-size: 14px;color: #444;border: 1px solid #ffb100;padding-left: 20px;border-radius: 5px;}
	#autForm input[type="submit"] {background: #1CDC4E;  color: #fff;  font-weight: bold;  padding:0;}
	#autForm input[type="submit"]:hover {	background: #22C54D; }
	#backSite{height:30px;width: 100%;text-align: center;line-height: 30px;background: #C3C3C3;}
	#backSite a{color: #fff; text-decoration: none; text-shadow: 0px 0px 10px #7D7D7D;}
	#fon .err {color:#d21212; background: white; padding: 10px; border-radius: 5px; text-align: center;	}
</style>
<div id="fon">
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
</div>

<?php } else self::checkAdmin(); ?>