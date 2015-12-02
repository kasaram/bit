<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>
<div id="content">
  <div class="viewname">Дизайн</div>
  <?php 
    //выводим сообщение об ошибке или успехе проведения операции
    if(isset($_GET['res']) && !empty($_GET['res'])){ 
      echo Message::getMsg($_GET['res']);
    } 
  ?>
  <form action="design" method="post">
    <div class="formname">Настройки дизайна</div>
    <div class="form">
      <div>
        <div>Логотип сайта:</div>
        <div><input type="text" name="logo" placeholder="<?=Config::LOGO?>"></div>
      </div>
      <div>
        <div>Цвет фона сайта:</div>
        <div><input type="text" name="color_bg" placeholder="<?=Config::COLOR_BG?>"></div>
      </div>
      <div>
        <div>Цвет основного текста на сайте:</div>
        <div><input type="text" name="color_text" placeholder="<?=Config::COLOR_TEXT?>"></div>
      </div>
      <div>
        <div>Второстепенный цвет на сайте:</div>
        <div><input type="text" name="color_second" placeholder="<?=Config::COLOR_SECOND?>"></div>
      </div>
      <div>
        <div>Цвет фона кнопок:</div>
        <div><input type="text" name="color_button_bg" placeholder="<?=Config::COLOR_BUTTON_BG?>"></div>
      </div>
      <div>
        <div>Цвет текста кнопок:</div>
        <div><input type="text" name="color_button_text" placeholder="<?=Config::COLOR_BUTTON_TEXT?>"></div>
      </div>
      <div>
        <div>Цвет фона кнопок при наведении:</div>
        <div><input type="text" name="color_button_text" placeholder="<?=Config::COLOR_BUTTON_HOVER_BG?>"></div>
      </div>
      <div>
        <div>Скругление углов элементов:</div>
        <div><input type="text" name="color_button_text" placeholder="<?=Config::BORDER_RADIUS?>"></div>
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