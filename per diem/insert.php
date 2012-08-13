<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  
 mysql_select_db("elmo0008", $con);
 
 $sql="INSERT INTO list_of_movies (title, genre, directed_by, release_date, starring)
VALUES
('$_POST[title]','$_POST[genre]','$_POST[directed_by]', '$_POST[release_date]', '$_POST[starring]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
echo "A record added";

mysql_close($con);
?>
