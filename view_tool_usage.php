<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$tid=$_GET['tid'];

$query="SELECT ot.Operation_ID, Tool_Dia, Tool_Fl, Tool_OAL,Tool_ID_1, Drawing_NO, Component_Name, Operation_Desc,Ope_Tool_Desc
				FROM Ope_Tools AS ot  
				INNER JOIN Tool as t ON t.Tool_ID=ot.Tool_ID_1
				INNER JOIN Operation as ope ON ope.Operation_ID=ot.Operation_ID
				INNER JOIN Part as p ON p.Drawing_ID=ope.Drawing_ID
				WHERE ot.Tool_ID_1='$tid';";

//print($query);

$res=mysql_query($query) or die(mysql_error());
$row=mysql_fetch_assoc($res);
$tdia=$row['Tool_Dia'];
$tfl=$row['Tool_Fl'];
$toal=$row['Tool_OAL'];


$res=mysql_query($query) or die(mysql_error());
$r=mysql_num_rows($res);

if($r!=0)
{
	print("Tool Dia=$tdia Flute Length=$tfl OAL=$toal<br><br>");
	print("This Tool is used in $r Operations<br><br>");
print("<table border=\"1\" cellspacing=\"1\" bgcolor=\"#7FFFD4\">");
print("<tr><th>Drawing No and Name</th><th>Operation Desc</th><th>Work Description</th></tr>");
while($row=mysql_fetch_assoc($res))
{

	print("<tr><td>$row[Drawing_NO] - $row[Component_Name]</td>
				<td>$row[Operation_Desc]</td>
				<td>$row[Ope_Tool_Desc]</td></tr>");
	
}
print("</table>");
}
else {
	print("This Tool is Currently Not in Use");
}
?>