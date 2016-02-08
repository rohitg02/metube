<?
$con = mysql_connect("mysql1.cs.clemson.edu","abader4620","projFor4620");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("abader4620", $con);
?>
