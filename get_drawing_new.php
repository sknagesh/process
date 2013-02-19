<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$custid=$_GET['custid'];
//print_r($_POST);
$query="SELECT * FROM Part WHERE Customer_ID='$custid';";
print("<label for=\"draw\">Select Drawing</label>");

print("<table border=\"1\" ><col width=\"100\"><tr>");
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
$n=1;
$m=5;
while ($row = mysql_fetch_assoc($resa))
{
		if($n>$m){
			print("</tr><tr>");
			$m+=5;
			}
	print("<td height=\"100\">$row[Drawing_NO] - $row[Component_Name]</td>");
	$n++;
}
print("</tr></table>");



?>