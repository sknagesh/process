<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$toolid=$_GET['toolid'];

$query="SELECT Tool_Part_NO,Tool_Desc,Screw_Part_NO,Screw_Desc,Wrench_Part_NO,Wrench_Desc FROM Screws_Wrench as scr
		INNER JOIN Tool as t ON t.Tool_ID=scr.Tool_ID WHERE scr.Tool_ID='$toolid';";

//print($query);

$res=mysql_query($query) or die(mysql_error());
$r=mysql_num_rows($res);
if($r!=0)
{
print("<table border=\"1\" cellspacing=\"1\">");
print("<tr><th>Tool Part No</th><th>Tool Description</th><th>Screw Part No</th><th>Screw Description</th><th>Key Part No</th><th>Key Description</th></tr>");
while($row=mysql_fetch_assoc($res))
{
	print("<tr><td>$row[Tool_Part_NO]</td><td>$row[Tool_Desc]</td><td>$row[Screw_Part_NO]</td><td>$row[Screw_Desc]</td><td>$row[Wrench_Part_NO]</td><td>$row[Wrench_Desc]</td></tr>");
	
}
print("</table>");
}
else {
	print("No Screws Added For this Tool");
}
?>