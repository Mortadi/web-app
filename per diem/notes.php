<?php

require_once 'includes/db.php';


$sql = $db->query('
SELECT id, title, note, date
FROM per_diem
ORDER BY id DESC
');

$sql->execute();
$results = $sql->fetchAll();




?>
<!DOCTYPE HTML>
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

<div class="main">
 
<?php foreach ($results as $notes) : ?>


<ol><h2><?php echo $notes ['title']; ?></h2>
<h2><a href="single.php?id=<?php echo $notes['id']; ?>"><?php echo $notes['date']; ?></h2></a>
</ol>
<hr size=5 width="88%"> 
<?php endforeach; ?>
</div>
<div class="another"><a href="index.php"><button type="notes"><h2>Make another note</h2></button></a></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/general.js"></script>
</body>
</html>



                   

