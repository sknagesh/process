<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$opid=$_GET['opid'];

$qop="SELECT * FROM Operation WHERE Operation_ID='$opid';";
$r=mysql_query($qop) or die(mysql_error());
$rope=mysql_fetch_assoc($r);

$ctime=$rope['Clamping_Time'];
$mtime=$rope['Machining_Time'];
$fno=$rope['Fixture_NO'];

print("<br><label>Fixture No:</label>$fno");
print("<br><label>Clamping Time:</label>$ctime");
print("<br><label>Machining Time:</label>$mtime");

$query="SELECT Ope_Tool_ID,Tool_Part_NO,Tool_Desc,Ope_Insert_ID,Insert_Part_NO,Insert_Desc,Tool_Dia,Tool_ID_1,Ope_Tool_OH,Ope_Tool_Desc,Holder_Desc FROM Ope_Tools AS ot 
INNER JOIN Tool as t ON t.Tool_ID=ot.Tool_ID_1 
left OUTER JOIN Inserts AS inse ON inse.Insert_ID=ot.Ope_Insert_ID
INNER JOIN Holder AS h ON h.Holder_ID=ot.Holder_ID
WHERE ot.Operation_ID='$opid';";


/*
$query="SELECT Ope_Tool_ID,Tool_Part_NO,Tool_Desc,Ope_Insert_ID,Insert_Part_NO,Insert_Desc,Tool_Dia,Tool_ID_1,Ope_Tool_OH,Ope_Tool_Desc,Holder_Desc FROM Ope_Tools AS ot  
				INNER JOIN Tool as t ON t.Tool_ID=ot.Tool_ID_1
				INNER JOIN Holder AS h ON h.Holder_ID=ot.Holder_ID
				INNER JOIN Inserts AS inse ON inse.Tool_ID=t.Tool_ID
				WHERE ot.Operation_ID='$opid';";

print($query);
*/
$res=mysql_query($query) or die(mysql_error());
$r=mysql_num_rows($res);
if($r!=0)
{
print("<table border=\"1\" cellspacing=\"1\" >");
print("<tr><th>Tool Info</th><th>Preferred Tool</th><th>Description</th><th>Insert</th><th>Holder</th><th>Tool Overhang</th></tr>");
while($row=mysql_fetch_assoc($res))
{

	print("<tr><td><input type=\"radio\" name=\"tinfo\" id=\"tinfo\" value=\"$row[Tool_ID_1]\"></input>
	</td><td>$row[Tool_Part_NO] $row[Tool_Desc]</td><td>$row[Ope_Tool_Desc]</td>
	<td>$row[Insert_Part_NO] - $row[Insert_Desc]</td>
	<td>$row[Holder_Desc]</td><td>$row[Ope_Tool_OH]</td></tr>");
	
}
print("</table>");
}
else {
	print("No Tools Added For this Drawing Yet");
}
?>