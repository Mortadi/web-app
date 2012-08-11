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
$dino_name = filter_input(INPUT_POST, 'dino_name', FILTER_SANITIZE_STRING);
$loves_meat = filter_input(INPUT_POST, 'loves_meat', FILTER_SANITIZE_NUMBER_INT);
$in_jurassic_park = (isset($_POST['in_jurassic_park'])) ? 1 : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (strlen($dino_name) < 1 || strlen($dino_name) > 256) {
$errors['dino_name'] = true;
}

if (!in_array($loves_meat, array(0, 1))) {
$errors['loves_meat'] = true;
}

if (empty($errors)) {
$sql = $db->prepare('
UPDATE dinosaurs
SET dino_name = :dino_name
, loves_meat = :loves_meat
, in_jurassic_park = :in_jurassic_park
WHERE id = :id
');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->bindValue(':dino_name', $dino_name, PDO::PARAM_STR);
$sql->bindValue(':loves_meat', $loves_meat, PDO::PARAM_INT);
$sql->bindValue(':in_jurassic_park', $in_jurassic_park, PDO::PARAM_INT);
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
 <input type="text" name="date1" id="date1" class="mobiscroll" readonly="readonly" value="12/08/2010" />
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

