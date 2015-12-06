<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';
?>

<p>Это представление страницы реферала реализующей ReferController</p>
<h2>Referral comission <?=Config::REF_COMMISSION?>% !!!</h2>
<?php if(isset($_SESSION['bitcoin'])) { ?>
	<h3>My referral link</h3>
	<p><?=Config::ADDRESS?>?ref=<?=$_SESSION['bitcoin']?></p>
<?php } ?>
<h3>REFERRALS NUMBER: <?=$refNum?></h3>
<h3>REFERRALS EARNINGS: <?=$refBonus.' '.Config::COIN?></h3>



<?php 
	require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
	require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
?>