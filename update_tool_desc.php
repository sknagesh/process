<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$uploadDir = '/home/www/drawings/';
print_r($_POST);

$supid=$_POST['Supplier_ID'];
$ttypeid=$_POST['Tool_Type_ID'];
$nce=$_POST['nce'];
$oal=$_POST['oal'];
$tdesc=$_POST['tdesc'];
$tpno=$_POST['tpno'];
$tdia=$_POST['tdia'];
$tfl=$_POST['tfl'];
$tmake=$_POST['tmake'];
$toolid=$_POST['Tool_ID_1'];
$tremark=$_POST['tremark'];
if(isSet($_POST['coating'])){$coating=$_POST['coating'];}else{$coating="";}
if(isSet($_POST['tcr'])){$tcr=$_POST['tcr'];}else{$tcr="";}
if(isSet($_POST['usel'])){$usel=$_POST['usel'];}else{$usel="";}
if(isSet($_POST['sdia'])){$sdia=$_POST['sdia'];}else{$sdia="";}

$query="UPDATE Tool SET
	Supplier_ID='$supid',
	Tool_Type='$ttypeid',
	Tool_Part_NO='$tpno',
	Tool_Desc='$tdesc',
	Tool_Dia='$tdia',
	Tool_FL='$tfl',
	Tool_Corner_Rad='$tcr',
	No_Of_Edges='$nce',
	Tool_OAL='$oal',
	Tool_Useful_Length='$usel',
	Shank_Dia='$sdia',
	Tool_Make='$tmake',
	Tool_Coating='$coating',
	Tool_Remarks='$tremark'
	 WHERE Tool_ID=$toolid;";



//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Updated Tool $tdesc - $tpno");	
	
}else
	{
		print("Error Updating");
	}


?>