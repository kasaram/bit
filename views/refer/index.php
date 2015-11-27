<?php
defined('BIT') or die;
require_once ROOT.'/'.Config::VIEW.'layouts/header.php';

echo 'Это представление страницы реферала реализующей ReferController<br>';
echo 'Сумма коммисии за реферала составляет: '.Config::REF_COMMISSION.' %<br>';

require_once ROOT.'/'.Config::VIEW.'layouts/middle.php';

require_once ROOT.'/'.Config::VIEW.'layouts/footer.php';
