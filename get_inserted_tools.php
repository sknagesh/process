<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$query="SELECT Tool_ID,Tool_Part_NO,Tool_Desc,t.Tool_Type,tt.Tool_Type FROM Tool as t JOIN Tool_Type AS tt ON tt.Tool_Type_ID=t.Tool_Type
				 WHERE tt.Tool_Type LIKE 'Inse%' ;";
//print($query);
print("<select name=\"Tool_ID\" id=\"Tool_ID\" class=\"required\">");
echo '<option value="">Select Tool Body</option>';
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
echo "<option value=".$row['Tool_ID'].">";
echo "$row[Tool_Part_NO] - $row[Tool_Desc]</option>";
}
print("</select>");



?>