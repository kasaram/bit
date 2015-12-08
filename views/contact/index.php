<?php
  defined('BIT') or die;
  require_once ROOT.'/'.Config::VIEW.'layouts/header.php';
?>
<div class="content">
  <?php require_once ROOT.'/'.Config::VIEW.'layouts/banner.php';?>
  <?php //выводим сообщение об ошибке или успехе проведения операции
    if(isset($msg) && !empty($msg)){ 
      echo Message::getMsg($msg);
    } 
  ?>
  <div class="title">Contact</div>
    <form id="mailForm" action="<?=Config::ADDRESS?>contact" method="post">
      <div class="formtable">
        <div>
          <div>Name:</div>
          <div><input type="text" name="name"></div>
        </div>
        <div>
          <div>E-mail:</div>
          <div><input type="email" name="email"></div>
        </div>
        <div>
          <div>Message:</div>
          <div>
            <textarea name="message"></textarea>
          </div>
        </div>
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
          <div></div>
          <div>
            <a href="javascript://" class="button" onclick="$('#mailForm').submit();">SEND</a>
          </div>
        </div>
      </div>
    </form>
</div>



<?php
require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
