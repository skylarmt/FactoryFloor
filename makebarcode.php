<?php

$data = $_GET['data'];
switch ($_GET['type']) {
    case 'code39':
        $type = 'code39';
        break;
    default:
        $type = 'code39';
}

$img;
if ($type == 'code39') {
    $data = "*" . strtoupper($data) . "*";
    $img = imagecreatetruecolor(600, 600);
    imagettftext($img, 100, 0, 10, 600, imagecolorallocate($img, 0, 0, 0), "fonts/free3of9.ttf", $data);
}

header('Content-Type: image/png');
imagepng($img);