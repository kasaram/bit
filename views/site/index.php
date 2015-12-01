<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';

echo 'Это представление главной страницы обрабатывает SiteController  и его экшен actionIndex<br><br>';
?>
<?php 
  //выводим сообщение об ошибке или успехе проведения операции
  if(isset($_GET['res']) && !empty($_GET['res'])){ 
    echo Message::getMsg($_GET['res']);
  } 
?>

<?php if(!isset($_SESSION['bitcoin'])) { ?>
  <form action="login" method="post">
    <input type="text" name="bitcoin" value="" size="40">
    <input type="submit" name="submit" value="Send">
  </form>
<?php } else { ?>
  <p>
    <form action="logout" method="post">
      Ваш биткоин: <?=$_SESSION['bitcoin']?> &nbsp;
      <input type="submit" name="logout" value="LOGOUT">
    </form>
  </p>

<?php } ?>

<?php
require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';

require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
