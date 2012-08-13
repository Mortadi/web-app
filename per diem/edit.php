<?php

require_once 'includes/users.php';

$_SESSION['referrer'] = $_SERVER['REQUEST_URI'];

if (!user_is_signed_in()) {
header('Location: sign-in.php');
exit;
}

require_once 'includes/db.php';

$errors = array();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
$note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (strlen($title) < 1 || strlen($title) > 60) {
		$errors['title'] = true;
	}
	
	if (empty($date)) {
		$errors['date'] = true;
	}
	if (strlen($note) < 1 || strlen($note) > 1000) {
		$errors['note'] = true;
	}
if (empty($errors)){
	

		
		$sql = $db->prepare('
		
		UPDATE per_diem SET title=:title, date=:date, note=:note
		WHERE id = :id

');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->bindValue(':title', $title, PDO::PARAM_STR);
$sql->bindValue(':date', $date, PDO::PARAM_STR);
$sql->bindValue(':note', $note, PDO::PARAM_STR);
$sql->execute();

header('Location: index.php');
exit;
}
} else {
$sql = $db->prepare('
SELECT id, title, note, date
FROM per_diem
WHERE id = :id
');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$results = $sql->fetch();

$title = $results['title'];
$date = $results['date'];
$note = $results['note'];
}

?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Edit Notes</title>
</head>
<body>

<?php if (user_is_signed_in()) : ?>
<a href="sign-out.php">Sign Out</a>
<?php endif; ?>

<h1>Edit Notes</h1>

<form method="post" action="edit.php?id=<?php echo $id; ?>">

<div>
<label for="title">
Title
<?php if (isset($errors['title'])) : ?>
<strong class="error">is required</strong>
<?php endif; ?>
</label>
<input id="title" name="title" required value="<?php echo $title; ?>">
</div>

<fieldset>
<legend>
Date
<?php if (isset($errors['date'])) : ?>
<strong class="error">is required</strong>
<?php endif; ?>
</legend>
 <input type="text" name="date1" id="date1" class="mobiscroll" readonly value="12/08/2010" />
</fieldset>

<div>
</br><label for="note">Note</label><?php echo $notes['note']; ?><textarea></textarea></br>
<a href="single.php=<?php echo $notes['id']; ?>"><button type="notes">Notes</button></a>
<?php if (isset($errors['note'])) : ?>
<?php endif; ?>
</div>

<button type="submit">Save</button>

</form>

</body>
</html>

