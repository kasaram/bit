<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>

<p style = "color:#1d4bee;">Здесь будут выводиться настройки баннеров</p>

<?php 
  //выводим сообщение об ошибке или успехе проведения операции
  if(isset($_GET['res']) && !empty($_GET['res'])){ 
    echo Message::getMsg($_GET['res']);
  } 
?>


<h3>Указать статические баннеры</h3>
<form action="<?=Config::ADDRESS?>admin/banners/add" method="post">
  <p class="area">
    Баннер вверху:
    <textarea name="banner_top" class="field area" cols="30" rows="10" placeholder="<?=Config::BANNER_TOP?>"></textarea>
  </p>
  <p class="area">
    Баннер слева:
    <textarea name="banner_left" class="field area" cols="30" rows="10" placeholder="<?=Config::BANNER_LEFT?>"></textarea>
  </p>
  <p class="area">
    Баннер справа:
    <textarea name="banner_right" class="field area" cols="30" rows="10" placeholder="<?=Config::BANNER_RIGHT?>"></textarea>
  </p>
  <p>
    <input type="submit" name="default" value="По умолчанию">
    <input type="submit" name="save" value="Сохранить">
  </p>
</form>
<hr/>

<h3>Добавить баннер</h3>
<form action="<?=Config::ADDRESS?>admin/banners/create" method="post">
  <p>Заголовок: <input class="field" name="title" type="text"></p>
  <p class="area">Содержимое: <textarea class="field area" name="descr" cols="30" rows="10"></textarea></p>
  <p><input class="sub" type="submit" name="submit" value="Создать"></p>
</form>
<br>
<hr>
<br>
<table border=1 cellspacing=0 cellpadding=10>
  <tr>
    <th>Заголовок</th>
    <th>Содержимое</th>
    <th>Дата публикации</th>
    <th>Опубликовано</th>
    <th>Удаление</th>
  </tr>
<?php 
if (isset($listBanners)) {
  foreach ($listBanners as $item) { 
  ?>
    <tr>
      <td><?=$item['title']?></td>
      <td><?=htmlspecialchars($item['descr'])?></td>
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
