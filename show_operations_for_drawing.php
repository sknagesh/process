<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$drawingid=$_GET['drawingid'];

$query="SELECT Operation_Desc,Clamping_Time,Machining_Time, Fixture_NO FROM Operation WHERE Drawing_ID='$drawingid';";

//print($query);

$res=mysql_query($query) or die(mysql_error());
$r=mysql_num_rows($res);
if($r!=0)
{
print("<table border=\"1\" cellspacing=\"1\">");
print("<tr><th>Operation Description</th><th>Clamping Time</th><th>Machining Time</th><th>Fixture Number</th></tr>");
while($row=mysql_fetch_assoc($res))
{

	print("<tr><td>$row[Operation_Desc]</td><td>$row[Clamping_Time]</td><td>$row[Machining_Time]</td><td>$row[Fixture_NO]</td></tr>");
	
}
print("</table>");
}
else {
	print("No Operations Added For this Drawing Yet");
}
?>