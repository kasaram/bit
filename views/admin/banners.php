<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>
<div id="content">
  <div class="viewname">Баннеры</div>
  <?php 
    //выводим сообщение об ошибке или успехе проведения операции
    if(isset($_GET['res']) && !empty($_GET['res'])){ 
      echo Message::getMsg($_GET['res']);
    } 
  ?>
<!--   <form action="<?=Config::ADDRESS?>admin/banners/add" method="post">
    <div class="formname">Статичные баннеры</div>
    <div class="form">
      <div>
        <div>Баннер вверху:</div>
        <div><textarea name="banner_top" placeholder="<?=Config::BANNER_TOP?>"></textarea></div>
      </div>
      <div>
        <div>Баннер слева:</div>
        <div><textarea name="banner_left" placeholder="<?=Config::BANNER_LEFT?>"></textarea></div>
      </div>
      <div>
        <div>Баннер справа:</div>
        <div><textarea name="banner_right" placeholder="<?=Config::BANNER_RIGHT?>"></textarea></div>
      </div>
      <div>
        <div></div>
        <div>
          <input type="submit" name="default" value="По умолчанию">
          <input type="submit" name="save" value="Сохранить">
        </div>
      </div>
    </div>
  </form> -->

  <form action="<?=Config::ADDRESS?>admin/banners/create" method="post">
    <div class="formname">Добавить баннер</div>
    <div class="form">
      <div>
        <div>Размер:</div>
        <div>
          <select name="size">
            <option value="728x90">728x90</option>
            <option value="468x60">468x60</option>
            <option value="300x250">300x250</option>
            <option value="160x600">160x600</option>
          </select>
        </div>
      </div>
      <div>
        <div>Заголовок:</div>
        <div><input name="title" type="text" placeholder="Укажите заголовок баннера" required></div>
      </div>
      <div>
        <div>Содержимое:</div>
        <div><textarea name="descr" placeholder="Вставьте скрипт баннера" required></textarea></div>
      </div>
      <div>
        <div></div>
        <div><input type="submit" name="submit" value="Создать"></div>
      </div>
    </div>
  </form>

  <table border=1>
    <tr>
      <td>Заголовок</td>
      <td>Содержимое</td>
      <td>Создано</td>
      <td>Активно</td>
      <td>Удаление</td>
    </tr>
  <?php 
  if (isset($listBanners)) {
    foreach ($listBanners as $item) { 
    ?>
      <tr>
        <td><?=$item['title']?></td>
        <td><?=htmlspecialchars_decode($item['descr'])?></td>
        <td><?=Format::adminDate($item['pubTime'])?></td>
        <td>
          <form action="<?=Config::ADDRESS?>admin/banners/update/<?=$item['id'];?>" method="post">
            <?php $checked = !empty($item['publish']) ? 'checked' : '';  ?>
            <input type="checkbox" onclick="submit();" name="publish"  <?=$checked?>>
          </form>
        </td>
        <td><a href="<?=Config::ADDRESS?>admin/banners/delete/<?=$item['id']?>">Удалить</a></td>
      </tr>
    <?php } 
  } ?>
  </table>
</div>
</body>
</html>