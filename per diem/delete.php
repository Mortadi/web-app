<?php

require_once 'includes/users.php';

$_SESSION['referrer'] = $_SERVER['REQUEST_URI'];

if (!user_is_signed_in()) {
  header('Location: sign-in.php');
  exit;
}

require_once 'includes/db.php';

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

header('Location: index.php');
exit;