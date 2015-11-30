<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>

<p style = "color:#1d4bee;">Здесь будут выводиться пользователи которым необходимо перевести дениги</p>

<?php 
  $msg = ['sucUpd'=>'Успешно произведена операция по обнулению баланса!'];
  $err = ['failUpd'=>'обнулить баланс!'];
  $style = 'display:none;';
  if (isset($_GET) && !empty($_GET)) {
    $get = array_keys($_GET)[0];
    if (key_exists($get, $msg)) {
      $style = 'color:#5cd212;';
      $text = $msg[$get];
    } else if (key_exists($get, $err)) { 
      $style = 'color:#d21212;';
      $text = 'Произошла ошибка, не удалось '.$err[$get];
    } 
  } 
?>
<p style="<?=$style?>"><?=$text?></p>

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