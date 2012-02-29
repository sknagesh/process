
<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$toolid=$_GET['toolid'];
$query="SELECT * FROM Tool WHERE Tool_ID='$toolid';";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
$row = mysql_fetch_assoc($resa);

$tdia=$row['Tool_Dia'];
$tfl=$row['Tool_FL'];
$tshankdia=$row['Shank_Dia'];
$tcornerrad=$row['Tool_Corner_Rad'];

print("<table><tr><th>Tool Dia</th><th>Shank Dia</th><th>Flute Length</th><th>Corner Radius</th></tr>");
print("<tr><td>$tdia</td><td>$tshankdia</td><td>$tfl</td><td>$tcornerrad</td></tr></table>");

?>