<?php
	defined('BIT') or die;
	require_once ROOT.'/'.Config::VIEW.'layouts/header.php';
?>
<?php
  //выводим сообщение об ошибке или успехе проведения операции
  if(isset($_GET['res']) && !empty($_GET['res'])){ 
    echo Message::getMsg($_GET['res']);
  } 
?>

<div class="content">
	<div id="bonusgame">
		<iframe id="mframe" src="<?=Config::ADDRESS?>helpers/foriframe.php"></iframe>
		<div id="bonusgamerightside">
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

			<div id="bonusacts">
					<div><?=$amountBonus.' '.Config::COIN?></div>
					<div></div>
					<?php //если у игрока есть временный выгрыш, то кнопка доступна
	          if(!empty($amountBonus)) { ?>
	            <a href="javascript://" onclick="scrolldown();">PICK UP</a>
	        <?php } else { ?>
	          <div class="inactivesm">PICK UP</div>
	        <?php } ?>
			</div>
		</div>
	</div>
</div>
<script>
	$(window).load(function () {
		window.tessw = new countdowner('#bonusacts>div:eq(1)', <?=$timeNextGame?>)<?=$start?>; //.start();
	});
</script>


<?php require_once ROOT.'/'.Config::VIEW.'layouts/middle.php'; ?>
<div class="content">
	<?php //если у игрока есть временный выйгрыш то кнопка доступна
      if(!empty($amountBonus)) {
    ?>
      <a href="javascript://" id="takecoins">CLICK TO CLAIM</a>
        <form id="captchaForm" action="<?=Config::ADDRESS?>bonus/claim" method="post">
          <div class="formtable" id="claimcaptchaform">
            <div>
              <div>
                <span class="refresh" onclick="document.getElementById('imgCaptcha').src = '<?=Config::ADDRESS?>helpers/captcha.php?' + Math.random();" >refresh</span>
                <img id="imgCaptcha" src="<?=Config::ADDRESS?>helpers/captcha.php" alt="captcha">
              </div>
              <div>
                <input type="text" name="captcha">
              </div>
            </div>
            <div>
              <div style='float:right;'>
                <a href="javascript://" class="button" onclick="$('#captchaForm').submit()">SEND</a>
              </div>
            </div>
          </div>
        </form>
        <div style="clear:both;"></div>
    <?php } else { ?>
      <div id="takecoinsinactive">CLICK TO CLAIM</div>
    <?php } ?>
</div>
<?php	require_once ROOT.'/'.Config::VIEW.'layouts/footer.php'; ?>