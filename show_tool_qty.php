<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$toolid=$_GET['toolid'];

$query="SELECT Qty_New,Qty_Resharp,Qty_Shop_New,Qty_Shop_Resharp,Qty_Tool_Tray,Tool_Part_NO,Tool_Desc FROM Tool_Qty as tq
INNER JOIN Tool as t ON t.Tool_ID=tq.Tool_ID WHERE t.Tool_ID='$toolid';";

//print($query);

$res=mysql_query($query) or die(mysql_error());
$r=mysql_num_rows($res);
if($r!=0)
{
print("<table border=\"1\" cellspacing=\"3\">");
print("<tr><th>Tool Part No</th><th>Tool Description</th><th>New Tools In Stock</th><th>Resharpened Tools In Stock</th><th>New Tools In Shopfloor</th><th>Resharpened Tools In Shopfloor</th><th>Tools In Tool Tray</th></tr>");
while($row=mysql_fetch_assoc($res))
{

print("<tr><td>$row[Tool_Part_NO]</td><td>$row[Tool_Desc]</td><td>$row[Qty_New]</td><td>$row[Qty_Resharp]</td><td>$row[Qty_Shop_New]</td><td>$row[Qty_Shop_Resharp]</td><td>$row[Qty_Tool_Tray]</td></tr>");
	
}
print("</table>");
}
else {
	print("This Tool Is Not In Stock");
}
?>