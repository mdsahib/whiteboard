<?php

$fp=fopen('database.csv','a');
$_POST['text']=substr($_POST['text'],0,150);
fputcsv($fp,$_POST);

fclose($fp);
