<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$query="SELECT * FROM Tool_Type;";
print("<label for=\"ttype\">Select Tool Type</label>");
print("<select name=\"Tool_Type_ID\" id=\"Tool_Type_ID\" class=\"required\">");
echo '<option value="">Select Tool Type</option>';
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
echo "<option value=".$row['Tool_Type_ID'].">";
echo "$row[Tool_Type]</option>";
}
print("</select></td></tr>");



?>