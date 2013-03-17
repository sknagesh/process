
<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$toolid=$_GET['tid'];
$query="SELECT * FROM Tool WHERE Tool_ID='$toolid';";

$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
while($row = mysql_fetch_assoc($resa))
{
print("<p><label for=\"supplier\">Supplier's Name</label>");
	 $q="select * from Supplier;";
	$r = mysql_query($q, $cxn) or die(mysql_error($cxn));
print("<select name=\"Supplier_ID\" id=\"Supplier_ID\" class=\"required\">");
print("<option value=\"\" >Select Tool Supplier</option>");
	while($ro = mysql_fetch_assoc($r))
	{
		if($ro['Supplier_ID']==$row['Supplier_ID']){$sel="Selected=\"Selected\"";}else{$sel="";}
		print("<option value=".$ro['Supplier_ID']." $sel >");
		print("$ro[Supplier_Name]</option>");
	}
print("</select>");
 
print("<p><label for=\"tooltype\">Tool Type</label>");

	 $qq="select * from Tool_Type;";
	$rr = mysql_query($qq, $cxn) or die(mysql_error($cxn));
	print("<select name=\"Tool_Type_ID\" id=\"Tool_Type_ID\" class=\"required\">");
	print("<option value=\"\" >Select Tool Type</option>");
	while($rro = mysql_fetch_assoc($rr))
	{
		if($rro['Tool_Type_ID']==$row['Tool_Type']){$sel="Selected=\"Selected\"";}else{$sel="";}
		print("<option value=".$rro['Tool_Type_ID']." $sel >");
		print("$rro[Tool_Type]</option>");
	}
print("</select>");

print("<p><label for=\"tmake\">Tool Manufacturrer</label>
     <input id=\"tmake\" name=\"tmake\" size=\"25\"  class=\"required\" value=\"$row[Tool_Make]\" />
  </p>");

print("<p><label for=\"tdesc\">Tool Description</label>
     <input id=\"tdesc\" name=\"tdesc\" size=\"25\"  class=\"required\" value=\"$row[Tool_Desc]\" />
  </p>");
print("<p><label for=\"tpno\">Tool Part No.</label>
     <input id=\"tpno\" name=\"tpno\" size=\"25\" class=\"required\" value=\"$row[Tool_Part_NO]\"/>
  </p>");
print("<p><label for=\"tdia\">Tool Diameter</label>
     <input id=\"tdia\" name=\"tdia\" size=\"25\"  class=\"required number\" value=\"$row[Tool_Dia]\" />
  </p>");

print("<p><label for=\"sdia\">Shank Diameter</label>
     <input id=\"sdia\" name=\"sdia\" size=\"25\"  class=\"required\" value=\"$row[Shank_Dia]\" />
  </p>");

print("<p><label for=\"tcr\">Corner Radius/Angle</label>
     <input id=\"tcr\" name=\"tcr\" size=\"25\"  class=\"number\" value=\"$row[Tool_Corner_Rad]\"/>
  </p>");

print("<p><label for=\"tfl\">Flute Length</label>
     <input id=\"tfl\" name=\"tfl\" size=\"25\"  class=\"number\" value=\"$row[Tool_FL]\" />
  </p>");

print("<p><label for=\"oal\">Over All Length </label>
     <input id=\"oal\" name=\"oal\" type=\"text\" class=\"required_oal_greater_usel\" value=\"$row[Tool_OAL]\" />
  </p>");

print("<p><label for=\"usel\">Useful Length of Tool </label>
     <input type=\"text\" id=\"usel\" name=\"usel\" class=\"required_uselen_greater_fl\" value=\"$row[Tool_Useful_Length]\"/>
  </p>");

print("<p><label for=\"nce\">No of Cutting Edges </label>
     <input type=\"text\" id=\"nce\" name=\"nce\" class=\"required number\" max=\"10\" value=\"$row[No_Of_Edges]\"/>
  </p>");

print("<p><label for=\"coating\">Tool Coating </label>
     <input type=\"text\" id=\"coating\" name=\"coating\" value=\"$row[Tool_Coating]\" />
  </p>");
	
print("<p><label for=\"remark\">Tool Specific Remark </label>
     <input type=\"text\" id=\"tremark\" name=\"tremark\" size=\"50\" value=\"$row[Tool_Remarks]\"/>
  </p>");

	
}


?>