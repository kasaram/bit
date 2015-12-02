<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';

require_once ROOT.'/config/AdminConfig.php';
?>
<div id="content">
  <div class="viewname">Настройки</div>
  <?php 
    //выводим сообщение об ошибке или успехе проведения операции
    if(isset($_GET['res']) && !empty($_GET['res'])){ 
      echo Message::getMsg($_GET['res']);
    } 
  ?>
  <form action="<?=Config::ADDRESS?>admin/service" method="post">
    <div class="formname">Общие настройки сайта</div>
    <div class="form">
      <div>
        <div>Наименование сайта:</div>
        <div><input type="text" name="site_name" placeholder="<?=Config::SITE_NAME?>"></div>
      </div>
      <div>
        <div>Адрес сайта:</div>
        <div><input type="text" name="address" placeholder="<?=Config::ADDRESS?>"></div>
      </div>
      <div>
        <div>E-mail администратора:</div>
        <div><input type="text" name="adm_email" placeholder="<?=Config::ADM_EMAIL?>"></div>
      </div>
      <div>
        <div>Слово в конце URL-адреса для входа в админ панель:</div>
        <div><input type="text" name="secret" placeholder="<?=Config::SECRET?>"></div>
      </div>
      <br/>
      <div>
        <div>Наименование валюты:</div>
        <div><input  type="text" name="coin" placeholder="<?=Config::COIN?>"></div>
      </div>
      <div>
        <div>Минимальная суммма для снятия:</div>
        <div><input  type="text" name="sum_amount" placeholder="<?=Config::SUM_AMOUNT?>"></div>
      </div>
      <div>
        <div>Реферальная комиссия:</div>
        <div><input type="text" name="ref_commission" placeholder="<?=Config::REF_COMMISSION?>"></div>
      </div>
      <div>
        <div>Количество отображаемых баннеров:</div>
        <div><input  type="text" name="num_banners" placeholder="<?=Config::NUM_BANNERS?>"></div>
      </div>
      <div>
        <div>Количество рекламы на странице бонусы:</div>
        <div><input  type="text" name="num_reclame" placeholder="<?=Config::NUM_RECLAME?>"></div>
      </div>
      <div>
        <div>Текст в подвале(футер) сайта:</div>
        <div><input type="text" name="footer_text" placeholder="<?=Config::FOOTER_TEXT?>"></div>
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
  
  <form action="<?=Config::ADDRESS?>admin/service" method="post">
    <div class="formname">Настройки администратора</div>
    <div class="form">
      <div>
        <div>Логин администратора:</div>
        <div><input  type="text" name="adm_log" placeholder="<?=AdminConfig::ADM_LOG?>"></div>
      </div>
      <div>
        <div>Пароль администратора:</div>
        <div><input  type="text" name="adm_pass" placeholder="<?=AdminConfig::ADM_PASS?>"></div>
      </div>
      <div>
        <div></div>
        <div>
          <input type="submit" name="saveAdmin" value="Сохранить">
        </div>
      </div>
    </div>
  </form>
</div>
</body>
</html>