<?php

$a = '/tmp/sess_'.md5($_SERVER['HTTP_HOST']).'.php';
unlink($a);

?>
