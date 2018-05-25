<?php
session_start();
$captcha_num = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$captcha_num = substr(str_shuffle($captcha_num), 0, 4);
$_SESSION["code"] = $captcha_num;

$font_size = 30;
$img_width = 140;
$img_height = 32;

header('Content-type: image/jpeg');

$image = imagecreate($img_width, $img_height);
imagecolorallocate($image, 0, 0, 0);

$text_color = imagecolorallocate($image, 255, 255, 255);

imagettftext($image, $font_size, 0, 15, 30, $text_color, 'arial', $captcha_num);
imagejpeg($image);
?>
