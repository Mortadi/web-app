<?php

$user = getenv('MYSQL_USERNAME'); 
$pass = getenv('MYSQL_PASSWORD'); 
$host = getenv('MYSQL_DB_HOST');
$name = getenv('MYSQL_DB_NAME');

$data_source = sprintf('mysql:host=%s;dbname=%s', $host, $name);
$db = new PDO($data_source, $user, $pass);
$db->exec('SET NAMES utf8'); 