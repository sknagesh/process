<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$drawingid=$_GET['drawingid'];
//print_r($_POST);
$q="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(Clamping_Time))) as clt,SEC_TO_TIME(SUM(TIME_TO_SEC(Machining_Time))) as mt FROM Operation WHERE Drawing_ID='$drawingid';";
$r = mysql_query($q, $cxn) or die(mysql_error($cxn));
while($rr=mysql_fetch_assoc($r))
{
$cltime=$rr['clt'];
$mctime=$rr['mt'];
}
$query="SELECT * FROM Part WHERE Drawing_ID='$drawingid';";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
print('<table name="ptable" id="ptable">');
while ($row = mysql_fetch_assoc($resa))
{
	$dpath='/drawings/'.$row['Drawing_File'];
	$ppath='/drawings/'.$row['Process_Sheet'];
	$pinpath='/drawings/'.$row['Gage_List'];
	print("<tr><td><label>Drawing</label></td><td height=\"35\"><a href=\"$dpath\" target=\"_NEW\">$row[Drawing_File] </a></td></tr>");
	print("<tr><td><label>Process Sheet</label></td><td height=\"35\"><a href=\"$ppath\" target=\"_NEW\">$row[Process_Sheet]</a></td></tr>");
	print("<tr><td><label>Pin and Gage List</label></td><td height=\"35\"><a href=\"$pinpath\" target=\"_NEW\">$row[Gage_List]</a></td></tr>");
	print("<tr><td><label>Total Clamping Time and Machining Time (h:m:s)</label></td><td height=\"35\">$cltime and $mctime</td></tr>");
	print("<tr><td><label>Cut Blank size</label></td><td height=\"35\">$row[Cut_Blank]</td></tr>");
	print("<tr><td><label>Pre Machined Blank size</label></td><td height=\"10\">$row[Pre_Machined_Blank]</td></tr>");

}
print('</table>');




?>