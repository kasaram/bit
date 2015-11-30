<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>

<p style = "color:#1d4bee;">Здесь будет выводиться страница с рекламой</p>

<?php 
  $msg = ['sucCrt'=>'создана!','sucUpd' => 'обновлена!','sucDel' => 'удалена!'];
  $err = ['failCrt'=>'создать', 'failUpd'=>'обновить', 'failDel'=>'удалить'];
  $style = 'display:none;';
  if (isset($_GET) && !empty($_GET)) {
    $get = array_keys($_GET)[0];
    if (key_exists($get, $msg)) {
      $style = 'color:#5cd212;';
      $text = 'Реклама успешно '.$msg[$get];
    } else if (key_exists($get, $err)) { 
      $style = 'color:#d21212;';
      $text = 'Произошла ошибка, не удалось '.$err[$get].' рекламу!';
    } 
  } 
?>
<p style="<?=$style?>"><?=$text?></p>

<h3>Добавить рекламу</h3>
<form action="<?=Config::ADDRESS?>admin/reclama/create" method="post">
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
if (isset($listReclama)) {
  foreach ($listReclama as $item) { ?>
  <tr>
    <td><?=$item['title']?></td>
    <td><?=htmlspecialchars($item['descr'])?></td>
    <td><?=Format::adminDate($item['pubTime'])?></td>
    <td>
      <form action="<?=Config::ADDRESS?>admin/reclama/update/<?=$item['id'];?>" method="post">
        <?php $checked = !empty($item['publish']) ? 'checked' : '';  ?>
        <input type="checkbox" onclick="submit();" name="publish"  <?=$checked?>>
      </form>
    </td>
    <td><a href="<?=Config::ADDRESS?>admin/reclama/delete/<?=$item['id']?>">Удалить</a></td>
  </tr>
<?php } 
} ?>
</table>