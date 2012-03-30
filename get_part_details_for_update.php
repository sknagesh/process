<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$drawingid=$_GET['drawingid'];
//print_r($_POST);
$query="SELECT * FROM Part WHERE Drawing_ID='$drawingid';";
$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));

$row = mysql_fetch_assoc($resa);

	$dpath=$row['Drawing_File'];
	$ppath=$row['Process_Sheet'];
	$pinpath=$row['Gage_List'];
	$preview=$row['Preview_Image'];
	$pname=$row['Component_Name'];
	$dno=$row['Drawing_NO'];
	$cmaterial=$row['Component_Material'];
	$cutblank=$row['Cut_Blank'];
	$premblank=$row['Pre_Machined_Blank'];
	$drgno=$row['Drawing_NO'];
print("<p>
     <label for=\"componentname\">Component Name</label>
     <input id=\"componentname\" name=\"componentname\" size=\"25\" class=\"required\" value=\"$pname\"/>
  </p>");
print("<p>
     <label for=\"mspec\">Material Specification</label>
     <input id=\"mspec\" name=\"mspec\" size=\"25\"  value=\"$cmaterial\" />
  </p>");

 print("<p>
     <label for=\"cblank\">Cut Blank Size</label>
     <input id=\"cblank\" name=\"cblank\" size=\"25\"  value=\"$cutblank\" />
  </p>");

print("<p>
     <label for=\"pmblank\">Pre Machined Blank Size</label>
     <input id=\"pmblank\" name=\"pmblank\" size=\"25\"  value=\"$premblank\" />
  </p>");

print("<p>
     <label for=\"drg\">Select Drawing </label>
     <input id=\"drg\" name=\"drg\" type=\"file\" />$dpath
  </p>");

print("<p>
     <label for=\"process\">Select Process Sheet </label>
     <input type=\"file\" id=\"process\" name=\"process\" />$ppath
  </p>");

print("<p>
     <label for=\"gage\">Select Pin and Gage List </label>
     <input type=\"file\" id=\"gage\" name=\"gage\" />$pinpath
  </p>");


print("<p>
     <label for=\"preview\">Select Pre View Image </label>
     <input type=\"file\" id=\"preview\" name=\"preview\" />$preview
  </p>");

print("<input id=\"drgno\" name=\"Drawing_NO\" type=\"hidden\"  value=\"$drgno\" />");

?>