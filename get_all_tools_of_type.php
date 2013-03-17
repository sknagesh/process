<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
//print_r($_GET);
if(isSet($_GET['ttypeid'])){$ttypeid=$_GET['ttypeid'];}else{$ttypeid="";}
if(isSet($_GET['tdia'])){$tdia=$_GET['tdia'];}else{$tdia="";}
if(isSet($_GET['crnr'])){$crnr=$_GET['crnr'];}else{$crnr="";}
if(isSet($_GET['fl'])){$fl=$_GET['fl'];}else{$fl="";}

if($crnr!='')
{
	$crnr=" AND Tool_Corner_Rad='$crnr' ";
}

if($ttypeid!='')
{
	$ttypeid=" AND Tool_Type='$ttypeid' ";
}


if($tdia!='')
{
	$tdia=" AND Tool_Dia='$tdia' ";
}

if($fl!='')
{
	$fl=" AND Tool_Fl>='$fl' ";
}


$query="SELECT Tool_Make,Tool_Part_NO,Tool_Desc,Tool_Dia,Shank_Dia,
		Tool_Fl,Tool_Useful_Length,Tool_Corner_Rad,Tool_OAL,No_Of_Edges,
		Tool_Coating,Qty_New,Qty_Shop_New FROM Tool as t 
		LEFT OUTER JOIN Tool_Qty AS tq ON tq.Tool_ID=t.Tool_ID 
		WHERE Tool_Dia>0 $ttypeid $tdia $crnr $fl;";



//print($query);
  
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));

print("<table cellspacing=\"1\">");
print("<tr><th>Make</th><th>Part No</th><th>Description</th><th>Diameter</th><th>Shank Dia</th>
			<th>Flute Length</th><th>Usefull LEngth</th><th>Corner Radius</th>
			<th>OAL</th><th>No of Edges</th><th>Coating</th><th>New Stock</th><th>In Use S.Floor</th></tr>");

while ($row = mysql_fetch_assoc($resa))
{
print("<tr><td>$row[Tool_Make]</td><td>$row[Tool_Part_NO]</td><td>$row[Tool_Desc]</td>
			<td align=\"center\">$row[Tool_Dia]</td>
			<td align=\"center\">$row[Shank_Dia]</td>
			<td align=\"center\">$row[Tool_Fl]</td>
			<td align=\"center\">$row[Tool_Useful_Length]</td>
			<td align=\"center\">$row[Tool_Corner_Rad]</td>
			<td align=\"center\">$row[Tool_OAL]</td>
			<td align=\"center\">$row[No_Of_Edges]</td>
			<td align=\"center\">$row[Tool_Coating]</td>
			<td align=\"center\">$row[Qty_New]</td>
			<td align=\"center\">$row[Qty_Shop_New]</td></tr>");

}
print("</table>");
?>