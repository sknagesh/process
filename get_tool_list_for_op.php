<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$opid=$_GET['opid'];

$query="SELECT Ope_Tool_ID,Tool_Part_NO,Tool_Desc,Tool_Dia,Ope_Tool_Desc,Ope_Tool_OH,Holder_Desc FROM Ope_Tools AS ot  
				INNER JOIN Tool as t ON t.Tool_ID=ot.Tool_ID_1
				INNER JOIN Holder AS h ON h.Holder_ID=ot.Holder_ID
				WHERE ot.Operation_ID='$opid';";

//print($query);

$res=mysql_query($query) or die(mysql_error());
$r=mysql_num_rows($res);
if($r!=0)
{
print("<table border=\"1\" cellspacing=\"1\" bgcolor=\"#7FFFD4\">");
print("<tr><th>Delete?</th><th>Preferred Tool</th><th>Description</th><th>Holder</th><th>Tool Overhang</th></tr>");
$i=0;
while($row=mysql_fetch_assoc($res))
{

	print("<tr><td><input type=\"checkbox\" name=\"del[$i]\" id=\"del[$i]\" value=\"$row[Ope_Tool_ID]\"></td>
	<td>$row[Tool_Part_NO] $row[Tool_Desc]</td><td>$row[Ope_Tool_Desc]</td><td>$row[Holder_Desc]</td><td>$row[Ope_Tool_OH]</td></tr>");
	$i++;
}
print("</table>");
}
else {
	print("No Tools Added For this Operation Yet");
}
?>