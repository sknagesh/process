<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$uploadDir = '/home/www/drawings/';
//print_r($_POST);

$toolid=$_POST['Tool_ID'];
$inspno=$_POST['inspno'];
$insdesc=$_POST['insdesc'];

$query="INSERT INTO Inserts (Tool_ID,
								Insert_Part_NO,
								Insert_Desc) ";
$query.="VALUES('$toolid',
				'$inspno',
				'$insdesc');";

//print($query);

$res=mysql_query($query) or die(mysql_error());

$result=mysql_affected_rows();
if($result!=0)
{
print("Added new Insert $inspno - $insdesc");	
	
}else
	{
		print("Error Adding");
	}


?>