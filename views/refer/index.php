<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';
?>

<div class="content">
	<?php require_once ROOT.'/'.Config::VIEW.'layouts/banner.php';?>
	<div class="title">Refer</div>
	<div class="static">
		<p class="size18">REFERRAL COMISSION <?=Config::REF_COMMISSION?>% !!!</p>
		<?php if(isset($_SESSION['bitcoin'])) { ?>
			<p class="size18">My referral link: <?=Config::ADDRESS?>?ref=<?=$_SESSION['bitcoin']?></p>
		<?php } ?>
		<p class="size18">Referrals number: <?=$refNum?></p>
		<p class="size18">Referrals earnings: <?=$refBonus.' '.Config::COIN?></p>
	</div>
</div>

<?php 
	require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
	require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
?>