<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';

echo "Здесь будет выводиться страница Bonus<br/><br/>";
echo 'Реклама слева: ';
print_r($reclameList);
echo '<br/><br/>Видео справа: ';
print_r($videoList);


require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';

require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
