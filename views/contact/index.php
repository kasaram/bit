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
  <br/>Name: <input type="text" name="name" value=""><br/><br/>
  Email: <input type="email" name="email" value=""><br/><br/>
  Message: <textarea name="message" rows="8" cols="40"></textarea><br/><br/>
  <input type="submit" name="submit" value="Send">
</form>

<?php
require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
