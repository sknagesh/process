<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$query="SELECT * FROM Supplier;";

print("<select name=\"Supplier_ID\" id=\"Supplier_ID\" class=\"required\">");
echo '<option value="">Select Tool Supplier</option>';
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
echo "<option value=".$row['Supplier_ID'].">";
echo "$row[Supplier_Name]</option>";
}
print("</select></td></tr>");



?>