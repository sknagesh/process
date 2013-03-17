<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$ttype=$_GET['ttype'];
$tdia=$_GET['tdia'];
$query="SELECT * FROM Tool WHERE Tool_Type='$ttype' AND Tool_Dia='$tdia' ORDER  BY Tool_Make;";
$st="<select name=\"Tool_ID_1\" id=\"Tool_ID_1\" class=\"required\">";
$st.="<option value=\"\">Select Tool</option>";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
$st.="<option value=\"$row[Tool_ID]\">";
$st.="$row[Tool_Part_NO] - $row[Tool_Desc]</option>";
}
$st.="</select>";
echo $st;


?>