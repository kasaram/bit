<?php
	defined('BIT') or die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="refresh" content="60">
  <title><?=Config::SITE_NAME?></title>
  <link rel="stylesheet" type="text/css" href="<?=Config::ADDRESS.Config::TEMPLATE?>style/site.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="<?=Config::ADDRESS.Config::TEMPLATE?>/js/scripts.js"></script>
</head>
<body>
<div id="overall">
  <div id="header">
    <div id="translate"></div>
    <div class="menu">
      <a href="<?=Config::ADDRESS?>" class="logo"></a>
      <div class="menulinks">
        <a href="<?=Config::ADDRESS?>refer">Refer</a>
        <a href="<?=Config::ADDRESS?>faq">FAQ</a>
        <a href="<?=Config::ADDRESS?>contact">Contact</a>
        <?php if (isset($_SESSION['id'])) { ?>
          <a href="<?=Config::ADDRESS?>account">Account</a>
        <?php } ?>
      </div>
    </div>

<?php require_once ROOT.'/'.Config::VIEW.'layouts/banner.php';?>

	<div class="content">
  <div id="advertisments">
    <?php foreach($listReclama as $item) { ?>
      <div><?=htmlspecialchars_decode($item['descr'])?></div>
    <?php } ?>
  </div>
</div>

	
	<?php // подгружаем видео если оно есть, либо заставку
      if(empty($videoList)) {
    ?>
        <div id="withoutvideo"><?=Config::VIDEO_TEXT?></div>
    <?php } else { ?>
      <div id="video"></div>
      <script>
        // Загружаем iframe асинхронно
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        // Создаем функцию для <iframe> (и ютуб плеер), после загрузки API кода
        var player;
        function onYouTubeIframeAPIReady() {
          player = new YT.Player('video', {
            height: '360',
            width: '600',
            videoId: '<?=$video?>',
            playerVars: {
              'iv_load_policy': 3,
              'controls': 2,
              'autoplay': 1,
              'loop': 1,
              'playlist': '<?=$playList?>',
              'rel': 0,
              'showinfo': 0,
              'fs': 0,
              'disablekb': 1,
              'origin': '<?=Config::ADDRESS?>'
            },
            events: {
              'onReady': onPlayerReady
            }
          });
        }
        // Запускаем видео и отключаем звук
        function onPlayerReady(event) {
          event.target.playVideo();
          player.mute();
        }
      </script>
    <?php } ?>


<?php 
	require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
	require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
?>