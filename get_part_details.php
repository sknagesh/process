<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$drawingid=$_GET['drawingid'];
//print_r($_POST);
$query="SELECT * FROM Part WHERE Drawing_ID='$drawingid';";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
print('<table name="ptable" id="ptable">');
while ($row = mysql_fetch_assoc($resa))
{
	$dpath='/home/www/drawings/'.$row['Drawing_File'];
	$ppath='/home/www/drawings/'.$row['Process_Sheet'];
	print("<tr><td>Drawing</td><td><a href=\"$dpath\">$row[Drawing_File]</a></td></tr>");
	print("<tr><td>Process Sheet</td><td><a href=\"$ppath\">$row[Process_Sheet]</a></td></tr>");
}
print('</table>');


?>