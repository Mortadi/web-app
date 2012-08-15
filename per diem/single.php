<?php

require_once 'includes/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$sql = $db->prepare('
SELECT title, note, date
FROM per_diem
WHERE id = :id
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$results = $sql->fetch();


?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Per Diem</title>
<link href="css/style.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Simonetta' rel='stylesheet' type='text/css'>
<link rel="stylesheet"  href="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.css" />
  <script src="js/mobiscroll-1.5.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
  <link href="css/mobiscroll-1.5.css" rel="stylesheet" type="text/css" />
</head>

<body>
<header>
<h1>Per Diem,</h1>
<h2>Your Fluent Journal</h2>
</header>
<body>

<div class="main"><div class="singlebody">
<h1><?php echo $results['title']; ?> </h1>
<h1><?php echo $results['date']; ?></h1>
<h2><?php echo $results['note']; ?></h2>
<button id="deleteButton">Delete</button>
<a href="edit.php?id=<?php echo $id; ?>"><button>Edit</button></a>
<a href="notes.php"><button>Notes</button></a>
<div id="dialogBox">
	<p>Are you sure?</p>
    <a href="delete.php?id=<?php echo $id; ?>"><button id="yesButton">Yes</button></a>
    <button id="cancelButton">Cancel</button>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/general.js"></script>
</body>
</html>



