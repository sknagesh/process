<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$toolid=$_GET['toolid'];

$query="SELECT Qty_New,Qty_Shop,Tool_Part_NO,Tool_Desc FROM Tool_Qty as tq
INNER JOIN Tool as t ON t.Tool_ID=tq.Tool_ID WHERE t.Tool_ID='$toolid';";

//print($query);

$res=mysql_query($query) or die(mysql_error());
$r=mysql_num_rows($res);
if($r!=0)
{
print("<table border=\"0\" cellspacing=\"3\">");
print("<tr><th>Tool Part No</th><th>Tool Description</th><th>New Tools In Stock</th><th>No Of Tools In Shopfloor</th></tr>");
while($row=mysql_fetch_assoc($res))
{

print("<tr><td>$row[Tool_Part_NO]</td><td>$row[Tool_Desc]</td><td>$row[Qty_New]</td><td>$row[Qty_Shop]</td></tr>");
	
}
print("</table>");
}
else {
	print("This Tool Is Not In Stock");
}
?>