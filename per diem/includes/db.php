<?php

$user = getenv('DB_USER'); 
$pass = getenv('DB_PASS'); 
$data_source = getenv('DATA_SOURCE');
$db = new PDO($data_source, $user, $pass);
$db->exec('SET NAMES utf8');