<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>
<div id="content">
  <div class="viewname">Игра</div>
  <?php 
    //выводим сообщение об ошибке или успехе проведения операции
    if(isset($_GET['res']) && !empty($_GET['res'])){ 
      echo Message::getMsg($_GET['res']);
    } 
  ?>
  <form action="game" method="post">
    <div class="formname">Настройки игры</div>
    <div class="form">
      <div>
        <div>Время ожидания следующей игры:</div>
        <div><input type="text" name="pause_game" placeholder="<?=Config::PAUSE_GAME?>"></div>
      </div>
      <div>
        <div>Количество шансов за одну игру:</div>
        <div><input type="text" name="num_chance" placeholder="<?=Config::NUM_CHANCE?>"></div>
      </div>
      <div>
        <div>Всего позиций:</div>
        <div><input type="text" name="num_boxes" placeholder="<?=Config::NUM_BOXES?>"></div>
      </div>
      <div>
        <div>Количество бонусных позиций:</div>
        <div><input type="text" name="num_Bonuses" placeholder="<?=Config::NUM_BONUSES?>"></div>
      </div>
      <div>
        <div>Количество выигрышных позиций:</div>
        <div><input type="text" name="num_wins" placeholder="<?=Config::NUM_WINS?>"></div>
      </div>
      <div>
        <div>Минимальная выйгрыш денег за один шанс:</div>
        <div><input type="text" name="min_amount" placeholder="<?=Config::MIN_AMOUNT?>"></div>
      </div>
      <div>
        <div>Максимальная выйгрыш денег за один шанс:</div>
        <div><input type="text" name="max_amount" placeholder="<?=Config::MAX_AMOUNT?>"></div>
      </div>
      <div>
        <div>Минимальный выйгрыш бонуса за один шанс:</div>
        <div><input type="text" name="min_bonus" placeholder="<?=Config::MIN_BONUS?>"></div>
      </div>
      <div>
        <div>Максимальный выйгрыш бонуса за один шанс:</div>
        <div><input type="text" name="max_bonus" placeholder="<?=Config::MAX_BONUS?>"></div>
      </div>
      <div>
        <div>Выйгрыша при клике по рекламе в бонусной игре(один):</div>
        <div><input type="text" name="amount_bonus_1" placeholder="<?=Config::AMOUNT_BONUS_1?>"></div>
      </div>
      <div>
        <div>Выйгрыша при клике по рекламе в бонусной игре(два):</div>
        <div><input type="text" name="amount_bonus_2" placeholder="<?=Config::AMOUNT_BONUS_2?>"></div>
      </div>
      <div>
        <div></div>
        <div>
          <input type="submit" name="default" value="По умолчанию">
          <input type="submit" name="save" value="Сохранить">
        </div>
      </div>
    </div>
  </form>
</div>
</body>
</html>