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

<?php if(isset($_SESSION['bitcoin'])) { ?>
	
		<div class="title">Banners</div>
		<div class="referBanners">
	  	<img src="<?=Config::ADDRESS.Config::TEMPLATE?>images/banner_728x90.jpg" alt="banner_728x90">
	  </div>
	 	<div class="referBanners">
	  	<textarea readonly><a href="<?=Config::ADDRESS?>?ref=<?=$_SESSION['bitcoin']?>" target="_blank"><img src="<?=Config::ADDRESS.Config::TEMPLATE?>images/banner_728x90.jpg" alt="banner_728x90"></a></textarea>
	  </div>
		<div class="referBanners">
	  	<img src="<?=Config::ADDRESS.Config::TEMPLATE?>images/banner_468x60.jpg" alt="banner_468x60">
	  </div>
		<div class="referBanners">
			<textarea readonly><a href="<?=Config::ADDRESS?>?ref=<?=$_SESSION['bitcoin']?>" target="_blank"><img src="<?=Config::ADDRESS.Config::TEMPLATE?>images/banner_468x60.jpg" alt="banner_468x60"></a></textarea>
	  </div>
	  <div class="referBanners">
			<img src="<?=Config::ADDRESS.Config::TEMPLATE?>images/banner_200x200.jpg" alt="banner_200x200">
	  </div>
	  <div class="referBanners">
			<textarea readonly><a href="<?=Config::ADDRESS?>?ref=<?=$_SESSION['bitcoin']?>" target="_blank"><img src="<?=Config::ADDRESS.Config::TEMPLATE?>images/banner_200x200.jpg" alt="banner_200x200"></a></textarea>
	  </div>
	  <div class="referBanners">
			<img src="<?=Config::ADDRESS.Config::TEMPLATE?>images/banner_160x600.jpg" alt="banner_160x600">
	  </div>
	  <div class="referBanners">
			<textarea readonly><a href="<?=Config::ADDRESS?>?ref=<?=$_SESSION['bitcoin']?>" target="_blank"><img src="<?=Config::ADDRESS.Config::TEMPLATE?>images/banner_160x600.jpg" alt="banner_160x600"></a></textarea>
	  </div>
<?php } ?>
	</div>
<?php 
	require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';
	require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
?>