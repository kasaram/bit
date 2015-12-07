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
    <?php if (isset($_GET['ref']) && !empty($_GET['ref'])) { ?>
      <input type="hidden" name="ref" value="<?=$_GET['ref']?>">
    <?php } ?>
    <input type="text" name="bitcoin" value="" size="40">
    <input type="submit" name="submit" value="Send">
  </form>
<?php } else { ?>
  <p>
      Ваш биткоин: <?=$_SESSION['bitcoin']?> &nbsp;
  </p>

  <!-- Выводим боксы -->
  <?php   for ($i=0; $i < count($dataBox); $i++) {   ?>
      <a class = "<?=$dataBox[$i]['class']?>" href="<?=Config::ADDRESS?>games/<?=$i?>"><?=$dataBox[$i]['val']?></a><br/>
  <?php } ?>

<table style="margin:50px;" border=1 cellpadding="10" cellspacing="0">
  <tr>
    <td>Chances</td>
    <td>Claim amount</td>
    <td>Bonus minutes</td>
    <td>Daily bonus</td>
  </tr>
  <tr>
    <td><?=$_SESSION['numChance']?></td>
    <td><?=$_SESSION['claimAmount']?></td>
    <td><?=$_SESSION['bonusMinutes']?></td>
    <td><?=$_SESSION['dailyBonus']?></td>
  </tr>
</table>

<p> <a href="#clickToClaim">PICK UP</a></p>
<p> <a href="<?=Config::ADDRESS?>bonus">BONUS</a></p>


<?php } ?>



<?php
  require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
?>
<?php if(empty($_SESSION['numChance'])) { ?>
  <p> <a id="clickToClaim" href="<?=Config::ADDRESS?>claim">CLICK TO CLAIM</a></p>
<?php } ?>

<?php
  require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
?>