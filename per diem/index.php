<?php

require_once 'includes/db.php';
require_once 'includes/users.php';

$sql = $db->query('
SELECT id, title, note, date
FROM per_diem
ORDER BY date ASC
');

/*var_dump($db->errorInfo());

$results = $sql->fetchAll();
*/
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
<div class="main">
 
<form>
 <div class="info">
<?php echo $notes['date']; ?><h4>Date:</h4><input type="text" name="date1"  class="datebox" id="date1" class="mobiscroll" readonly="readonly"></input>
<h4>Title:</h4><input type="text" class="titlebox"></input><?php echo $notes['title']; ?></div>
<!--<h4>Search:</h4><input type="text" class="searchbox"></input></div>-->
</br><textarea></textarea></br><button type="submit" class="submit"<?php echo $notes['note']; ?>>Submit</button>
<a href="single.php<?php echo $notes['id']; ?>"<button type="notes">Notes</button>></a>
</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/general.js"></script>
</body>
</html>



                   

