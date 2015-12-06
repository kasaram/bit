<?php
	defined('BIT') or die;
	require_once ROOT.'/'.Config::VIEW.'layouts/header.php';

	echo "Здесь будет выводиться страница Bonus<br/><br/>";
?>
<h3>Реклама слева:</h3>
<p>click on the banner and benefit from <?=Config::AMOUNT_BONUS_1?> to <?=Config::AMOUNT_BONUS_2?> <?=Config::COIN?></p>
<?php foreach ($reclameList as $item) { ?>
	<p><?=htmlspecialchars($item['descr'])?></p>
<?php } ?>


<h3>Видео справа:</h3>
<?php foreach ($videoList as $item) { ?>
	<p><?=htmlspecialchars($item['descr'])?></p>
<?php } ?>

<table border=1 cellspacing="0" cellpadding="10">
	<tr>
		<td>1400 <?=Config::COIN?></td>
		<td><a href="#">START</a></td>
		<td><a href="#clickToClaim">PICK UP</a></td>
	</tr>
</table>

<p> <a id="clickToClaim" href="<?=Config::ADDRESS?>claim">CLICK TO CLAIM</a></p>

<?php 
	require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
	require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
?>