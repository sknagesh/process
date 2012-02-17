<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$ttype=$_GET['ttype'];
$tdia=$_GET['tdia'];
//print_r($_POST);
$query="SELECT * FROM Tool WHERE Tool_Type='$ttype' AND Tool_Dia='$tdia';";
$st="Select Tool";
$st.="<select name=\"Tool_ID\" id=\"Tool_ID\" class=\"required\">";
$st.="<option value=\"\">Select Tool</option>";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
$st.="<option value=\"$row[Tool_ID]\">";
$st.="$row[Tool_Part_NO] - $row[Tool_Desc]</option>";
}
$st.="</select>";

$query="SELECT * FROM Holder;";
$st.="       Select Holder";
$st.="<select name=\"Holder_ID\" id=\"Holder_ID\" class=\"required\">";
$st.="<option value=\"\">Select Holder</option>";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while ($row = mysql_fetch_assoc($resa))
{
$st.="<option value=\"$row[Holder_ID]\">";
$st.="$row[Holder_Desc]</option>";
}
$st.="</select>";
$st.="       Tool Description";
$st.="<input type=\"text\" name=\"tdesc\" id=\"tdesc\" class=\"required\">";
$st.="       Tool Over Hang";
$st.="<input type=\"text\" name=\"toh\" id=\"toh\" size=\"5\" class=\"number\">";

echo $st;


?>