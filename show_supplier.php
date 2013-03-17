<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$query="SELECT * FROM Supplier;";

//print($query);

$res=mysql_query($query) or die(mysql_error());
print("<table border=\"1\" cellspacing=\"1\">");
print("<tr><th>Name</th><th>Contact Person]</th><th>Phone No</th><th>Brands</th></tr>");
while($row=mysql_fetch_assoc($res))
{
	print("<tr><td>$row[Supplier_Name]</td><td>$row[Contact_Name]</td><td>$row[Supplier_Phone]</td><td>$row[Supplier_Brands]</td></tr>");
	
}
print("</table>");
?>