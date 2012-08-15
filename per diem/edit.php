<?php

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
			
			UPDATE per_diem 
			SET title = :title, date = :date, note = :note
			WHERE id = :id
	
		');
		$sql->bindValue(':id', $id, PDO::PARAM_INT);
		$sql->bindValue(':title', $title, PDO::PARAM_STR);
		$sql->bindValue(':date', $date, PDO::PARAM_STR);
		$sql->bindValue(':note', $note, PDO::PARAM_STR);
		$sql->execute();
	
		header('Location: notes.php');
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
<title>Per Diem</title>
<link href="css/style.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Simonetta' rel='stylesheet' type='text/css'>
<link rel="stylesheet"  href="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.css" />
  <script src="js/mobiscroll-1.5.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
  <link href="css/mobiscroll-1.5.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
        $(document).ready(function () {
            $('#date1').scroller();
            wheels = [];
            
            for (var i = 0; i < 60; i++) {
               /* if (i < 16) wheels[0]['Hours'][i] = (i < 10) ? ('0' + i) : i;
                wheels[1]['Minutes'][i] = (i < 10) ? ('0' + i) : i;*/
            }
            $('#custom').scroller({
                width: 90,
                wheels: wheels,
                showOnFocus: false,
                formatResult: function (d) {
                    return ((d[0] - 0) + ((d[1] - 0) / 60)).toFixed(1);
                },
                parseValue: function (s) {
                    var d = s.split('.');
                    d[0] = d[0] - 0;
                    d[1] = d[1] ? ((('0.' + d[1]) - 0) * 60) : 0;
                    return d;
                }
            });
            $('#custom').click(function() { $(this).scroller('show'); });
            $('#disable').click(function() {
                if ($('#date1').scroller('isDisabled')) {
                    $('#date2').scroller('enable');
                    $(this).text('Disable');
                }
                else {
                  
                    $(this).text('Enable');
                }
                return false;
            });

           

            $('#set').click(function() {
                $('#date1').scroller('setDate', new Date(), true);
                return false;
            });

            $('#theme, #mode').change(function() {
                var t = $('#theme').val();
                var m = $('#mode').val();
                $('#date1').scroller('destroy').scroller({ theme: t, mode: m });
               
            });
        });
    </script>
</head>

<body>
<div class="main">
<h1>Edit Notes</h1>

<form method="post" action="edit.php?id=<?php echo $id; ?>">

<label for="date"><h4>Date:</h4>
  <?php if (isset($errors['date'])) : ?>
  <strong class="error">is required.</strong>
  <?php endif; ?>
</label>
<input type="text" name="date"  class="datebox" id="date1" class="mobiscroll" readonly="readonly" value="<?php echo $date; ?>"></input>
            
            
<label for="title"><h4>Title:</h4>
  <?php if (isset($errors['title'])) : ?>
  <strong class="error">is required.</strong>
  <?php endif; ?>
</label>
<input name="title" type="text" class="titlebox" value="<?php echo $title; ?>"></input>



<label for="note">
            	
            </label>
        	</br><textarea name="note" ><?php echo $note; ?></textarea></br>
<button type="submit">Save</button>

</form>

</body>
</html>
