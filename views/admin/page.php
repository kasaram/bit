<?php
defined('BIT') or die;
?>

<p style = "color:#1d4bee;">Здесь будут выводиться общая страница рекламы, баннеров и видео</p>
<p>
<h3>Выводим баннеры</h3>
  <?php print_r($listBanners);?>
</p>
<p>
<h3>Выводим рекламу</h3>
  <?php print_r($listReclama);?>
</p>
<p>
  <h3>Выводим видео</h3>
  <?php print_r($listVideo);?>
</p>