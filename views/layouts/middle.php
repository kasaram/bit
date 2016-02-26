<?php
	defined('BIT') or die;
?>
<div class="content">
	<div class="gameadtop"><?=$listBanners['728x90'][0]?></div>
	<div class="gameadtop"><?=$listBanners['728x90'][1]?></div>
	<div class="gameadtop"><?=$listBanners['728x90'][2]?></div>
	<div class="ad46860">
    <div><?=$listBanners['468x60'][4]?></div>
    <div><?=$listBanners['468x60'][5]?></div>
  </div>
  <div class="ad46860">
    <div><?=$listBanners['468x60'][6]?></div>
    <div><?=$listBanners['468x60'][7]?></div>
  </div>
  <div id="advertisments">
  	<?php 
  		$countBanners = Config::NUM_BANNERS > count($listBanners['300x250']) ? count($listBanners['300x250']) : Config::NUM_BANNERS;
  		for($i=0; $i < $countBanners; $i++) { ?>
				<div><?=$listBanners['300x250'][$i]?></div>
  	<?php } ?>
  </div>
</div>