<?php
session_start();
//var_dump($_SESSION['name']);
$sert = imagecreatetruecolor(400, 200);
$backColor = imagecolorallocate($sert, 255, 255, 230);
$textColor = imagecolorallocate($sert, 175, 25, 23);
$image = 'sert.png';
if (!file_exists($image)) {
	echo 'Файл не найден';
	exit;

}
$imImage = imagecreatefrompng($image);
$fontFile = __DIR__ . '/arial.ttf';
$text = 'Вы правильно ответили на все вопросы этого теста!!!';
imagefill($sert, 0, 0, $backColor);
imagecopy($sert, $imImage, 0, 0, 0, 0, 400, 200);
imagettftext($sert, 20, 0, 140, 70, $textColor, $fontFile, $_SESSION['name']); 
imagettftext($sert, 10, 0, 40, 110, $textColor, $fontFile, $text); 
header("Content-type: image/png");
imagepng($sert);



?>
