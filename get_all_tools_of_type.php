<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$ttypeid=$_GET['ttypeid'];
if(isSet($_GET['tdia'])){$tdia=$_GET['tdia'];}else{$tdia="";}
//print_r($_POST);
if($ttypeid!=''&&$tdia!='')
	{
$query="SELECT Tool_Make,Tool_PArt_NO,Tool_Desc,Tool_Dia,Shank_Dia,
		Tool_Fl,Tool_Useful_Length,Tool_Corner_Rad,Tool_OAL,No_Of_Edges,
		Tool_Coating,Qty_New,Qty_Shop_New FROM Tool as t 
		INNER JOIN Tool_Qty AS tq ON tq.Tool_Qty_ID=t.Tool_ID 
		WHERE Tool_Type='$ttypeid' AND Tool_Dia='$tdia';";
	}
else
if($tdia=='')
{
	$query="SELECT Tool_Make,Tool_PArt_NO,Tool_Desc,Tool_Dia,Shank_Dia,
		Tool_Fl,Tool_Useful_Length,Tool_Corner_Rad,Tool_OAL,No_Of_Edges,
		Tool_Coating,Qty_New,Qty_Shop_New FROM Tool as t 
		INNER JOIN Tool_Qty AS tq ON tq.Tool_Qty_ID=t.Tool_ID
		 WHERE Tool_Type='$ttypeid';";
}else
	{
$query="SELECT Tool_Make,Tool_PArt_NO,Tool_Desc,Tool_Dia,Shank_Dia,
		Tool_Fl,Tool_Useful_Length,Tool_Corner_Rad,Tool_OAL,No_Of_Edges,
		Tool_Coating,Qty_New,Qty_Shop_New FROM Tool as t 
		INNER JOIN Tool_Qty AS tq ON tq.Tool_Qty_ID=t.Tool_ID
		 WHERE Tool_Type='$ttypeid' AND Tool_Dia='$tdia';";
	}
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));

print("<table cellspacing=\"1\">");
print("<tr><th>Make</th><th>Part No</th><th>Description</th><th>Diameter</th><th>Shank Dia</th>
			<th>Flute Length</th><th>Usefull LEngth</th><th>Corner Radius</th>
			<th>OAL</th><th>No of Edges</th><th>Coating</th><th>New Stock</th><th>In Use S.Floor</th></tr>");

while ($row = mysql_fetch_assoc($resa))
{
print("<tr><td>$row[Tool_Make]</td><td>$row[Tool_Part_NO]</td><td>$row[Tool_Desc]</td><td>$row[Tool_Dia]</td><td>$row[Shank_Dia]</td>
			<td>$row[Tool_FL]</td><td>$row[Tool_Useful_Length]</td><td>$row[Tool_Corner_Rad]</td>
			<td>$row[Tool_OAL]</td><td>$row[No_Of_Edges]</td><td>$row[Tool_Coating]</td><td>$row[Qty_New]</td><td>$row[Qty_Shop_New]</td></tr>");

}
print("</table>");
?>