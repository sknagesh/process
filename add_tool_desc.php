<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$uploadDir = '/home/www/drawings/';
//print_r($_POST);
//print_r($_FILES);
$supid=$_POST['Supplier_ID'];
$ttypeid=$_POST['Tool_Type_ID'];
$nce=$_POST['nce'];
$oal=$_POST['oal'];
$tdesc=$_POST['tdesc'];
$tpno=$_POST['tpno'];
$tdia=$_POST['tdia'];
$tfl=$_POST['tfl'];
$tmake=$_POST['tmake'];
if(isSet($_POST['coating'])){$coating=$_POST['coating'];}else{$coating="";}
if(isSet($_POST['tcr'])){$tcr=$_POST['tcr'];}else{$tcr="";}
if(isSet($_POST['usel'])){$usel=$_POST['usel'];}else{$usel="";}
if(isSet($_POST['sdia'])){$sdia=$_POST['sdia'];}else{$sdia="";}

$query="INSERT INTO Tool (Supplier_ID,
								Tool_Type,
								Tool_Part_NO,
								Tool_Desc,
								Tool_Dia,
								Tool_FL,
								Tool_Corner_Rad,
								No_Of_Edges,
								Tool_OAL,
								Tool_Useful_Length,
								Shank_Dia,
								Tool_Make,
								Tool_Coating) ";
$query.="VALUES('$supid',
				'$ttypeid',
				'$tpno',
				'$tdesc',
				'$tdia',
				'$tfl',
				'$tcr',
				'$nce',
				'$oal',
				'$usel',
				'$sdia',
				'$tmake',
				'$coating');";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Added new Tool $tdesc - $tpno");	
	
}else
	{
		print("Error Adding");
	}


?>