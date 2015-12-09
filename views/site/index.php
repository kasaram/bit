<?php
  defined('BIT') or die;
  require_once ROOT.'/'.Config::VIEW.'layouts/header.php';
?>
<div class="content">
  <div id="game">
    <?php require_once ROOT.'/'.Config::VIEW.'layouts/banner.php';?>
    
    <?php //если игрок не зашел, то блокируем боксы
      if(!isset($_SESSION['id'])) { 
    ?>
      <div id="gamelockdesc">Please enter your bitcoin to play!</div>
      <div id="gamelock"></div>
    <?php } ?>

    <?php //если установлено время до следующей игры то выводим блокирующий блок
      if(isset($_SESSION['pauseGame']) && $_SESSION['pauseGame'] >= time()) {
        //рассчитываем оставшееся время
        $time =  $_SESSION['pauseGame'] - time();
    ?>
      <div id="gamelockdesc">
        Please wait for:
        <div id="gamelocktimer"></div>
      </div>
      <div id="gamelock"></div>
      <script>
        $(window).load(function () {
          var tessf = new countdowner('#gamelocktimer', <?=$time?>).start();
        });
      </script>
    <?php } ?>

    <?php //выводим сообщение об ошибке или успехе проведения операции
      if(isset($_GET['res']) && !empty($_GET['res'])){ 
        echo Message::getMsg($_GET['res']);
      } 
    ?>
    
    <div id="field">
      <?php   //выводим боксы
        for ($i=0; $i < count($dataBox); $i++) {   ?>
          <a class = "<?=$dataBox[$i]['class']?>" href="<?=Config::ADDRESS?>games/<?=$i?>"><?=$dataBox[$i]['val']?></a>
      <?php } ?>
    </div>

    <?php //если пользователь зашел то выводим ему информационный блок
      if (isset($_SESSION['id'])) {
    ?>
      <div id="gamepanel">
        <div>
          <div><?=$_SESSION['numChance']?></div>
          Chances
        </div>
        <div>
          <div><?=$_SESSION['claimAmount']?></div>
          Claim amount
        </div>
        <div>
          <div><?=$_SESSION['bonusMinutes']?></div>
          Bonus minutes
        </div>
        <div>
          <div><?=$_SESSION['dailyBonus']?>%</div>
          Daily bonus
        </div>
      </div>

      <div id="gamebtns">
        <?php //если игрок сыграл игру или не начал ее и у него есть временный выйгрыш то кнопка доступна
          if(isset($_SESSION['numChance']) && ($_SESSION['numChance']==0 || $_SESSION['numChance']==Config::NUM_CHANCE) && $_SESSION['claimAmount']>0) { ?>
            <a href="javascript://" onclick="scrolldown();">PICK UP</a>
        <?php } else { ?>
          <div>PICK UP</div>
        <?php } ?>
        <?php //если у игрока есть бонусные минуты, то кнопка доступна
          if(isset($_SESSION['bonus']) && $_SESSION['bonus']>0) { ?>
            <a href="<?=Config::ADDRESS?>bonus">BONUS GAME</a>
        <?php } else { ?> 
        <div>BONUS GAME</div>
        <?php } ?>
    </div>
  <?php } ?>
	</div>
</div>

  <?php require_once ROOT.'/'.Config::VIEW.'layouts/middle.php'; ?>
  
  <?php //если игрок зашел, то отображаем ему кнопку CLICK TO CLAIM
    if(isset($_SESSION['id'])) { 
  ?>
    <?php //если игрок сыграл игру или не начал ее и у него есть временный выйгрыш то кнопка доступна
      if(isset($_SESSION['numChance']) && ($_SESSION['numChance']==0 || $_SESSION['numChance']==Config::NUM_CHANCE) && $_SESSION['claimAmount']>0) {
    ?>
      <a href="javascript://" id="takecoins">CLICK TO CLAIM</a>
        <form id="captchaForm" action="<?=Config::ADDRESS?>claim" method="post">
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
  <?php } ?>
	
<?php require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';?>