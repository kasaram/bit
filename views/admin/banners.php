<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>

<p style = "color:#1d4bee;">Здесь будут выводиться настройки баннеров</p>

<?php if(isset($_GET['sucDel'])) {?>
  <p style="color:#5cd212;">Баннер успешно удален! </p>
<?php } ?>
<?php if(isset($_GET['failDel'])) {?>
  <p style="color:#d21212;">Произошла ошибка, не удалось удалить баннер!</p>
<?php } ?>


<form action="banners" method="post">

</form>

<table border=1 cellspacing=0 cellpadding=10>
  <tr>
    <th>Заголовок</th>
    <th>Содержимое</th>
    <th>Дата публикации</th>
    <th>Опубликовано</th>
    <th>Удаление</th>
  </tr>
<?php foreach ($listBanners as $item) { ?>
  <tr>
    <td><?=$item['title']?></td>
    <td><?=htmlspecialchars($item['descr'])?></td>
    <td><?=Format::adminDate($item['pubTime'])?></td>
    <td>
      <?=$item['publish']?>
    </td>
    <td><a href="<?=Config::ADDRESS?>admin/banners/?del=<?=$item['id']?>">Удалить</a></td>
  </tr>
<?php } ?>
</table>
