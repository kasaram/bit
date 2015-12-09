<?php 
define('BIT', true);
	require_once '../config/Config.php';
	require_once '../components/DB.php';
	require_once '../models/Reclama.php';

	session_start();

	//получаем рекламу
	$reclameList = Reclama::getReclamaOnSite('rand');

	$text = time() < $_SESSION['pauseBonus'] ? "Please wait..." : 'Click on a banner and benefit from '.Config::AMOUNT_BONUS_1.' to '.Config::AMOUNT_BONUS_2.' '.Config::COIN;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?=Config::SITE_NAME?></title>
		<link rel="stylesheet" type="text/css" href="/template/style/site.css">
	</head>
	<body>
		<span id="iframetitle"><?=$text?></span>
		<?php //если время до следующей игры истекло выводим баннеры
			if(time() > $_SESSION['pauseBonus']) {
		?>
		<p><?=htmlspecialchars_decode($reclameList[0]['descr'])?></p>
		<p><?=htmlspecialchars_decode($reclameList[1]['descr'])?></p>
		<?php } ?>
	</body>
</html>