<?php

$data = $_GET['data'];
switch ($_GET['type']) {
    case 'code39':
        $type = 'code39';
        break;
    default:
        $type = 'code39';
}

$img = imagecreatetruecolor(1000, 200);
$white = imagecolorallocate($img, 255, 255, 255);
$black = imagecolorallocate($img, 0, 0, 0);
imagefill($img, 0, 0, $white);
if ($type == 'code39') {
    $data = "*" . strtoupper($data) . "*";
    //echo "$data";
    imagettftext($img, 180, 0, 30, 190, $black, "fonts/free3of9.ttf", $data);
}

header('Content-Type: image/jpeg');
imagejpeg($img);
