<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>
<div id="content">
  <div class="viewname">Видео</div>
  <?php 
    //выводим сообщение об ошибке или успехе проведения операции
    if(isset($_GET['res']) && !empty($_GET['res'])){ 
      echo Message::getMsg($_GET['res']);
    } 
  ?>
  <form action="<?=Config::ADDRESS?>admin/video/create" method="post">
    <div class="formname">Добавить видео</div>
    <div class="form">
      <div>
        <div>Заголовок:</div>
        <div><input name="title" type="text" placeholder="Укажите заголовок видео" required></div>
      </div>
      <div>
        <div>Содержимое:</div>
        <div><textarea name="descr" placeholder="Вставьте видео" required></textarea></div>
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
  if (isset($listVideo)) {
    foreach ($listVideo as $item) { ?>
      <tr>
        <td><?=$item['title']?></td>
        <td><?=htmlspecialchars($item['descr'])?></td>
        <td><?=Format::adminDate($item['pubTime'])?></td>
        <td>
          <form action="<?=Config::ADDRESS?>admin/video/update/<?=$item['id'];?>" method="post">
            <?php $checked = !empty($item['publish']) ? 'checked' : '';  ?>
            <input type="checkbox" onclick="submit();" name="publish"  <?=$checked?>>
          </form>
        </td>
        <td><a href="<?=Config::ADDRESS?>admin/video/delete/<?=$item['id']?>">Удалить</a></td>
      </tr>
  <?php } 
  } ?>
  </table>
</div>
</body>
</html>