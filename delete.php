<?php

require_once 'includes/db.php';

$_SESSION['referrer'] = $_SERVER['REQUEST_URI'];




$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
header('Location: index.php');
exit;
}

$sql = $db->prepare('

DELETE FROM per_diem
WHERE id = :id

');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();

header('Location: notes.php');
exit;