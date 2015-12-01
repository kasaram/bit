<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>

<p style = "color:#1d4bee;">Здесь будут выводиться пользователи которым необходимо перевести дениги</p>

<?php 
  //выводим сообщение об ошибке или успехе проведения операции
  if(isset($_GET['res']) && !empty($_GET['res'])){ 
    echo Message::getMsg($_GET['res']);
  } 
?>


<table border=1 cellspacing=0 cellpadding=10>
  <tr>
    <th>Биткоин</th>
    <th>Баланс</th>
    <th>Последний визит</th>
    <th>Дата регистрации</th>
    <th>Снятие</th>
  </tr>
<?php 
if(isset($listUsers)) {
		foreach ($listUsers as $item) { 
?>
	  <tr>
	    <td><?=$item['bitcoin']?></td>
	    <td><?=Format::coinFormat($item['balance'])?></td>
	    <td><?=Format::adminDate($item['lastVisit'])?></td>
	    <td><?=Format::adminDate($item['regDate'])?></td>
	    <td><a href="<?=Config::ADDRESS?>admin/users/update/<?=$item['id']?>">Снять</a></td>
	  </tr>
	<?php } 
} ?>
</table>