<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';

echo "Здесь будет выводиться страница Contact<br>";
?>

<?php 
  //выводим сообщение об ошибке или успехе проведения операции
  if(isset($msg) && !empty($msg)){ 
    echo Message::getMsg($msg);
  } 
?>


<form action="" method="post">
  <br/>Name: <input type="text" name="name" ><br/><br/>
  Email: <input type="email" name="email" ><br/><br/>
  Message: <textarea name="message" rows="8" cols="40"></textarea><br/><br/>
  <img id="imgCaptcha" src="<?=Config::ADDRESS?>helpers/captcha.php" alt="captcha"> 
  <a href="#" onclick="document.getElementById('imgCaptcha').src = '<?=Config::ADDRESS?>helpers/captcha.php?' + Math.random();" >Update</a>
  <input type="text" name="captcha" ><br/><br/>
  <input type="submit" name="submit" value="Send">
</form>

<?php
require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
