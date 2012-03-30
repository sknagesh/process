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
	$dpath='/drawings/'.$row['Drawing_File'];
	$ppath='/drawings/'.$row['Process_Sheet'];
	$pinpath='/drawings/'.$row['Gage_List'];
	print("<tr><td><label>Drawing</label></td><td height=\"35\"><a href=\"$dpath\">$row[Drawing_File]</a></td></tr>");
	print("<tr><td><label>Process Sheet</label></td><td height=\"35\"><a href=\"$ppath\">$row[Process_Sheet]</a></td></tr>");
	print("<tr><td><label>Pin and Gage List</label></td><td height=\"35\"><a href=\"$pinpath\">$row[Gage_List]</a></td></tr>");
	print("<tr><td><label>Cut Blank size</label></td><td height=\"35\">$row[Cut_Blank]</td></tr>");
	print("<tr><td><label>Pre Machined Blank size</label></td><td height=\"10\">$row[Pre_Machined_Blank]</td></tr>");

}
print('</table>');




?>