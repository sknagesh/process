<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$ttypeid=$_GET['ttypeid'];
if(isSet($_GET['tdia'])){$tdia=$_GET['tdia'];}else{$tdia="";}
//print_r($_POST);
if($tdia=='')
{
	$query="SELECT * FROM Tool WHERE Tool_Type='$ttypeid';";
}else
	{
$query="SELECT * FROM Tool WHERE Tool_Type='$ttypeid' AND Tool_Dia='$tdia';";
	}
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));

print("<table cellspacing=\"1\">");
print("<tr><th>Make</th><th>Part No</th><th>Description</th><th>Diameter</th><th>Shank Dia</th>
			<th>Flute Length</th><th>Usefull LEngth</th><th>Corner Radius</th>
			<th>OAL</th><th>No of Edges</th><th>Coating</th></tr>");

while ($row = mysql_fetch_assoc($resa))
{
print("<tr><td>$row[Tool_Make]</td><td>$row[Tool_Part_NO]</td><td>$row[Tool_Desc]</td><td>$row[Tool_Dia]</td><td>$row[Shank_Dia]</td>
			<td>$row[Tool_FL]</td><td>$row[Tool_Useful_Length]</td><td>$row[Tool_Corner_Rad]</td>
			<td>$row[Tool_OAL]</td><td>$row[No_Of_Edges]</td><td>$row[Tool_Coating]</td></tr>");

}
print("</table>");
?>