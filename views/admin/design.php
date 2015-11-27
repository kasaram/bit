<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>

<p style = "color:#1d4bee;">Здесь будут выводиться настройки дизайна</p>

<?php if(isset($_GET['suc'])) {?>
  <p style="color:#5cd212;">Данные успешно изменены! </p>
<?php } ?>
<?php if(isset($_GET['fail'])) {?>
  <p style="color:#d21212;">Произошла ошибка, данные не удалось изменить!</p>
<?php } ?>

<form action="design" method="post">
  <p>
    Логотип сайта:
    <input class="field" type="text" name="LOGO" placeholder="<?=Config::LOGO?>">
  </p>
  <p>
    Цвет фона сайта:
    <input class="field "type="text" name="color_bg" placeholder="<?=Config::COLOR_BG?>">
  </p>
  <p>
    Цвет основного текста на сайте:
    <input class="field "type="text" name="color_tExt" placeholder="<?=Config::COLOR_TEXT?>">
  </p>
  <p>
    Второстепенный цвет на сайте:
    <input class="field "type="text" name="color_second" placeholder="<?=Config::COLOR_SECOND?>">
  </p>
  <p>
    Цвет фона кнопок:
    <input class="field "type="text" name="color_button_bg" placeholder="<?=Config::COLOR_BUTTON_BG?>">
  </p>
  <p>
    Цвет текста кнопок:
    <input class="field "type="text" name="color_button_text" placeholder="<?=Config::COLOR_BUTTON_TEXT?>">
  </p>
  <p>
    Цвет фона кнопок при наведении:
    <input class="field "type="text" name="color_button_text" placeholder="<?=Config::COLOR_BUTTON_HOVER_BG?>">
  </p>
  <p>
    Скругление углов элементов:
    <input class="field "type="text" name="color_button_text" placeholder="<?=Config::BORDER_RADIUS?>">
  </p>
  <p>
    <input type="submit" name="default" value="По умолчанию">
    <input type="submit" name="save" value="Сохранить">
  </p>
</form>
