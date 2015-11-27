<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>

<p style = "color:#1d4bee;">Здесь будут выводиться общие настройки сайта</p>

<?php if(isset($_GET['suc'])) {?>
  <p style="color:#5cd212;">Данные успешно изменены! </p>
<?php } ?>
<?php if(isset($_GET['fail'])) {?>
  <p style="color:#d21212;">Произошла ошибка, данные не удалось изменить!</p>
<?php } ?>

<form action="service" method="post">
  <p>
    Наименование сайта:
    <input class="field "type="text" name="site_name" placeholder="<?=Config::SITE_NAME?>">
  </p>
  <p>
    Адрес сайта:
    <input class="field "type="text" name="address" placeholder="<?=Config::ADDRESS?>">
  </p>
  <p>
    E-mail администратора:
    <input class="field "type="text" name="adm_email" placeholder="<?=Config::ADM_EMAIL?>">
  </p>
  <br/>
  <p>
    Наименование валюты:
    <input class="field" type="text" name="coin" placeholder="<?=Config::COIN?>">
  </p>
  <p>
    Минимальная суммма для снятия:
    <input class="field" type="text" name="sum_amount" placeholder="<?=Config::SUM_AMOUNT?>">
  </p>
  <p>
    Реферальная комиссия:
    <input class="field "type="text" name="ref_commission" placeholder="<?=Config::REF_COMMISSION?>">
  </p>
  <p>
    Количество отображаемых баннеров:
    <input class="field" type="text" name="num_banners" placeholder="<?=Config::NUM_BANNERS?>">
  </p>
  <p>
    Количество рекламы на странице бонусы:
    <input class="field" type="text" name="num_reclame" placeholder="<?=Config::NUM_RECLAME?>">
  </p>
  <p>
    Текст в подвале(футер) сайта:
    <input class="field "type="text" name="footer_text" placeholder="<?=Config::FOOTER_TEXT?>">
  </p>
  <p>
    <input type="submit" name="default" value="По умолчанию">
    <input type="submit" name="save" value="Сохранить">
  </p>
</form>
