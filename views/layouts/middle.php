<?php
	defined('BIT') or die;
?>
<div class="content">
  <div id="advertisments">
  	<?php foreach($listBanners as $item) { ?>
			<div><?=htmlspecialchars_decode($item['descr'])?></div>
  	<?php } ?>
  </div>
</div>