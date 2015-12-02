<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/admin.php';
?>
<div id="content">
  <div class="viewname">Пользователи</div>
  <?php 
    //выводим сообщение об ошибке или успехе проведения операции
    if(isset($_GET['res']) && !empty($_GET['res'])){ 
      echo Message::getMsg($_GET['res']);
    } 
  ?>
  <table border=1>
    <tr>
      <td>Биткоин</td>
      <td>Баланс</td>
      <td>Последний визит</td>
      <td>Дата регистрации</td>
      <td>Снятие</td>
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
</div>
</body>
</html>