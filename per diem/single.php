<?php

require_once 'includes/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$sql = $db->prepare('
SELECT id, title, note, date
FROM per_diem
ORDER BY date ASC
');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$results = $sql->fetch();

?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
</head>

<body>
<h1><?php echo $results['title']; ?> </h1>
<h1><?php echo $results['date']; ?></h1>
<h2><?php echo $results['note']; ?></h2>
<a href="delete.php?id=<?php echo $id; ?>">Delete</a>
<a href="edit.php?id=<?php echo $id; ?>">Edit</a>

</body>
</html>



