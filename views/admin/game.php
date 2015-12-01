<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>
<p style = "color:#1d4bee;">Здесь подключаются настройки игры</p>

<?php 
  //выводим сообщение об ошибке или успехе проведения операции
  if(isset($_GET['res']) && !empty($_GET['res'])){ 
    echo Message::getMsg($_GET['res']);
  } 
?>

<form action="game" method="post">
  <p>
    Время ожидания следующей игры:
    <input class="field "type="text" name="pause_game" placeholder="<?=Config::PAUSE_GAME?>">
  </p>
  <p>
    Количество шансов за одну игру:
    <input class="field "type="text" name="num_chance" placeholder="<?=Config::NUM_CHANCE?>">
  </p>
  <p>
    Всего позиций:
    <input class="field "type="text" name="num_boxes" placeholder="<?=Config::NUM_BOXES?>">
  </p>
  <p>
    Количество бонусных позиций:
    <input class="field "type="text" name="num_Bonuses" placeholder="<?=Config::NUM_BONUSES?>">
  </p>
  <p>
    Количество выигрышных позиций:
    <input class="field "type="text" name="num_wins" placeholder="<?=Config::NUM_WINS?>">
  </p>
  <p>
    Минимальная выйгрыш денег за один шанс:
    <input class="field "type="text" name="min_amount" placeholder="<?=Config::MIN_AMOUNT?>">
  </p>
  <p>
    Максимальная выйгрыш денег за один шанс:
    <input class="field "type="text" name="max_amount" placeholder="<?=Config::MAX_AMOUNT?>">
  </p>
  <p>
    Минимальный выйгрыш бонуса за один шанс:
    <input class="field "type="text" name="min_time" placeholder="<?=Config::MIN_TIME?>">
  </p>
  <p>
    Максимальный выйгрыш бонуса за один шанс:
    <input class="field "type="text" name="max_time" placeholder="<?=Config::MAX_TIME?>">
  </p>
  <p>
    Выйгрыша при клике по рекламе в бонусной игре(один):
    <input class="field "type="text" name="amount_bonus_1" placeholder="<?=Config::AMOUNT_BONUS_1?>">
  </p>
  <p>
    Выйгрыша при клике по рекламе в бонусной игре(два):
    <input class="field "type="text" name="amount_bonus_2" placeholder="<?=Config::AMOUNT_BONUS_2?>">
  </p>
  <p>
    <input type="submit" name="default" value="По умолчанию">
    <input type="submit" name="save" value="Сохранить">
  </p>

</form>
