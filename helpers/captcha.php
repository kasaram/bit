<?php
	$im = imageCreateTrueColor(110, 30);
	$color = imageColorAllocate($im, 255,198,0);
	imageAntiAlias($im, true);
	imageFill($im, 10, 10, $color);
	//добавлеяем фоновые точки на картинке
	$color = imageColorAllocateAlpha($im, 116, 187, 15, 50);
	for($i = 0; $i < 800; $i++){
		$randW = mt_rand(0, imageSX($im));
		$randH = mt_rand(0, imageSY($im));
		imageSetPixel($im, $randW, $randH, $color);
	}
	//создаем массив значений букв и цыфр для капчи
	$color = imageColorAllocate($im, 255, 255, 255);
	$letters = array_merge(range('A', 'Z'), range(0, 9));
	//составляем и удаляем лишние символы, которые приводят к путанице
	$delLetters = ['O', 'I', 'J', 7, '0', 'Q', '5', 'S'];
	for ($i=0; $i<count($delLetters); $i++) {
		unset($letters[array_search($delLetters[$i], $letters)]);
	}
	//перемешиваем массив и выбираем срез
	shuffle($letters);
	$sliceLetters = array_slice($letters, 0, 5);
	//устанавливаем настройки для отображения символов и выводим текст 
	$deg = [10, -10, 15, 0, -20];
	$rands = [mt_rand(0,7), mt_rand(0,9), mt_rand(8,15), mt_rand(0,9), mt_rand(16,23)];
	$opts = [mt_rand(2,8), mt_rand(22, 26), mt_rand(46,50), mt_rand(70, 72), mt_rand(86, 88)];
	for ($i = 0; $i<count($sliceLetters); $i++) {
		$letter = $sliceLetters[$i];
		$str .= $letter;
		imagettftext($im, 16, $deg[$i], $opts[$i], mt_rand(18,26), $color, "../template/font/OpenSans-Regular-webfont.ttf", $letter);
	}
	//создаем сессию для капчи
	if(session_status() !== PHP_SESSION_ACTIVE) session_start();
	$_SESSION['captcha'] = $str;
	//отправляем заголовки и уничтожаем изображение
	header("Content-type: image/jpeg");
	header('Cache-Control: no-store; max-age=0');
	imageJpeg($im);
	imageDestroy($im);